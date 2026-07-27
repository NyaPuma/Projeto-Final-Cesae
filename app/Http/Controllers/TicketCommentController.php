<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Ticket;
use App\Models\TicketComment;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketCommentController extends Controller
{
    public function store(StoreCommentRequest $request, int $id): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $ticket = Ticket::findOrFail($id);

        if (! $user->can('view', $ticket)) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        $comment = TicketComment::create([
            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
            'comment' => $request->validated('comment'),
        ]);

        return response()->json(['comment' => $comment], 201);
    }

    public function index(Request $request, int $id): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_TECHNICIAN, User::ROLE_ADMIN]);

        $ticket = Ticket::with(['comments.user'])->findOrFail($id);

        return response()->json(['comments' => $ticket->comments]);
    }
}
