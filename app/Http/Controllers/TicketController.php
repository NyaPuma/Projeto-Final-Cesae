<?php

namespace App\Http\Controllers;

use App\Actions\CreateTicketAction;
use App\DTOs\CreateTicketData;
use App\DTOs\TicketFilters;
use App\Enums\TicketPriorityEnum;
use App\Http\Requests\StoreTicketRequest;
use App\Models\User;
use App\Repositories\Contracts\TicketRepositoryInterface;
use App\Services\AIService;
use App\Services\TechnicianAssignmentService;
use App\Services\TicketSearchService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TicketController extends Controller
{
    public function __construct(
        private readonly TicketRepositoryInterface $ticketRepository,
        private readonly CreateTicketAction $createTicketAction,
        private readonly TechnicianAssignmentService $technicianService,
        private readonly TicketSearchService $searchService,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $tickets = $this->ticketRepository->getAll(['equipment', 'room', 'user', 'technician', 'status']);

        return response()->json(['tickets' => $tickets]);
    }

    public function store(StoreTicketRequest $request): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $data = CreateTicketData::fromRequest($request->validated());

        $ticket = $this->createTicketAction->execute($user, $data);
        $ticket->load(['equipment', 'room', 'user', 'status']);

        return response()->json(['ticket' => $ticket], 201);
    }

    public function search(Request $request): JsonResponse
    {
        $this->authenticatedUser($request);

        if ($request->has('priority') && ! in_array($request->priority, array_merge(
            TicketPriorityEnum::values(),
            ['media', 'critica']
        ))) {
            return response()->json([
                'message' => 'Prioridade inválida. Valores válidos: baixa, média, alta, crítica.',
            ], 422);
        }

        $filters = TicketFilters::fromRequest($request->all());

        return response()->json([
            'tickets' => $this->searchService->search($filters),
        ]);
    }

    public function show(Request $request, int $id): JsonResponse|View
    {
        $user = $this->authenticatedUser($request);
        $ticket = $this->ticketRepository->findWithRelations($id, ['equipment.category', 'room', 'user', 'technician', 'status']);

        if (! $ticket) {
            return response()->json(['message' => 'Ticket não encontrado'], 404);
        }

        if ($user->isCommon() && (int) $ticket->user_id !== (int) $user->id) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['ticket' => $ticket]);
        }

        $recomendacaoIA = app(AIService::class)->recomendarTecnico($ticket);

        return view('ui.ticket-detail', compact('ticket', 'recomendacaoIA'));
    }

    public function openTickets(Request $request): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_TECHNICIAN, User::ROLE_ADMIN]);

        $tickets = $this->ticketRepository->getOpenTickets();

        return response()->json(['tickets' => $tickets]);
    }

    public function getMostUrgentOpenTicket(Request $request): JsonResponse
    {
        $this->authenticatedUser($request);
        $excludeId = (int) $request->input('exclude', 0);

        $ticket = $this->technicianService->findMostUrgentOpenTicket($excludeId > 0 ? $excludeId : null);

        if (! $ticket) {
            return response()->json(['ticket_id' => null, 'message' => __('Não existem tickets abertos prioritários.')], 404);
        }

        return response()->json([
            'ticket_id' => $ticket->id,
            'title' => $ticket->title,
            'priority' => $ticket->priority,
        ]);
    }
}
