<?php

namespace App\Http\Controllers;

use App\Actions\CreateTicketAction;
use App\DTOs\CreateTicketData;
use App\DTOs\TicketFilters;
use App\Enums\TicketPriorityEnum;
use App\Enums\UserRoleEnum;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use App\Models\User;
use App\Services\AIService;
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

        $tickets = $this->ticketRepository->getAll(['equipment', 'room', 'user', 'technician', 'status']);

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
        $ticket->loadMissing(['equipment', 'room', 'user', 'status']);

        return response()->json([
            'message' => __('Ticket criado com sucesso.'),
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
                'message' => __('Prioridade inválida. Valores válidos: baixa, média, alta, crítica.'),
            ], 422);
        }

        $filters = TicketFilters::fromRequest($request->all());
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

        $recomendacaoIA = app(AIService::class)->recomendarTecnico($ticket);

        return view('ui.ticket-detail', compact('ticket', 'recomendacaoIA'));
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
            return response()->json(['message' => __('Acesso proibido para o seu perfil.')], 403);
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

        $excludeId = (int) $request->input('exclude', 0);
        $ticket = $this->technicianService->findMostUrgentOpenTicket($excludeId > 0 ? $excludeId : null);

        if (! $ticket) {
            return response()->json([
                'ticket_id' => null,
                'message' => __('Não existem tickets abertos prioritários.'),
            ], 404);
        }

        return response()->json([
            'ticket_id' => $ticket->id,
            'title' => $ticket->title,
            'priority' => $ticket->priority,
        ]);
    }
}
