<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\TicketCommentResource;
use App\Models\Ticket;
use App\Models\TicketComment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class TicketCommentController extends Controller
{
    /**
     * Adiciona um novo comentário a um ticket específico.
     */
    public function store(StoreCommentRequest $request, int $id): JsonResponse
    {
        $ticket = Ticket::findOrFail($id);

        // 1. Autorização via Policy
        $this->authorize('view', $ticket);

        // 2. Registo do comentário com dados validados
        $comment = TicketComment::create([
            'ticket_id' => $ticket->id,
            'user_id' => $request->user()->id,
            'comment' => $request->validated('comment'),
        ]);

        $comment->loadMissing('user');

        return response()->json([
            'message' => __('messages.Comentário adicionado com sucesso.'),
            'comment' => new TicketCommentResource($comment),
        ], 201);
    }

    /**
     * Lista todos os comentários associados a um ticket.
     */
    public function index(Request $request, Ticket $ticket): JsonResponse
    {
        // 1. Autorização via Policy
        $this->authorize('view', $ticket);

        // 2. Carrega os comentários cronologicamente com a respetiva relação do utilizador
        $comments = $ticket->comments()
            ->with('user')
            ->chronological()
            ->get();

        return response()->json([
            'comments' => TicketCommentResource::collection($comments),
        ]);
    }
}
