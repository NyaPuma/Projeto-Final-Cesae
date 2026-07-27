<?php

namespace App\Http\Controllers;

use App\Events\TicketStatusUpdatedBroadcast;
use App\Models\Notification;
use App\Models\Ticket;
use App\Models\TicketAttachment;
use App\Models\TicketComment;
use App\Models\User;
use App\Notifications\TicketStatusChanged;
use App\Services\AIService;
use App\Traits\ControllerHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    use ControllerHelpers;

    public function __construct(
        protected AIService $aiService
    ) {}

    /**
     * Lista os tickets na view index
     */
    public function index(Request $request)
    {
        $query = Ticket::with(['equipment', 'room', 'technician', 'status']);

        if ($request->has('q') && ! empty($request->q)) {
            $query->where('title', 'like', '%'.$request->q.'%');
        }

        return response()->json([
            'tickets' => Ticket::with(['equipment', 'room', 'user'])->latest()->paginate(15),
        ]);
    }

    /**
     * Armazena um novo ticket (criação de avaria)
     */
    public function store(Request $request)
    {
        $user = $this->authenticatedUser($request);

        $data = $request->only(['title', 'description', 'priority', 'equipment_id', 'room_id']);

        // Normalizar a prioridade recebida para minúsculas antes da validação
        if (isset($data['priority'])) {
            $data['priority'] = mb_strtolower(trim($data['priority']));
            if ($data['priority'] === 'media') {
                $data['priority'] = 'média';
            } elseif ($data['priority'] === 'critica') {
                $data['priority'] = 'crítica';
            }
        }

        $validator = Validator::make($data, [
            'title'        => ['required', 'string', 'max:255'],
            'description'  => ['required', 'string', 'max:5000'],
            'priority'     => ['required', 'string', 'in:baixa,média,alta,crítica'],
            'equipment_id' => ['nullable', 'integer', 'exists:equipments,id'],
            'room_id'      => ['nullable', 'integer', 'exists:rooms,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Erro de validação nos campos do ticket.',
                'errors'  => $validator->errors()
            ], 422);
        }

        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $ticket = Ticket::create([
            'title'        => $data['title'],
            'description'  => $data['description'],
            'priority'     => $data['priority'],
            'user_id'      => $user->id,
            'equipment_id' => $data['equipment_id'] ?? null,
            'room_id'      => $data['room_id'] ?? null,
            'status_id'    => $openStatusId,
            'opened_at'    => now(),
        ]);

        $ticket->load(['equipment', 'room', 'user', 'status']);

        return response()->json(['ticket' => $ticket], 201);
    }

    /**
     * Pesquisa tickets por palavra-chave, prioridade ou intervalo de datas.
     */
    public function search(Request $request)
    {
        $user = $this->authenticatedUser($request);

        $query = Ticket::with(['equipment', 'room', 'user', 'status', 'technician']);

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            });
        }

        if ($request->filled('priority')) {
            $priority = $request->priority;
            if (in_array($priority, [Ticket::PRIORITY_LOW, Ticket::PRIORITY_MEDIUM, Ticket::PRIORITY_HIGH, Ticket::PRIORITY_CRITICAL])) {
                $query->where('priority', $priority);
            } else {
                return response()->json(['message' => 'Prioridade inválida. Valores válidos: baixa, média, alta, crítica.'], 422);
            }
        }

        if ($request->filled('status')) {
            $status = $request->status;
            $statusId = Ticket::getStatusIdByName($status);
            if ($statusId) {
                $query->where('status_id', $statusId);
            } else {
                return response()->json(['message' => 'Estado inválido.'], 422);
            }
        }

        if ($request->filled('date_from') && $request->filled('date_to')) {
            $dateFrom = $request->date_from;
            $dateTo = $request->date_to;

            if ($dateFrom > $dateTo) {
                return response()->json(['message' => 'A data de início não pode ser posterior à data de fim.'], 422);
            }

            $query->whereBetween('created_at', [$dateFrom, $dateTo.' 23:59:59']);
        } elseif ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        } elseif ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        return response()->json([
            'tickets' => $query->latest()->paginate(15),
        ]);
    }

    /**
     * Exibe o detalhe do ticket injetando a sugestão em tempo real da IA
     */
    public function show(Request $request, int $id)
    {
        $ticket = Ticket::with(['equipment.category', 'room', 'user', 'technician', 'status'])->findOrFail($id);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['ticket' => $ticket]);
        }

        $recomendacaoIA = $this->aiService->recomendarTecnico($ticket);

        return view('ui.ticket-detail', compact('ticket', 'recomendacaoIA'));
    }

    /**
     * Grava a alocação do técnico sugerido pela IA ou escolhido manualmente
     */
    public function atribuirTecnico(Request $request, int $id)
    {
        $request->validate([
            'tecnico_id' => 'required|exists:users,id',
        ]);

        $ticket = Ticket::findOrFail($id);
        $oldStatus = $ticket->status->name ?? '';

        $inProgressStatusId = Ticket::getStatusIdByName(Ticket::STATUS_IN_PROGRESS);

        $ticket->status_id = $inProgressStatusId;
        $ticket->assigned_to = $request->tecnico_id;
        $ticket->in_progress_at = now();
        $ticket->save();

        try {
            if ($ticket->user && $ticket->user->email) {
                $ticket->user->notify(new TicketStatusChanged($ticket, $oldStatus, Ticket::STATUS_IN_PROGRESS));
            }
            event(new TicketStatusUpdatedBroadcast($ticket, $oldStatus, Ticket::STATUS_IN_PROGRESS));
        } catch (\Exception $e) {
            // Silencia falhas de envio de mail em ambiente local
        }

        return response()->json(['ticket' => $ticket]);
    }

    /**
     * Associa explicitamente um técnico a um ticket (Apenas Administradores).
     */
    public function assignTechnician(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [
            User::ROLE_ADMIN,
        ]);

        $ticket = Ticket::findOrFail($id);

        $data = $request->only(['technician_id']);
        $validator = Validator::make($data, [
            'technician_id' => ['nullable', 'integer', 'exists:users,id'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (! empty($data['technician_id'])) {
            $technician = User::findOrFail($data['technician_id']);
            if (! $technician->isTechnician()) {
                return response()->json(['message' => 'Técnico inválido'], 422);
            }
        } else {
            $technician = Ticket::getLeastBusyTechnician();
            if (! $technician) {
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
        $this->requireRole($user, [
            User::ROLE_TECHNICIAN,
            User::ROLE_ADMIN,
        ]);

        $ticket = Ticket::findOrFail($id);

        if (! $ticket->reopen()) {
            return response()->json(['message' => 'Só é possível reabrir tickets fechados'], 422);
        }

        return response()->json(['ticket' => $ticket]);
    }

    /**
     * Cancela um ticket que ainda esteja em estado Aberto.
     */
    public function cancelTicket(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);

        if (! $user->isCommon()) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        $ticket = Ticket::findOrFail($id);

        if ($ticket->user_id !== $user->id) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        if (! $ticket->hasStatus(Ticket::STATUS_OPEN)) {
            return response()->json(['message' => 'Só é possível cancelar tickets abertos'], 403);
        }

        $cancelledStatusId = Ticket::getStatusIdByName(Ticket::STATUS_CANCELLED);
        $ticket->status_id = $cancelledStatusId;
        $ticket->closed_at = now();
        $ticket->save();

        return response()->json(['ticket' => $ticket]);
    }

    /**
     * Adiciona um comentário técnico ou de progresso ao ticket.
     */
    public function addComment(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);
        $ticket = Ticket::findOrFail($id);

        if ($user->isCommon() && (int) $ticket->user_id !== (int) $user->id) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        if (! $user->isCommon()) {
            $this->requireRole($user, [
                User::ROLE_TECHNICIAN,
                User::ROLE_ADMIN,
            ]);
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
     * Lista todos os comentários associados a um determinado ticket.
     */
    public function listComments(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [
            User::ROLE_TECHNICIAN,
            User::ROLE_ADMIN,
        ]);

        $ticket = Ticket::with(['comments.user'])->findOrFail($id);

        return response()->json(['comments' => $ticket->comments]);
    }

    /**
     * Faz o upload de um anexo fotográfico para o ticket.
     */
    public function uploadPhoto(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);
        $ticket = Ticket::findOrFail($id);

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
        $url = asset("storage/{$path}");

        $attachment = TicketAttachment::create([
            'ticket_id' => $ticket->id,
            'user_id'   => $user->id,
            'file_name' => $file->getClientOriginalName(),
            'path'      => $path,
            'mime_type' => $file->getClientMimeType(),
            'size'      => $file->getSize(),
        ]);

        return response()->json([
            'attachment' => $attachment,
            'url'        => $url,
        ], 201);
    }

    /**
     * Lista os anexos multimédia carregados no âmbito do ticket.
     */
    public function listPhotos(Request $request, int $id)
    {
        $this->authenticatedUser($request);

        $ticket = Ticket::with('attachments')->findOrFail($id);

        return response()->json(['attachments' => $ticket->attachments]);
    }

    /**
     * Remove uma fotografia/anexo do ticket.
     */
    public function deletePhoto(Request $request, int $id, int $photoId)
    {
        $user = $this->authenticatedUser($request);
        $ticket = Ticket::findOrFail($id);

        $attachment = TicketAttachment::where('ticket_id', $ticket->id)
            ->findOrFail($photoId);

        if ($user->isCommon() && (int) $attachment->user_id !== (int) $user->id) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        if (Storage::disk('public')->exists($attachment->path)) {
            Storage::disk('public')->delete($attachment->path);
        }

        $attachment->delete();

        return response()->json(['message' => 'Fotografia removida com sucesso.'], 200);
    }

    /**
     * Permite que um técnico ou administrador assuma (claim) o ticket.
     */
    public function claimTicket(Request $request, $id)
    {
        $ticket = Ticket::find($id);
        if (! $ticket) {
            return response()->json(['message' => 'Ticket não encontrado'], 404);
        }

        $user = auth()->user() ?? $this->authenticatedUser($request);

        if (Schema::hasColumn('tickets', 'assigned_to')) {
            $ticket->assigned_to = $user->id;
        } elseif (Schema::hasColumn('tickets', 'technician_id')) {
            $ticket->technician_id = $user->id;
        } elseif (Schema::hasColumn('tickets', 'tecnico_id')) {
            $ticket->tecnico_id = $user->id;
        }

        $inProgressId = Ticket::getStatusIdByName(Ticket::STATUS_IN_PROGRESS);
        if ($inProgressId) {
            $ticket->status_id = $inProgressId;
        } elseif (Schema::hasColumn('tickets', 'status')) {
            $ticket->status = 'em curso';
        }

        $ticket->in_progress_at = now();
        $ticket->save();

        return response()->json([
            'message' => 'Ticket assumido com sucesso',
            'ticket'  => $ticket->load(['equipment', 'room', 'technician', 'status'])
        ]);
    }

    /**
     * Inicia a reparação de um ticket.
     */
    public function startTicket(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [
            User::ROLE_TECHNICIAN,
            User::ROLE_ADMIN,
        ]);

        $ticket = Ticket::findOrFail($id);
        $oldStatus = $ticket->status->name ?? '';

        if (! $ticket->hasStatus(Ticket::STATUS_OPEN)) {
            return response()->json(['message' => 'Apenas tickets em estado "Aberto" podem ser iniciados.'], 422);
        }

        $priorityOrder = ['crítica' => 4, 'alta' => 3, 'média' => 2, 'baixa' => 1];
        $currentPriority = $priorityOrder[$ticket->priority] ?? 0;
        $force = $request->boolean('force', false);

        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);
        $higherPriorityTickets = Ticket::where('status_id', $openStatusId)
            ->where('id', '!=', $ticket->id)
            ->where(function ($q) use ($currentPriority, $priorityOrder) {
                foreach ($priorityOrder as $pName => $pVal) {
                    if ($pVal > $currentPriority) {
                        $q->orWhere('priority', $pName);
                    }
                }
            })
            ->count();

        if ($higherPriorityTickets > 0 && ! $force) {
            return response()->json([
                'warning'              => true,
                'message'              => "⚠️ Existem {$higherPriorityTickets} ticket(s) de prioridade mais alta por atender. Recomenda-se resolver os mais urgentes primeiro.",
                'urgent_tickets_count' => $higherPriorityTickets,
                'current_priority'     => $ticket->priority,
                'can_force'            => true,
            ], 409);
        }

        $inProgressStatusId = Ticket::getStatusIdByName(Ticket::STATUS_IN_PROGRESS);

        $ticket->update([
            'assigned_to'    => $user->id,
            'status_id'      => $inProgressStatusId,
            'in_progress_at' => now(),
        ]);

        if ($force && $higherPriorityTickets > 0) {
            try {
                $admins = User::whereHas('profile', function ($q) {
                    $q->where('name', User::ROLE_ADMIN);
                })->get();

                foreach ($admins as $admin) {
                    Notification::create([
                        'user_id' => $admin->id,
                        'title'   => "⚠️ Ticket Não Prioritário Iniciado - #{$ticket->id}",
                        'message' => "O técnico {$user->name} iniciou o ticket #{$ticket->id} ({$ticket->title}) com prioridade '{$ticket->priority}', ignorando {$higherPriorityTickets} ticket(s) mais urgente(s) pendentes.",
                        'type'    => 'priority_override',
                        'link'    => "/ui/tickets/{$ticket->id}",
                    ]);
                }
            } catch (\Exception $e) {
                // Silencia falhas
            }
        }

        try {
            event(new TicketStatusUpdatedBroadcast($ticket, $oldStatus, Ticket::STATUS_IN_PROGRESS));
            if ($ticket->user && $ticket->user->email) {
                $ticket->user->notify(new TicketStatusChanged($ticket, $oldStatus, Ticket::STATUS_IN_PROGRESS));
            }
        } catch (\Exception $e) {
            // Silencia falhas
        }

        return response()->json([
            'ticket'    => $ticket,
            'overridden' => $force && $currentPriority < 3,
        ]);
    }

    /**
     * Conclui de forma definitiva um ticket em curso.
     */
    public function closeTicket(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [
            User::ROLE_TECHNICIAN,
            User::ROLE_ADMIN,
        ]);

        $ticket = Ticket::findOrFail($id);
        $oldStatus = $ticket->status->name ?? '';

        if (! $ticket->hasStatus(Ticket::STATUS_IN_PROGRESS)) {
            return response()->json(['message' => 'Apenas tickets em "Em Curso" podem ser fechados.'], 422);
        }

        $request->validate([
            'minutes_spent'    => ['nullable', 'integer', 'min:0'],
            'cost'             => ['nullable', 'numeric', 'min:0'],
            'technical_report' => ['nullable', 'string', 'max:5000'],
        ]);

        $closedStatusId = Ticket::getStatusIdByName(Ticket::STATUS_CLOSED);

        $ticket->update([
            'status_id'        => $closedStatusId,
            'closed_at'        => now(),
            'minutes_spent'    => $request->minutes_spent,
            'cost'             => $request->cost,
            'technical_report' => $request->technical_report,
        ]);

        try {
            event(new TicketStatusUpdatedBroadcast($ticket, $oldStatus, Ticket::STATUS_CLOSED));
            if ($ticket->user && $ticket->user->email) {
                $ticket->user->notify(new TicketStatusChanged($ticket, $oldStatus, Ticket::STATUS_CLOSED));
            }
        } catch (\Exception $e) {
            // Silencia falhas
        }

        return response()->json(['ticket' => $ticket]);
    }

    /**
     * Agenda um ticket para uma data futura.
     */
    public function scheduleTicket(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);

        $ticket = Ticket::findOrFail($id);

        if ($user->isCommon() && (int) $ticket->user_id !== (int) $user->id) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        $validator = Validator::make($request->all(), [
            'scheduled_at'  => ['required', 'date', 'after:now'],
            'scheduled_end' => ['nullable', 'date', 'after:scheduled_at'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $ticket->update([
            'scheduled_at'  => $request->scheduled_at,
            'scheduled_end' => $request->scheduled_end,
            'scheduled'     => true,
        ]);

        return response()->json(['ticket' => $ticket]);
    }

    /**
     * Lista tickets abertos para o dashboard do técnico.
     */
    public function openTickets(Request $request)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [
            User::ROLE_TECHNICIAN,
            User::ROLE_ADMIN,
        ]);

        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $tickets = Ticket::with(['equipment', 'room', 'user', 'status'])
            ->where('status_id', $openStatusId)
            ->latest()
            ->paginate(15);

        return response()->json(['tickets' => $tickets]);
    }

    public function calendarView(Request $request)
    {
        $user = $this->authenticatedUser($request);

        return view('calendar', ['user' => $user]);
    }

    /**
     * Retorna os eventos do calendário em formato JSON.
     */
    public function calendarEvents(Request $request)
    {
        $user = $this->authenticatedUser($request);
        $events = Ticket::getScheduledEvents();

        return response()->json($events);
    }

    /**
     * Cria notificações de orçamento.
     */
    private function notifyBudgetEvent(Ticket $ticket, string $eventType, string $message): void
    {
        try {
            if ($eventType === 'submitted') {
                $admins = User::whereHas('profile', function ($q) {
                    $q->where('name', User::ROLE_ADMIN);
                })->get();
                foreach ($admins as $admin) {
                    Notification::create([
                        'user_id' => $admin->id,
                        'title'   => "💰 Orçamento Pendente - Ticket #{$ticket->id}",
                        'message' => $message,
                        'type'    => 'budget_request',
                        'link'    => "/ui/tickets/{$ticket->id}",
                    ]);
                }
                if ($ticket->user_id) {
                    Notification::create([
                        'user_id' => $ticket->user_id,
                        'title'   => "📋 Orçamento Submetido - Ticket #{$ticket->id}",
                        'message' => $message,
                        'type'    => 'budget_submitted',
                        'link'    => "/ui/tickets/{$ticket->id}",
                    ]);
                }
            } elseif ($eventType === 'auto_approved') {
                if ($ticket->assigned_to) {
                    Notification::create([
                        'user_id' => $ticket->assigned_to,
                        'title'   => "✅ Auto-Aprovado - Ticket #{$ticket->id}",
                        'message' => $message,
                        'type'    => 'budget_auto_approved',
                        'link'    => "/ui/tickets/{$ticket->id}",
                    ]);
                }
                if ($ticket->user_id) {
                    Notification::create([
                        'user_id' => $ticket->user_id,
                        'title'   => "✅ Orçamento Auto-Aprovado - Ticket #{$ticket->id}",
                        'message' => $message,
                        'type'    => 'budget_auto_approved',
                        'link'    => "/ui/tickets/{$ticket->id}",
                    ]);
                }
            } elseif (in_array($eventType, ['approved', 'rejected'])) {
                if ($ticket->assigned_to) {
                    $icon = $eventType === 'approved' ? '✅' : '❌';
                    Notification::create([
                        'user_id' => $ticket->assigned_to,
                        'title'   => "{$icon} Orçamento ".($eventType === 'approved' ? 'Aprovado' : 'Recusado')." - Ticket #{$ticket->id}",
                        'message' => $message,
                        'type'    => "budget_{$eventType}",
                        'link'    => "/ui/tickets/{$ticket->id}",
                    ]);
                }
                if ($ticket->user_id) {
                    Notification::create([
                        'user_id' => $ticket->user_id,
                        'title'   => "📋 Decisão Orçamental - Ticket #{$ticket->id}",
                        'message' => $message,
                        'type'    => "budget_{$eventType}",
                        'link'    => "/ui/tickets/{$ticket->id}",
                    ]);
                }
            } elseif ($eventType === 'closed') {
                if ($ticket->user_id) {
                    Notification::create([
                        'user_id' => $ticket->user_id,
                        'title'   => "🔧 Ticket Fechado - #{$ticket->id}",
                        'message' => $message,
                        'type'    => 'ticket_closed',
                        'link'    => "/ui/tickets/{$ticket->id}",
                    ]);
                }
            }
        } catch (\Exception $e) {
            // Silencia falhas de notificação
        }
    }

    /**
     * Submete o custo estimado pelo técnico e aciona o fluxo orçamental.
     */
    public function submitEstimatedBudget(Request $request, int $id)
    {
        try {
            $user = $this->authenticatedUser($request);

            $request->validate([
                'estimatedBudget'              => 'required|numeric|min:0.01',
                'budget_details'               => 'nullable|array',
                'budget_details.*.description' => 'required_with:budget_details|string|max:255',
                'budget_details.*.type'        => 'nullable|string|in:material,labor',
                'budget_details.*.quantity'    => 'nullable|numeric|min:0',
                'budget_details.*.unit_price'  => 'nullable|numeric|min:0',
            ]);

            $ticket = Ticket::findOrFail($id);
            $estimatedBudget = (float) $request->estimatedBudget;
            $threshold = 100.00; // Limite de autonomia (100.00€)

            if (Schema::hasColumn('tickets', 'budget_details') && $request->has('budget_details')) {
                $ticket->budget_details = is_array($request->budget_details) ? json_encode($request->budget_details) : $request->budget_details;
            }

            if (! $ticket->assigned_to) {
                $ticket->assigned_to = $user->id;
            }

            if (Schema::hasColumn('tickets', 'budget_requested')) {
                $ticket->budget_requested = true;
            }
            if (Schema::hasColumn('tickets', 'budget_amount')) {
                $ticket->budget_amount = $estimatedBudget;
            }

            if ($estimatedBudget > $threshold) {
                if (Schema::hasColumn('tickets', 'budget_status')) {
                    $ticket->budget_status = Ticket::BUDGET_PENDING;
                }
                if (Schema::hasColumn('tickets', 'budget_requested_at')) {
                    $ticket->budget_requested_at = now();
                }

                $pendingStatusId = Ticket::getStatusIdByName(Ticket::STATUS_PENDING_BUDGET);
                if ($pendingStatusId) {
                    $ticket->status_id = $pendingStatusId;
                }

                $ticket->save();

                $this->notifyBudgetEvent($ticket, 'submitted',
                    "O técnico submeteu um orçamento de {$estimatedBudget}€ para o ticket #{$ticket->id} - {$ticket->title}. Aguarda aprovação."
                );

                return response()->json([
                    'message' => __('Orçamento enviado com sucesso. Aguarda aprovação do Administrador.'),
                    'ticket'  => $ticket->load(['equipment', 'room', 'technician', 'status']),
                ]);
            }

            // Abaixo do threshold -> Auto-aprovado
            if (Schema::hasColumn('tickets', 'budget_status')) {
                $ticket->budget_status = 'approved';
            }
            $inProgressId = Ticket::getStatusIdByName(Ticket::STATUS_IN_PROGRESS);
            if ($inProgressId) {
                $ticket->status_id = $inProgressId;
            }
            $ticket->save();

            $this->notifyBudgetEvent($ticket, 'auto_approved',
                "Orçamento de {$estimatedBudget}€ para o ticket #{$ticket->id} foi auto-aprovado (dentro da autonomia de {$threshold}€)."
            );

            return response()->json([
                'message' => __('Orçamento aprovado automaticamente. Pode prosseguir com a intervenção.'),
                'ticket'  => $ticket->load(['equipment', 'room', 'technician', 'status']),
            ]);

        } catch (\Illuminate\Validation\ValidationException $ve) {
            return response()->json(['message' => 'Por favor verifique os campos do orçamento.', 'errors' => $ve->errors()], 422);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Erro ao processar orçamento no servidor: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Técnico solicita autorização orçamental.
     */
    public function requestBudget(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_TECHNICIAN, User::ROLE_ADMIN]);

        $request->validate([
            'budget_amount'                => 'required|numeric|min:0.01',
            'budget_details'               => 'nullable|array',
            'budget_details.*.description' => 'required_with:budget_details|string|max:255',
            'budget_details.*.quantity'    => 'required_with:budget_details|numeric|min:1',
            'budget_details.*.unit_price'  => 'required_with:budget_details|numeric|min:0',
        ]);

        $ticket = Ticket::findOrFail($id);
        $threshold = 100.00;

        $estimatedBudget = $request->budget_amount;

        if ($request->has('budget_details')) {
            $ticket->budget_details = $request->budget_details;
        }

        if ($estimatedBudget > $threshold) {
            $ticket->budget_requested = true;
            $ticket->budget_status = Ticket::BUDGET_PENDING;
            $ticket->budget_amount = $estimatedBudget;
            $ticket->budget_requested_at = now();

            $pendingStatusId = Ticket::getStatusIdByName(Ticket::STATUS_PENDING_BUDGET);
            if ($pendingStatusId) {
                $ticket->status_id = $pendingStatusId;
            }

            $ticket->save();

            return response()->json([
                'message' => __('Pedido de orçamento submetido com detalhes. Aguarde aprovação.'),
                'ticket'  => $ticket->load(['equipment', 'room', 'technician', 'status']),
            ]);
        }

        $inProgressId = Ticket::getStatusIdByName(Ticket::STATUS_IN_PROGRESS);
        if ($inProgressId) {
            $ticket->status_id = $inProgressId;
        }
        $ticket->save();

        return response()->json([
            'message' => __('Custo dentro do limiar. Intervenção autorizada automaticamente.'),
            'ticket'  => $ticket->load(['equipment', 'room', 'technician', 'status']),
        ]);
    }

    /**
     * Finaliza o ticket com custo final e relatório técnico.
     */
    public function closeTicketFinal(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_TECHNICIAN, User::ROLE_ADMIN]);

        $request->validate([
            'actual_cost' => 'required|numeric|min:0',
            'report'      => 'nullable|string|max:5000',
        ]);

        $ticket = Ticket::findOrFail($id);

        $closedStatusId = Ticket::getStatusIdByName(Ticket::STATUS_CLOSED);
        if (! $closedStatusId) {
            return response()->json(['message' => __('Estado "fechada" não encontrado.')], 500);
        }

        $ticket->status_id = $closedStatusId;
        $ticket->cost = $request->actual_cost;
        $ticket->technical_report = $request->report ?? $ticket->technical_report;
        $ticket->closed_at = now();
        $ticket->save();

        $this->notifyBudgetEvent($ticket, 'closed',
            "O ticket #{$ticket->id} - {$ticket->title} foi concluído e fechado com custo final de {$request->actual_cost}€."
        );

        return response()->json([
            'message' => __('Intervenção concluída e ticket fechado com sucesso.'),
            'ticket'  => $ticket->load(['equipment', 'room', 'technician', 'status']),
        ]);
    }

    /**
     * Permite que um técnico devolva/liberte uma ocorrência previamente assumida.
     */
    public function releaseTicket(Request $request, int $id)
    {
        $ticket = Ticket::findOrFail($id);

        $ticket->assigned_to = null;
        if (Schema::hasColumn('tickets', 'technician_id')) {
            $ticket->technician_id = null;
        }
        if (Schema::hasColumn('tickets', 'tecnico_id')) {
            $ticket->tecnico_id = null;
        }

        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);
        if ($openStatusId) {
            $ticket->status_id = $openStatusId;
        }

        $ticket->budget_requested = false;
        $ticket->budget_status = null;
        $ticket->save();

        return response()->json([
            'message' => 'Ocorrência libertada com sucesso.',
            'ticket'  => $ticket
        ]);
    }
}