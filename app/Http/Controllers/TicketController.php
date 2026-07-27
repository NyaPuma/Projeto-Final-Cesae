<?php

namespace App\Http\Controllers;

use App\DTOs\CreateTicketData;
use App\DTOs\TicketFilters;
use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Http\Requests\StoreTicketRequest;
use App\Models\Ticket;
use App\Models\User;
use App\Services\AIService;
use App\Services\TechnicianAssignmentService;
use App\Services\TicketStatusService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct(
        private readonly TicketStatusService $statusService,
        private readonly TechnicianAssignmentService $technicianService,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $query = Ticket::with(['equipment', 'room', 'user', 'technician', 'status']);

        if ($request->has('q') && ! empty($request->q)) {
            $q = str_replace(['%', '_'], ['\%', '\_'], $request->q);
            $query->where('title', 'like', '%'.$q.'%');
        }

        return response()->json([
            'tickets' => $query->latest()->paginate(15),
        ]);
    }

    public function store(StoreTicketRequest $request): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $data = CreateTicketData::fromRequest($request->validated());

        $openStatusId = $this->statusService->getByName(TicketStatusEnum::Open);

        $ticket = Ticket::create([
            'title' => $data->title,
            'description' => $data->description,
            'priority' => $data->priority->value,
            'user_id' => $user->id,
            'equipment_id' => $data->equipmentId,
            'room_id' => $data->roomId,
            'status_id' => $openStatusId,
            'opened_at' => now(),
        ]);

        $ticket->load(['equipment', 'room', 'user', 'status']);

        return response()->json(['ticket' => $ticket], 201);
    }

    public function search(Request $request): JsonResponse
    {
        $user = $this->authenticatedUser($request);

        if ($request->has('priority') && ! in_array($request->priority, array_merge(
            TicketPriorityEnum::values(),
            ['media', 'critica']
        ))) {
            return response()->json([
                'message' => 'Prioridade inválida. Valores válidos: baixa, média, alta, crítica.',
            ], 422);
        }

        $filters = TicketFilters::fromRequest($request->all());

        $query = Ticket::with(['equipment', 'room', 'user', 'status', 'technician']);

        if ($filters->query !== null) {
            $q = str_replace(['%', '_'], ['\%', '\_'], $filters->query);
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            });
        }

        if ($filters->priority !== null) {
            $query->where('priority', $filters->priority->value);
        }

        if ($filters->status !== null) {
            $statusEnum = TicketStatusEnum::fromValue($filters->status);
            if ($statusEnum) {
                $statusId = $this->statusService->getByName($statusEnum);
                $query->where('status_id', $statusId);
            } else {
                return response()->json(['message' => 'Estado inválido.'], 422);
            }
        }

        if ($filters->dateFrom !== null && $filters->dateTo !== null) {
            if ($filters->dateFrom > $filters->dateTo) {
                return response()->json(['message' => 'A data de início não pode ser posterior à data de fim.'], 422);
            }
            $query->whereBetween('created_at', [$filters->dateFrom, $filters->dateTo.' 23:59:59']);
        } elseif ($filters->dateFrom !== null) {
            $query->whereDate('created_at', '>=', $filters->dateFrom);
        } elseif ($filters->dateTo !== null) {
            $query->whereDate('created_at', '<=', $filters->dateTo);
        }

        return response()->json([
            'tickets' => $query->latest()->paginate(15),
        ]);
    }

    public function show(Request $request, int $id): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $ticket = Ticket::with(['equipment.category', 'room', 'user', 'technician', 'status'])->findOrFail($id);

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

        $tickets = Ticket::with(['equipment', 'room', 'user', 'status'])
            ->open()
            ->latest()
            ->paginate(15);

        return response()->json(['tickets' => $tickets]);
    }

    public function getMostUrgentOpenTicket(Request $request): JsonResponse
    {
        $user = $this->authenticatedUser($request);
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
