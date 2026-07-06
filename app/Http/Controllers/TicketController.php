<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Room;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    public function store(Request $request)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [
            $user::ROLE_USER,
        ]);

        $data = $request->only(['title', 'description', 'equipment_id', 'room_id']);

        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'equipment_id' => ['nullable', 'integer', 'exists:equipments,id'],
            'room_id' => ['nullable', 'integer', 'exists:rooms,id'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (!empty($data['equipment_id'])) {
            $equipment = Equipment::find($data['equipment_id']);
            if (!$equipment || !$equipment->active) {
                return response()->json(['message' => 'Equipamento inválido ou inativo.'], 422);
            }
        }

        if (!empty($data['room_id'])) {
            $room = Room::find($data['room_id']);
            if (!$room || !$room->active) {
                return response()->json(['message' => 'Sala inválida ou inativa.'], 422);
            }
        }

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'equipment_id' => $data['equipment_id'] ?? null,
            'room_id' => $data['room_id'] ?? null,
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => Ticket::STATUS_OPEN,
            'opened_at' => now(),
        ]);

        return response()->json(['ticket' => $ticket], 201);
    }

    public function index(Request $request)
    {
        $user = $this->authenticatedUser($request);

        if ($user->isCommon()) {
            $tickets = Ticket::where('user_id', $user->id)->get();
        } else {
            $tickets = Ticket::all();
        }

        return response()->json(['tickets' => $tickets]);
    }

    public function openTickets(Request $request)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [
            $user::ROLE_TECHNICIAN,
            $user::ROLE_ADMIN,
        ]);

        $tickets = Ticket::where('status', Ticket::STATUS_OPEN)->get();

        return response()->json(['tickets' => $tickets]);
    }

    public function startTicket(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [
            $user::ROLE_TECHNICIAN,
        ]);

        $ticket = Ticket::find($id);
        if (!$ticket) {
            return response()->json(['message' => 'Ticket não encontrado'], 404);
        }

        if ($ticket->status !== Ticket::STATUS_OPEN) {
            return response()->json(['message' => 'Só é possível iniciar tickets abertos'], 422);
        }

        $ticket->status = Ticket::STATUS_IN_PROGRESS;
        $ticket->assigned_to = $user->id;
        $ticket->in_progress_at = now();
        $ticket->save();

        return response()->json(['ticket' => $ticket]);
    }

    public function closeTicket(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [
            $user::ROLE_TECHNICIAN,
        ]);

        $data = $request->only(['minutes_spent', 'cost']);

        $validator = Validator::make($data, [
            'minutes_spent' => ['required', 'integer', 'min:1'],
            'cost' => ['required', 'numeric', 'min:0'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $ticket = Ticket::find($id);
        if (!$ticket) {
            return response()->json(['message' => 'Ticket não encontrado'], 404);
        }

        if ($ticket->status !== Ticket::STATUS_IN_PROGRESS) {
            return response()->json(['message' => 'Só é possível encerrar tickets em curso'], 422);
        }

        $ticket->status = Ticket::STATUS_CLOSED;
        $ticket->minutes_spent = $data['minutes_spent'];
        $ticket->cost = $data['cost'];
        $ticket->closed_at = now();
        $ticket->save();

        return response()->json(['ticket' => $ticket]);
    }
}
