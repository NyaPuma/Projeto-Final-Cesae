<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Models\TicketComment;
use App\Models\TicketAttachment;
use App\Services\AIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class TicketController extends Controller
{
    protected $aiService;

    // Injeção de dependência do serviço de Inteligência Artificial
    public function __construct(AIService $aiService)
    {
        $this->aiService = $aiService;
    }

    /**
     * Lista genérica de todos os tickets (JSON / Tabela)
     */
    public function index()
    {
        return response()->json(Ticket::with(['status', 'user', 'technician'])->get());
    }

    /**
     * Exibe a página principal com o layout do Calendário (Rota: /calendar)
     */
    public function calendarView()
    {
        return view('agenda'); 
    }

    /**
     * Fornece os dados em formato JSON para o FullCalendar preencher os dias (Rota: /calendar/events)
     */
    public function calendarEvents()
    {
        // Vai buscar os tickets que têm agendamento marcado no banco de dados XAMPP
        $tickets = Ticket::whereNotNull('scheduled_at')->get();

        // Mapeia os dados tratando as datas de forma totalmente segura para o FullCalendar v6
        $events = $tickets->map(function ($ticket) {
            $start = null;
            $end = null;

            if ($ticket->scheduled_at) {
                $start = $ticket->scheduled_at instanceof Carbon 
                    ? $ticket->scheduled_at->toIso8601String() 
                    : Carbon::parse($ticket->scheduled_at)->toIso8601String();
            }

            if ($ticket->scheduled_end) {
                $end = $ticket->scheduled_end instanceof Carbon 
                    ? $ticket->scheduled_end->toIso8601String() 
                    : Carbon::parse($ticket->scheduled_end)->toIso8601String();
            }

            return [
                'id'    => $ticket->id,
                'title' => '🔧 #' . $ticket->id . ' - ' . $ticket->title,
                'start' => $start,
                'end'   => $end,
            ];
        });

        return response()->json($events);
    }

    /**
     * Exibe o detalhe do ticket injetando a sugestão em tempo real da IA
     */
    public function show($id)
    {
        $ticket = Ticket::with(['equipment.category', 'room', 'user'])->findOrFail($id);
        $recomendacaoIA = $this->aiService->recomendarTecnico($ticket);

        return view('ui.ticketDetail', compact('ticket', 'recomendacaoIA'));
    }

    /**
     * Grava a alocação do técnico sugerido pela IA ou escolhido manualmente.
     */
    public function atribuirTecnico(Request $request, $id)
    {
        $request->validate([
            'tecnico_id' => 'required|exists:users,id',
        ]);

        $ticket = Ticket::findOrFail($id);
        $oldStatus = $ticket->status ? $ticket->status->name : Ticket::STATUS_OPEN;

        $inProgressStatusId = Ticket::getStatusIdByName(Ticket::STATUS_IN_PROGRESS);
        
        $ticket->status_id      = $inProgressStatusId;
        $ticket->assigned_to    = $request->tecnico_id;
        $ticket->in_progress_at = now();
        $ticket->save();

        if ($ticket->user && $ticket->user->email) {
            $ticket->user->notify(new \App\Notifications\TicketStatusChanged($ticket, $oldStatus, Ticket::STATUS_IN_PROGRESS));
        }

        event(new \App\Events\TicketStatusUpdatedBroadcast($ticket, $oldStatus, Ticket::STATUS_IN_PROGRESS));

        return response()->json(['ticket' => $ticket]);
    }

    /**
     * Associa explicitamente um técnico a um ticket (Apenas Administradores).
     */
    public function assignTechnician(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_ADMIN]);

        $ticket = Ticket::find($id);
        if (!$ticket) {
            return response()->json(['message' => 'Ticket não encontrado'], 404);
        }

        $data = $request->only(['technician_id']);
        $validator = Validator::make($data, [
            'technician_id' => ['nullable', 'integer', 'exists:users,id'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $technician = null;
        if (!empty($data['technician_id'])) {
            $technician = User::find($data['technician_id']);
            if (!$technician || !$technician->isTechnician()) {
                return response()->json(['message' => 'Técnico inválido'], 422);
            }
        } else {
            $technician = Ticket::getLeastBusyTechnician();
            if (!$technician) {
                return response()->json(['message' => 'Não existem técnicos disponíveis'], 422);
            }
        }

        $ticket->assigned_to = $technician->id;
        $ticket->save();

        return response()->json(['ticket' => $ticket]);
    }

    /**
     * Reabre um ticket que tenha sido previamente fechado.
     */
    public function reopenTicket(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_TECHNICIAN, User::ROLE_ADMIN]);

        $ticket = Ticket::find($id);
        if (!$ticket) {
            return response()->json(['message' => 'Ticket não encontrado'], 404);
        }

        if (!$ticket->reopen()) {
            return response()->json(['message' => 'Só é possível reabrir tickets fechados'], 422);
        }

        return response()->json(['ticket' => $ticket]);
    }

    /**
     * Cancela um ticket aberto.
     */
    public function cancelTicket(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);

        if (!$user->isCommon()) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        $ticket = Ticket::find($id);
        if (!$ticket) {
            return response()->json(['message' => 'Ticket não encontrado'], 404);
        }

        if ($ticket->user_id !== $user->id) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        if (!$ticket->hasStatus(Ticket::STATUS_OPEN)) {
            return response()->json(['message' => 'Só é possível cancelar tickets abertos'], 403);
        }

        $cancelledStatusId = Ticket::getStatusIdByName(Ticket::STATUS_CANCELLED);
        $ticket->status_id = $cancelledStatusId;
        $ticket->closed_at = now();
        $ticket->save();

        return response()->json(['ticket' => $ticket]);
    }

    /**
     * Adiciona um comentário técnico.
     */
    public function addComment(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);
        $ticket = Ticket::find($id);
        
        if (!$ticket) {
            return response()->json(['message' => 'Ticket não encontrado'], 404);
        }

        if ($user->isCommon() && (int)$ticket->user_id !== (int)$user->id) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        if (!$user->isCommon()) {
            $this->requireRole($user, [User::ROLE_TECHNICIAN, User::ROLE_ADMIN]);
        }

        $data = $request->only(['comment']);
        $validator = Validator::make($data, [
            'comment' => ['required', 'string', 'max:2000'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $comment = TicketComment::create([
            'ticket_id' => $ticket->id,
            'user_id'   => $user->id,
            'comment'   => $data['comment'],
        ]);

        return response()->json(['comment' => $comment], 201);
    }

    /**
     * Lista todos os comentários do ticket.
     */
    public function listComments(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_TECHNICIAN, User::ROLE_ADMIN]);

        $ticket = Ticket::with(['comments.user'])->find($id);
        if (!$ticket) {
            return response()->json(['message' => 'Ticket não encontrado'], 404);
        }

        return response()->json(['comments' => $ticket->comments]);
    }

    /**
     * Faz o upload de evidências fotográficas.
     */
    public function uploadPhoto(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);
        $ticket = Ticket::find($id);
        
        if (!$ticket) {
            return response()->json(['message' => 'Ticket não encontrado'], 404);
        }

        if ($user->isCommon() && (int) $ticket->user_id !== (int) $user->id) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        $validator = Validator::make($request->all(), [
            'photo' => ['required', 'file', 'image', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $file = $request->file('photo');
        $path = $file->store('ticket_photos', 'public');
        $url = Storage::disk('public')->url($path);

        $attachment = TicketAttachment::create([
            'ticket_id' => $ticket->id,
            'user_id'   => $user->id,
            'file_name' => $file->getClientOriginalName(),
            'path'      => $path,
            'mime_type' => $file->getClientMimeType(),
            'size'      => $file->getSize(),
        ]);

        return response()->json(['attachment' => $attachment, 'url' => $url], 201);
    }

    /**
     * Lista as fotografias anexadas ao ticket.
     */
    public function listPhotos(Request $request, int $id)
    {
        $this->authenticatedUser($request);

        $ticket = Ticket::with('attachments')->find($id);
        if (!$ticket) {
            return response()->json(['message' => 'Ticket não encontrado'], 404);
        }

        return response()->json(['attachments' => $ticket->attachments]);
    }

    /**
     * Conclui de forma definitiva um ticket em curso.
     */
    public function closeTicket(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_TECHNICIAN, User::ROLE_ADMIN]);

        $ticket = Ticket::findOrFail($id);

        $request->validate([
            'minutes_spent'    => 'required|integer|min:1',
            'cost'             => 'required|numeric|min:0',
            'technical_report' => 'required|string|min:10|max:5000',
        ]);

        $closedStatusId = Ticket::getStatusIdByName(Ticket::STATUS_CLOSED);
        $oldStatusName  = $ticket->status ? $ticket->status->name : Ticket::STATUS_IN_PROGRESS;

        $ticket->update([
            'status_id'        => $closedStatusId,
            'minutes_spent'    => $request->minutes_spent,
            'cost'             => $request->cost,
            'technical_report' => $request->technical_report,
            'closed_at'        => now(),
        ]);

        event(new \App\Events\TicketStatusUpdatedBroadcast($ticket, $oldStatusName, Ticket::STATUS_CLOSED));

        if ($ticket->user && $ticket->user->email) {
            $ticket->user->notify(new \App\Notifications\TicketStatusChanged($ticket, $oldStatusName, Ticket::STATUS_CLOSED));
        }

        return redirect()->route('admin.tickets.show', $id)
                         ->with('success', 'Intervenção concluída e ticket arquivado com sucesso!');
    }
}