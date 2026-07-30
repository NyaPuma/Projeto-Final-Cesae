<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleTicketRequest;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;

final class TicketScheduleController extends Controller
{
    public function __invoke(ScheduleTicketRequest $request, int $id): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $ticket = Ticket::findOrFail($id);

        if ($user->isCommon() && (int) $ticket->user_id !== (int) $user->id) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        $ticket->update([
            'scheduled_at' => $request->validated('scheduled_at'),
            'scheduled_end' => $request->validated('scheduled_end'),
            'scheduled' => true,
        ]);

        return response()->json(['ticket' => $ticket]);
    }
}
