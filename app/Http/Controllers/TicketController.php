<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Services\AIService;
use Illuminate\Http\Request;

class AdminTicketController extends Controller
{
    protected $aiService;

    // Injeção de dependência do serviço de Inteligência Artificial
    public function __construct(AIService $aiService)
    {
        $this->aiService = $aiService;
    }

    /**
     * Exibe o detalhe do ticket injetando a sugestão em tempo real da IA
     */
    public function show($id)
    {
        // Procura o ticket trazendo os relacionamentos exatos do teu projeto
        $ticket = Ticket::with(['equipment.category', 'room', 'user'])->findOrFail($id);

        // Invoca o motor de Inteligência Artificial passando o objeto Ticket
        $recomendacaoIA = $this->aiService->recomendarTecnico($ticket);

        // Envia os dados para a vossa view centralizada na pasta 'ui'
        return view('ui.ticketDetail', compact('ticket', 'recomendacaoIA'));
    }

    /**
     * Grava a alocação do técnico sugerido pela IA ou escolhido manualmente
     */
    public function atribuirTecnico(Request $request, $id)
    {
        $request->validate([
            'tecnico_id' => 'required|exists:users,id', // Valida se o ID existe na tabela users
        ]);

        $ticket = Ticket::findOrFail($id);

        // Vai buscar dinamicamente o ID do estado "Em Curso" definido no teu Model
        $inProgressStatusId = Ticket::getStatusIdByName(Ticket::STATUS_IN_PROGRESS);

        // Executa a atualização no MySQL com as colunas reais: assigned_to e status_id
        $ticket->update([
            'assigned_to'    => $request->tecnico_id,
            'status_id'      => $inProgressStatusId,
            'in_progress_at' => now(), // Regista o início do carimbo temporal
        ]);

        // Dispara o evento de Broadcast nativo que vocês já têm para atualizar os ecrãs
        $oldStatus = Ticket::STATUS_OPEN;
        event(new \App\Events\TicketStatusUpdatedBroadcast($ticket, $oldStatus, Ticket::STATUS_IN_PROGRESS));

        // Envia notificação por email para o utilizador que abriu o problema
        if ($ticket->user && $ticket->user->email) {
            $ticket->user->notify(new \App\Notifications\TicketStatusChanged($ticket, $oldStatus, Ticket::STATUS_IN_PROGRESS));
        }

        return redirect()->route('admin.tickets.show', $id)
                         ->with('success', 'Técnico alocado com sucesso via Assistente IA!');
    }
}