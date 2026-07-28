<?php

namespace App\Http\Controllers\Ticket;

use App\Concerns\BroadcastsTicketStatus;
use App\Enums\TicketStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssignTechnicianToTicketRequest;
use App\Models\Ticket;
use App\Models\User;
use App\Services\TechnicianAssignmentService;
use Illuminate\Http\JsonResponse;

final class TicketAssignmentController extends Controller
{
    use BroadcastsTicketStatus;

    public function __construct(
        private readonly TechnicianAssignmentService $technicianService,
    ) {}

    public function __invoke(AssignTechnicianToTicketRequest $request, int $id): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_TECHNICIAN, User::ROLE_ADMIN]);

        $ticket = Ticket::findOrFail($id);
        $oldStatus = $ticket->status->name ?? '';

        $this->technicianService->assignToTicket($ticket, (int) $request->tecnico_id);

        $this->broadcastStatusChange($ticket, $oldStatus, TicketStatusEnum::InProgress);

        return response()->json(['ticket' => $ticket->load(['equipment', 'room', 'technician', 'status'])]);
    }
}
