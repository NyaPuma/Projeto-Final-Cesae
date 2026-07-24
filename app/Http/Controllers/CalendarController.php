<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    // Apresenta a vista do calendário com os tickets correspondentes.
    public function index(Request $request)
    {
        $user = $this->authenticatedUser($request);

        $query = Ticket::with(['equipment', 'equipment.category'])
            ->whereNotNull('scheduled_at')
            ->whereNull('deleted_at');

        if ($user->profile->name === 'technician') {
            $query->where('assigned_to', $user->id);
        }

        $tickets = $query->get();

        $events = $tickets->map(function ($ticket) {
            return [
                'id' => $ticket->id,
                'title' => $ticket->equipment->name ?? 'Avaria Geral',
                'start' => $ticket->created_at->toIso8601String(),
                'description' => $ticket->description,
                'url' => url("/ui/tickets/{$ticket->id}"),
            ];
        });

        return view('calendar', compact('events', 'user'));
    }
}
