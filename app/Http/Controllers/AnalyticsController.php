<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function stats(Request $request)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [
            $user::ROLE_ADMIN,
            $user::ROLE_TECHNICIAN,
        ]);

        $tickets = Ticket::where('status', Ticket::STATUS_CLOSED)->get();
        $averageResolution = $tickets->average(function (Ticket $ticket) {
            if (!$ticket->opened_at || !$ticket->closed_at) {
                return null;
            }
            return $ticket->closed_at->diffInMinutes($ticket->opened_at);
        });

        $openTickets = Ticket::where('status', Ticket::STATUS_OPEN)->get();
        $averageWaiting = $openTickets->average(function (Ticket $ticket) {
            if (!$ticket->opened_at) {
                return null;
            }
            return $ticket->opened_at->diffInMinutes(now());
        });

        return response()->json([
            'average_resolution_minutes' => round($averageResolution ?: 0, 2),
            'average_waiting_minutes' => round($averageWaiting ?: 0, 2),
        ]);
    }
}
