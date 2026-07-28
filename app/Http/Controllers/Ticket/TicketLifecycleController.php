<?php

namespace App\Http\Controllers\Ticket;

use App\Enums\TicketStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use App\Services\TicketWorkflowService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class TicketLifecycleController extends Controller
{
    public function __construct(
        private readonly TicketWorkflowService $workflowService,
    ) {}

    public function reopen(Request $request, int $id): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_TECHNICIAN, User::ROLE_ADMIN]);

        $ticket = Ticket::findOrFail($id);

        if (! $this->workflowService->reopen($ticket)) {
            return response()->json(['message' => 'Só é possível reabrir tickets fechados'], 422);
        }

        return response()->json(['ticket' => $ticket]);
    }

    public function cancel(Request $request, int $id): JsonResponse
    {
        $user = $this->authenticatedUser($request);

        if (! $user->isCommon()) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        $ticket = Ticket::findOrFail($id);

        if ($ticket->user_id !== $user->id) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        if (! $ticket->hasStatus(TicketStatusEnum::Open)) {
            return response()->json(['message' => 'Só é possível cancelar tickets abertos'], 403);
        }

        $this->workflowService->cancel($ticket);

        return response()->json(['ticket' => $ticket]);
    }
}
