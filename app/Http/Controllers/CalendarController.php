<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    // Apresenta a vista do calendário com os tickets correspondentes.
    public function index(Request $request)
    {
        // Recuperar o utilizador autenticado através do resolver comum (token/cookie/sessão)
        $user = $this->authenticatedUser($request);

        // Query base para os tickets
        $query = Ticket::with(['equipment', 'equipment.category']);

        // Filtrar tickets com base no cargo do utilizador
        if ($user->profile->name === 'technician') {
            // Técnicos apenas veem os seus tickets atribuídos
            $query->where('assigned_to', $user->id);
        }

        $tickets = $query->get();

        // Mapeamento opcional para formato compatível com FullCalendar (se usado no front-end)
        $events = $tickets->map(function ($ticket) {
            return [
                'id' => $ticket->id,
                'title' => $ticket->equipment->name ?? 'Avaria Geral',
                'start' => $ticket->created_at->toIso8601String(), // Ajusta para o teu campo de data real, se necessário
                'description' => $ticket->description,
                'url' => url("/ui/tickets/{$ticket->id}"),
            ];
        });

        return view('calendar', compact('events', 'user'));
    }
}
