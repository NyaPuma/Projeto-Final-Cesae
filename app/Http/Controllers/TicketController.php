<?php

namespace App\Http\Controllers;

use App\Actions\CreateTicketAction;
use App\DTOs\CreateTicketData;
use App\DTOs\TicketFilters;
use App\Enums\TicketPriorityEnum;
use App\Enums\UserRoleEnum;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Resources\TicketResource;
use App\Jobs\GenerateAiRecommendationJob;
use App\Models\Ticket;
use App\Models\User;
use App\Services\TechnicianAssignmentService;
use App\Services\TicketSearchService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class TicketController extends Controller
{
    public function __construct(
        private readonly \App\Repositories\Contracts\TicketRepositoryInterface $ticketRepository,
        private readonly CreateTicketAction $createTicketAction,
        private readonly TechnicianAssignmentService $technicianService,
        private readonly TicketSearchService $searchService,
    ) {}

    /**
     * Lista todos os tickets registados no sistema com as relações necessárias.
     */
    public function index(Request $request): JsonResponse
    {
        // 1. Autorização via Policy (ViewAny)
        $this->authorize('viewAny', Ticket::class);

        $user = $request->user();

        // Utilizadores comuns apenas veem os seus próprios tickets
        $tickets = ($user->isTechnician() || $user->isAdmin())
            ? $this->ticketRepository->getAll(['equipment', 'room', 'user', 'technician', 'status'])
            : $this->ticketRepository->getTicketsByUser($user->id);

        return response()->json([
            'tickets' => TicketResource::collection($tickets),
        ]);
    }

    /**
     * Cria um novo ticket de suporte.
     */
    public function store(StoreTicketRequest $request): JsonResponse
    {
        // 1. Autorização via Policy (Create)
        $this->authorize('create', Ticket::class);

        $user = $request->user();
        $data = CreateTicketData::fromRequest($request->validated());

        $ticket = $this->createTicketAction->execute($user, $data);

        // Recomendação de técnico via IA processada em segundo plano
        // (a GenerateAiRecommendationJob persiste o resultado no próprio ticket).
        GenerateAiRecommendationJob::dispatch($ticket)->afterCommit();

        $ticket->loadMissing(['equipment', 'room', 'user', 'status']);

        return response()->json([
            'message' => __('messages.Ticket criado com sucesso.'),
            'ticket' => new TicketResource($ticket),
        ], 201);
    }

    /**
     * Pesquisa e filtra tickets com base nos critérios submetidos.
     */
    public function search(Request $request): JsonResponse
    {
        // 1. Autorização via Policy
        $this->authorize('viewAny', Ticket::class);

        $priority = $request->input('priority');
        if ($priority && ! in_array($priority, TicketPriorityEnum::acceptedValues(), true)) {
            return response()->json([
                'message' => __('common.Prioridade inválida. Valores válidos: baixa, média, alta, crítica.'),
            ], 422);
        }

        $filters = TicketFilters::fromRequest($request->all());

        // Utilizadores comuns apenas pesquisam os seus próprios tickets
        $user = $request->user();
        if (! $user->isTechnician() && ! $user->isAdmin()) {
            $filters = new TicketFilters(
                query: $filters->query,
                priority: $filters->priority,
                status: $filters->status,
                dateFrom: $filters->dateFrom,
                dateTo: $filters->dateTo,
                userId: $user->id,
                technicianId: $filters->technicianId,
                equipmentId: $filters->equipmentId,
                roomId: $filters->roomId,
            );
        }

        $tickets = $this->searchService->search($filters);

        return response()->json([
            'tickets' => TicketResource::collection($tickets),
        ]);
    }

    /**
     * Exibe o detalhe de um ticket específico (suporta JSON para API ou View para Frontend Web).
     */
    public function show(Request $request, Ticket $ticket): JsonResponse|View
    {
        // 1. Autorização via Policy
        $this->authorize('view', $ticket);

        // 2. Carrega relações avançadas se necessário
        $ticket->loadMissing(['equipment.category', 'room', 'user', 'technician', 'status']);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'ticket' => new TicketResource($ticket),
            ]);
        }

        return view('ui.ticket-detail', compact('ticket'));
    }

    /**
     * Lista todos os tickets que se encontram abertos no sistema.
     */
    public function openTickets(Request $request): JsonResponse
    {
        // 1. Autorização via Policy (ViewAny restrito a técnicos/admins)
        $this->authorize('viewAny', Ticket::class);

        $user = $request->user();
        if (! $user->profile || ! in_array($user->profile->name, [UserRoleEnum::Technician->value, UserRoleEnum::Admin->value], true)) {
            return response()->json(['message' => __('common.Acesso proibido para o seu perfil.')], 403);
        }

        $tickets = $this->ticketRepository->getOpenTickets();

        return response()->json([
            'tickets' => TicketResource::collection($tickets),
        ]);
    }

    /**
     * Retorna o ticket aberto mais urgente para atribuição prioritária.
     */
    public function getMostUrgentOpenTicket(Request $request): JsonResponse
    {
        // 1. Autorização via Policy
        $this->authorize('viewAny', Ticket::class);

        // Restrito a técnicos/admins (dados operacionais sensíveis)
        $user = $request->user();
        if (! $user->profile || ! in_array($user->profile->name, [UserRoleEnum::Technician->value, UserRoleEnum::Admin->value], true)) {
            return response()->json(['message' => __('common.Acesso proibido para o seu perfil.')], 403);
        }

        $excludeId = (int) $request->input('exclude', 0);
        $ticket = $this->technicianService->findMostUrgentOpenTicket($excludeId > 0 ? $excludeId : null);

        if (! $ticket) {
            return response()->json([
                'ticket_id' => null,
                'message' => __('tickets.Não existem tickets abertos prioritários.'),
            ], 404);
        }

        return response()->json([
            'ticket_id' => $ticket->id,
            'title' => $ticket->title,
            'priority' => $ticket->priority,
        ]);
    }
}
