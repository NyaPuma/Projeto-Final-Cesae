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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    use ControllerHelpers;

    // The property is declared and assigned automatically here!
    public function __construct(
        protected AIService $aiService
    ) {}

    /**
     * Lista os tickets na view index
     */
    public function index(Request $request)
    {
        $query = Ticket::with(['equipment', 'room', 'technician', 'status']);

        // Filtro de busca simples por termo
        if ($request->has('q') && ! empty($request->q)) {
            $q = str_replace(['%', '_'], ['\%', '\_'], $request->q);
            $query->where('title', 'like', '%'.$q.'%');
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

        $validator = Validator::make($data, [
            'title'        => ['required', 'string', 'max:255'],
            'description'  => ['required', 'string', 'max:5000'],
            'priority'     => ['required', 'string', 'in:baixa,média,media,alta,critica,crítica'],
            'equipment_id' => ['nullable', 'integer', 'exists:equipments,id'],
            'room_id'      => ['nullable', 'integer', 'exists:rooms,id'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Normalizar 'media' para 'média' e 'critica' para 'crítica' (aceitar ambos os valores do frontend)
        $priority = $data['priority'];
        if ($priority === 'media') {
            $priority = 'média';
        } elseif ($priority === 'critica') {
            $priority = 'crítica';
        }

        // Obter o ID do status 'aberta'
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $ticket = Ticket::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'priority' => $priority,
            'user_id' => $user->id,
            'equipment_id' => $data['equipment_id'] ?? null,
            'room_id' => $data['room_id'] ?? null,
            'status_id' => $openStatusId,
            'opened_at' => now(),
        ]);

        // Carregar relacionamentos para a resposta
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
            $q = str_replace(['%', '_'], ['\%', '\_'], $request->q);
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
        $user = $this->authenticatedUser($request);

        // Procura o ticket trazendo os relacionamentos exatos do teu projeto
        $ticket = Ticket::with(['equipment.category', 'room', 'user', 'technician', 'status'])->findOrFail($id);

        // IDOR: utilizadores comuns só podem ver os próprios tickets
        if ($user && $user->isCommon() && (int) $ticket->user_id !== (int) $user->id) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['message' => 'Acesso negado'], 403);
            }

            abort(403);
        }

        // Se o pedido vier do teu frontend em JS (Accept: application/json ou AJAX)
        if ($request->wantsJson() || $request->ajax()) {
            // CORREÇÃO AQUI: Enviamos o objeto dentro da chave 'ticket'
            return response()->json(['ticket' => $ticket]);
        }

        // Caso contrário (acesso direto do Admin à página), carrega a recomendação da IA e a View
        $recomendacaoIA = $this->aiService->recomendarTecnico($ticket);

        return view('ui.ticket-detail', compact('ticket', 'recomendacaoIA'));
    }

    /**
     * Grava a alocação do técnico sugerido pela IA ou escolhido manualmente
     */
    public function atribuirTecnico(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_TECHNICIAN, User::ROLE_ADMIN]);

        $request->validate([
            'tecnico_id' => 'required|exists:users,id',
        ]);

        $ticket = Ticket::findOrFail($id);
        $oldStatus = $ticket->status->name ?? '';

        // Vai buscar dinamicamente o ID do estado "Em Curso" definido no teu Model
        $inProgressStatusId = Ticket::getStatusIdByName(Ticket::STATUS_IN_PROGRESS);

        // CORRIGIDO: Atribuição usando o técnico validado da requisição
        $ticket->status_id = $inProgressStatusId;
        $ticket->assigned_to = $request->tecnico_id;
        $ticket->in_progress_at = now();
        $ticket->save();

        // Notificamos o criador para manter o fluxo visível em tempo real e por email.
        try {
            if ($ticket->user && $ticket->user->email) {
                $ticket->user->notify(new TicketStatusChanged($ticket, $oldStatus, Ticket::STATUS_IN_PROGRESS));
            }
            event(new TicketStatusUpdatedBroadcast($ticket, $oldStatus, Ticket::STATUS_IN_PROGRESS));
        } catch (\Exception $e) {
            // Silencia falhas de envio de mail em ambiente de teste local
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

        // Regra de autorização:
        // - ROLE_TECHNICIAN / ROLE_ADMIN: podem comentar qualquer ticket.
        // - ROLE_USER (common): só podem comentar o próprio ticket.
        if ($user->isCommon() && (int) $ticket->user_id !== (int) $user->id) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        // Valida role adicional apenas para utilizadores que não são common.
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
            'user_id' => $user->id,
            'comment' => $data['comment'],
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
     * Faz o upload de um anexo fotográfico ou evidência para o ticket.
     */
    public function uploadPhoto(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);
        $ticket = Ticket::findOrFail($id);

        // Regra de autorização:
        // - ROLE_USER (common): só podem fazer upload no próprio ticket.
        // - ROLE_TECHNICIAN / ROLE_ADMIN: podem anexar em qualquer ticket.
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

        // Validação server-side do MIME type ANTES de gravar no disco (não confiar no header do cliente)
        $realMime = $file->getMimeType();
        $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (! in_array($realMime, $allowedMimes)) {
            return response()->json(['message' => 'Tipo de ficheiro não permitido'], 422);
        }

        $path = $file->store('ticket_photos', 'public');
        $url = asset("storage/{$path}");

        // Nome seguro: UUID + extensão real (não usargetClientOriginalName())
        $extension = $file->getClientOriginalExtension();
        $safeFilename = \Illuminate\Support\Str::uuid() . '.' . $extension;

        $attachment = TicketAttachment::create([
            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
            'file_name' => $safeFilename,
            'path' => $path,
            'mime_type' => $realMime,
            'size' => $file->getSize(),
        ]);

        return response()->json([
            'attachment' => $attachment,
            'url' => $url,
        ], 201);
    }

    /**
     * Lista os anexos multimédia carregados no âmbito do ticket.
     */
    public function listPhotos(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);

        $ticket = Ticket::with('attachments')->findOrFail($id);

        // Regra de autorização:
        // - ROLE_TECHNICIAN / ROLE_ADMIN: podem listar fotos de qualquer ticket.
        // - ROLE_USER (common): só podem listar fotos do próprio ticket.
        if ($user->isCommon() && (int) $ticket->user_id !== (int) $user->id) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        return response()->json(['attachments' => $ticket->attachments]);
    }

    /**
     * Remove uma fotografia/anexo do ticket (Evidências Fotográficas).
     * Elimina o ficheiro físico do disco e o registo da base de dados.
     */
    public function deletePhoto(Request $request, int $id, int $photoId)
    {
        $user = $this->authenticatedUser($request);
        $ticket = Ticket::findOrFail($id);

        $attachment = TicketAttachment::where('ticket_id', $ticket->id)
            ->findOrFail($photoId);

        // Regra de autorização:
        // - ROLE_ADMIN / ROLE_TECHNICIAN: podem remover qualquer foto.
        // - ROLE_USER (common): só pode remover as suas próprias fotos.
        if ($user->isCommon() && (int) $attachment->user_id !== (int) $user->id) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        // Apaga o ficheiro físico do storage
        if (Storage::disk('public')->exists($attachment->path)) {
            Storage::disk('public')->delete($attachment->path);
        }

        // Apaga o registo da base de dados
        $attachment->delete();

        return response()->json(['message' => 'Fotografia removida com sucesso.'], 200);
    }

    /**
     * Inicia a reparação de um ticket (Técnico assume o ticket como "Em Curso").
     *
     * Se existirem tickets de prioridade mais alta pendentes, o sistema avisa o técnico.
     * Se o técnico forçar (force=true), o admin é notificado da decisão.
     */
    public function startTicket(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [
            User::ROLE_TECHNICIAN,
        ]);

        $ticket = Ticket::findOrFail($id);
        $oldStatus = $ticket->status->name ?? '';

        if (! $ticket->hasStatus(Ticket::STATUS_OPEN)) {
            return response()->json(['message' => 'Apenas tickets em estado "Aberto" podem ser iniciados.'], 422);
        }

        // 🔔 VERIFICAÇÃO DE URGÊNCIA: Existem tickets de prioridade mais alta pendentes?
        $priorityOrder = ['crítica' => 4, 'alta' => 3, 'média' => 2, 'baixa' => 1];
        $currentPriority = $priorityOrder[$ticket->priority] ?? 0;
        $force = $request->boolean('force', false);

        // Procurar tickets abertos com prioridade superior à atual
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);
        $higherPriorityQuery = Ticket::where('status_id', $openStatusId)
            ->where('id', '!=', $ticket->id)
            ->where(function ($q) use ($currentPriority, $priorityOrder) {
                foreach ($priorityOrder as $pName => $pVal) {
                    if ($pVal > $currentPriority) {
                        $q->orWhere('priority', $pName);
                    }
                }
            });

        // Total de tickets mais urgentes no sistema
        $higherPriorityTickets = (clone $higherPriorityQuery)->count();

        // Tickets mais urgentes especificamente atribuídos a este técnico
        $myHigherPriorityTickets = (clone $higherPriorityQuery)
            ->where('assigned_to', $user->id)
            ->count();

        if ($higherPriorityTickets > 0 && ! $force) {
            $msg = "⚠️ Existem {$higherPriorityTickets} ticket(s) de prioridade mais alta por atender.";
            if ($myHigherPriorityTickets > 0) {
                $msg .= " Destes, {$myHigherPriorityTickets} estão atribuídos a si.";
            }
            $msg .= " Recomenda-se resolver os mais urgentes primeiro.";

            return response()->json([
                'warning' => true,
                'message' => $msg,
                'urgent_tickets_count' => $higherPriorityTickets,
                'my_urgent_tickets_count' => $myHigherPriorityTickets,
                'current_priority' => $ticket->priority,
                'can_force' => true,
            ], 409); // 409 Conflict - indica que há conflito de prioridades
        }

        $inProgressStatusId = Ticket::getStatusIdByName(Ticket::STATUS_IN_PROGRESS);

        $ticket->update([
            'assigned_to' => $user->id,
            'status_id' => $inProgressStatusId,
            'in_progress_at' => now(),
        ]);

        // 🔔 Se o técnico forçou o início mesmo havendo tickets mais urgentes, notificar o admin
        if ($force && ($higherPriorityTickets > 0 || $myHigherPriorityTickets > 0)) {
            $totalUrgent = max($higherPriorityTickets, $myHigherPriorityTickets);
            try {
                $admins = User::whereHas('profile', function ($q) {
                    $q->where('name', User::ROLE_ADMIN);
                })->get();

                foreach ($admins as $admin) {
                    Notification::create([
                        'user_id' => $admin->id,
                        'title' => "⚠️ Ticket Não Prioritário Iniciado - #{$ticket->id}",
                        'message' => "O técnico {$user->name} iniciou o ticket #{$ticket->id} ({$ticket->title}) com prioridade '{$ticket->priority}', ignorando {$totalUrgent} ticket(s) mais urgente(s) pendentes ({$myHigherPriorityTickets} atribuídos a si).",
                        'type' => 'priority_override',
                        'link' => "/ui/tickets/{$ticket->id}",
                    ]);
                }
            } catch (\Exception $e) {
                // Silencia falhas de notificação
            }
        }

        try {
            event(new TicketStatusUpdatedBroadcast($ticket, $oldStatus, Ticket::STATUS_IN_PROGRESS));
            if ($ticket->user && $ticket->user->email) {
                $ticket->user->notify(new TicketStatusChanged($ticket, $oldStatus, Ticket::STATUS_IN_PROGRESS));
            }
        } catch (\Exception $e) {
            // Silencia falhas de envio
        }

        return response()->json([
            'ticket' => $ticket,
            'overridden' => $force && $higherPriorityTickets > 0,
        ]);
    }

    /**
     * Retorna o ID do ticket aberto mais prioritário (para redirecionamento).
     * Prioridade: crítica > alta > média > baixa.
     * Em caso de empate, retorna o mais antigo (aberto há mais tempo).
     * Compatível com SQLite e MySQL.
     */
    public function getMostUrgentOpenTicket(Request $request)
    {
        $user = $this->authenticatedUser($request);

        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);
        $excludeId = (int) $request->input('exclude', 0);

        // Ordem de prioridade numérica para compatibilidade com SQLite
        $priorityMap = ['crítica' => 0, 'alta' => 1, 'média' => 2, 'baixa' => 3];

        $ticket = Ticket::where('status_id', $openStatusId)
            ->where('id', '!=', $excludeId)
            ->get()
            ->sort(function ($a, $b) use ($priorityMap) {
                // 1º critério: Prioridade (crítica=0, alta=1, média=2, baixa=3)
                $aPriority = $priorityMap[$a->priority] ?? 99;
                $bPriority = $priorityMap[$b->priority] ?? 99;
                if ($aPriority !== $bPriority) {
                    return $aPriority <=> $bPriority;
                }
                // 2º critério: Mais antigo primeiro (created_at ASC)
                return $a->created_at <=> $b->created_at;
            })
            ->first();

        if (! $ticket) {
            return response()->json(['ticket_id' => null, 'message' => __('Não existem tickets abertos prioritários.')], 404);
        }

        return response()->json([
            'ticket_id' => $ticket->id,
            'title' => $ticket->title,
            'priority' => $ticket->priority,
        ]);
    }

    /**
     * Conclui de forma definitiva um ticket em curso, registando tempos e custos operacionais.
     */
    public function closeTicket(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [
            User::ROLE_TECHNICIAN,
        ]);

        $ticket = Ticket::findOrFail($id);
        $oldStatus = $ticket->status->name ?? '';

        if (! $ticket->hasStatus(Ticket::STATUS_IN_PROGRESS)) {
            return response()->json(['message' => 'Apenas tickets em "Em Curso" podem ser fechados.'], 422);
        }

        $request->validate([
            'minutes_spent' => ['nullable', 'integer', 'min:0'],
            'cost' => ['nullable', 'numeric', 'min:0'],
            'technical_report' => ['nullable', 'string', 'max:5000'],
        ]);

        $closedStatusId = Ticket::getStatusIdByName(Ticket::STATUS_CLOSED);

        $ticket->update([
            'status_id' => $closedStatusId,
            'closed_at' => now(),
            'minutes_spent' => $request->minutes_spent,
            'cost' => $request->cost,
            'technical_report' => $request->technical_report,
        ]);

        try {
            event(new TicketStatusUpdatedBroadcast($ticket, $oldStatus, Ticket::STATUS_CLOSED));
            if ($ticket->user && $ticket->user->email) {
                $ticket->user->notify(new TicketStatusChanged($ticket, $oldStatus, Ticket::STATUS_CLOSED));
            }
        } catch (\Exception $e) {
            // Silencia falhas de envio
        }

        return response()->json(['ticket' => $ticket]);
    }

    /**
     * Agenda um ticket para uma data futura (Operador ou Admin).
     */
    public function scheduleTicket(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);

        $ticket = Ticket::findOrFail($id);

        if ($user->isCommon() && (int) $ticket->user_id !== (int) $user->id) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        $validator = Validator::make($request->only(['scheduled_at', 'scheduled_end']), [
            'scheduled_at' => ['required', 'date', 'after:now'],
            'scheduled_end' => ['nullable', 'date', 'after:scheduled_at'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $ticket->update([
            'scheduled_at' => $request->scheduled_at,
            'scheduled_end' => $request->scheduled_end,
            'scheduled' => true,
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
     * Retorna os eventos do calendário (tickets programados com scheduled_at) em formato JSON.
     */
    public function calendarEvents(Request $request)
    {
        $user = $this->authenticatedUser($request);
        $events = Ticket::getScheduledEvents();

        return response()->json($events);
    }

    /**
     * Cria notificações de orçamento para os utilizadores relevantes.
     * - submitted: notifica TODOS os admins + criador do ticket
     * - approved/rejected: notifica técnico atribuído + criador
     * - auto_approved: notifica técnico + criador
     * - closed: notifica criador
     */
    private function notifyBudgetEvent(Ticket $ticket, string $eventType, string $message): void
    {
        try {
            if ($eventType === 'submitted') {
                // Notificar todos os admins
                $admins = User::whereHas('profile', function ($q) {
                    $q->where('name', User::ROLE_ADMIN);
                })->get();
                foreach ($admins as $admin) {
                    Notification::create([
                        'user_id' => $admin->id,
                        'title' => "💰 Orçamento Pendente - Ticket #{$ticket->id}",
                        'message' => $message,
                        'type' => 'budget_request',
                        'link' => "/ui/tickets/{$ticket->id}",
                    ]);
                }
                // Também notificar criador
                if ($ticket->user_id) {
                    Notification::create([
                        'user_id' => $ticket->user_id,
                        'title' => "📋 Orçamento Submetido - Ticket #{$ticket->id}",
                        'message' => $message,
                        'type' => 'budget_submitted',
                        'link' => "/ui/tickets/{$ticket->id}",
                    ]);
                }
            } elseif ($eventType === 'auto_approved') {
                // Notificar técnico
                if ($ticket->assigned_to) {
                    Notification::create([
                        'user_id' => $ticket->assigned_to,
                        'title' => "✅ Auto-Aprovado - Ticket #{$ticket->id}",
                        'message' => $message,
                        'type' => 'budget_auto_approved',
                        'link' => "/ui/tickets/{$ticket->id}",
                    ]);
                }
                // Notificar criador
                if ($ticket->user_id) {
                    Notification::create([
                        'user_id' => $ticket->user_id,
                        'title' => "✅ Orçamento Auto-Aprovado - Ticket #{$ticket->id}",
                        'message' => $message,
                        'type' => 'budget_auto_approved',
                        'link' => "/ui/tickets/{$ticket->id}",
                    ]);
                }
            } elseif (in_array($eventType, ['approved', 'rejected'])) {
                // Notificar o técnico
                if ($ticket->assigned_to) {
                    $icon = $eventType === 'approved' ? '✅' : '❌';
                    Notification::create([
                        'user_id' => $ticket->assigned_to,
                        'title' => "{$icon} Orçamento ".($eventType === 'approved' ? 'Aprovado' : 'Recusado')." - Ticket #{$ticket->id}",
                        'message' => $message,
                        'type' => "budget_{$eventType}",
                        'link' => "/ui/tickets/{$ticket->id}",
                    ]);
                }
                // Notificar criador
                if ($ticket->user_id) {
                    Notification::create([
                        'user_id' => $ticket->user_id,
                        'title' => "📋 Decisão Orçamental - Ticket #{$ticket->id}",
                        'message' => $message,
                        'type' => "budget_{$eventType}",
                        'link' => "/ui/tickets/{$ticket->id}",
                    ]);
                }
            } elseif ($eventType === 'closed') {
                // Notificar criador que o ticket foi fechado
                if ($ticket->user_id) {
                    Notification::create([
                        'user_id' => $ticket->user_id,
                        'title' => "🔧 Ticket Fechado - #{$ticket->id}",
                        'message' => $message,
                        'type' => 'ticket_closed',
                        'link' => "/ui/tickets/{$ticket->id}",
                    ]);
                }
            }
        } catch (\Exception $e) {
            // Silencia falhas de notificação
        }
    }

    /**
     * Submete o custo estimado pelo técnico e aciona o fluxo orçamental.
     * Se o custo exceder o threshold, o ticket fica "Pendente Orçamento".
     * Rota: POST /tickets/{id}/budget
     */
    public function submitEstimatedBudget(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_TECHNICIAN, User::ROLE_ADMIN]);

        $request->validate([
            'estimatedBudget' => 'required|numeric|min:0.01',
            'budget_details' => 'nullable|array',
            'budget_details.*.description' => 'required_with:budget_details|string|max:255',
            'budget_details.*.type' => 'nullable|string|in:material,labor',
            'budget_details.*.quantity' => 'nullable|numeric|min:0',
            'budget_details.*.unit_price' => 'nullable|numeric|min:0',
            'budget_details.*.hours' => 'nullable|numeric|min:0',
            'budget_details.*.hourly_rate' => 'nullable|numeric|min:0',
        ]);

        $ticket = Ticket::findOrFail($id);
        $estimatedBudget = $request->estimatedBudget;
        $threshold = 50.00; // Threshold financeiro (pode vir de configuração)

        // Guarda os detalhes do orçamento se fornecidos
        if ($request->has('budget_details')) {
            $ticket->budget_details = $request->budget_details;
        }

        // 🐛 FIX: Garantir que o técnico fica atribuído ao ticket
        // para receber notificações quando o admin aprovar/recusar o orçamento
        if (! $ticket->assigned_to) {
            $ticket->assigned_to = $user->id;
        }

        // 🐛 FIX: Marcar budget_requested=true em AMBOS os casos para
        // que o frontend saiba que o orçamento já foi processado.
        $ticket->budget_requested = true;
        $ticket->budget_amount = $estimatedBudget;

        if ($estimatedBudget > $threshold) {
            // Acima do threshold → solicita autorização
            $ticket->budget_status = Ticket::BUDGET_PENDING;
            $ticket->budget_requested_at = now();

            $pendingStatusId = Ticket::getStatusIdByName(Ticket::STATUS_PENDING_BUDGET);
            if ($pendingStatusId) {
                $ticket->status_id = $pendingStatusId;
            }

            $ticket->save();

            // 🔔 Notificar admins
            $this->notifyBudgetEvent($ticket, 'submitted',
                "O técnico submeteu um orçamento de {$estimatedBudget}€ para o ticket #{$ticket->id} - {$ticket->title}. Aguarda aprovação."
            );

            return response()->json([
                'message' => __('Custo estimado excede o limiar. Ticket pendente de aprovação orçamental.'),
                'ticket' => $ticket->load(['equipment', 'room', 'technician', 'status']),
            ]);
        }

        // Abaixo do threshold → autonomia do técnico (mantém estado Em Curso)
        $ticket->budget_status = null; // auto-aprovado (sem intervenção do admin)
        $inProgressId = Ticket::getStatusIdByName(Ticket::STATUS_IN_PROGRESS);
        if ($inProgressId) {
            $ticket->status_id = $inProgressId;
        }
        $ticket->save();

        // 🔔 Notificar técnico e criador sobre auto-aprovação
        $this->notifyBudgetEvent($ticket, 'auto_approved',
            "Orçamento de {$estimatedBudget}€ para o ticket #{$ticket->id} foi auto-aprovado (dentro do limiar de {$threshold}€). Pode prosseguir."
        );

        return response()->json([
            'message' => __('Custo estimado dentro da autonomia. Pode prosseguir com a intervenção.'),
            'ticket' => $ticket->load(['equipment', 'room', 'technician', 'status']),
        ]);
    }

    /**
     * Técnico solicita autorização orçamental com orçamento detalhado.
     * Rota: PUT /technician/tickets/{id}/request-budget
     */
    public function requestBudget(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_TECHNICIAN, User::ROLE_ADMIN]);

        $request->validate([
            'budget_amount' => 'required|numeric|min:0.01',
            'budget_details' => 'nullable|array',
            'budget_details.*.description' => 'required_with:budget_details|string|max:255',
            'budget_details.*.quantity' => 'required_with:budget_details|numeric|min:1',
            'budget_details.*.unit_price' => 'required_with:budget_details|numeric|min:0',
        ]);

        $ticket = Ticket::findOrFail($id);
        $threshold = 50.00;

        $estimatedBudget = $request->budget_amount;

        // Guarda detalhes do orçamento
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
                'ticket' => $ticket->load(['equipment', 'room', 'technician', 'status']),
            ]);
        }

        $inProgressId = Ticket::getStatusIdByName(Ticket::STATUS_IN_PROGRESS);
        if ($inProgressId) {
            $ticket->status_id = $inProgressId;
        }
        $ticket->save();

        return response()->json([
            'message' => __('Custo dentro do limiar. Intervenção autorizada automaticamente.'),
            'ticket' => $ticket->load(['equipment', 'room', 'technician', 'status']),
        ]);
    }

    /**
     * Finaliza o ticket com custo final e relatório técnico.
     * Se existirem tickets de prioridade mais alta pendentes, o sistema avisa o técnico.
     * Se o técnico forçar (force=true), o admin é notificado da decisão.
     * Rota: POST /tickets/{id}/close
     */
    public function closeTicketFinal(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_TECHNICIAN, User::ROLE_ADMIN]);

        $request->validate([
            'actual_cost' => 'required|numeric|min:0',
            'report' => 'nullable|string|max:5000',
            'force' => 'nullable|boolean',
        ]);

        $ticket = Ticket::findOrFail($id);

        // 🔔 VERIFICAÇÃO DE URGÊNCIA: Existem tickets de prioridade mais alta pendentes?
        // (Apenas se o técnico não estiver a forçar o fecho)
        $force = $request->boolean('force', false);

        if (! $force) {
            $priorityOrder = ['crítica' => 4, 'alta' => 3, 'média' => 2, 'baixa' => 1];
            $currentPriority = $priorityOrder[$ticket->priority] ?? 0;

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

            if ($higherPriorityTickets > 0) {
                return response()->json([
                    'warning' => true,
                    'message' => "⚠️ Existem {$higherPriorityTickets} ticket(s) de prioridade mais alta por atender. Recomenda-se resolver os mais urgentes primeiro antes de fechar este ticket.",
                    'urgent_tickets_count' => $higherPriorityTickets,
                    'current_priority' => $ticket->priority,
                    'can_force' => true,
                ], 409);
            }
        }

        $closedStatusId = Ticket::getStatusIdByName(Ticket::STATUS_CLOSED);
        if (! $closedStatusId) {
            return response()->json(['message' => __('Estado "fechada" não encontrado.')], 500);
        }

        $ticket->status_id = $closedStatusId;
        $ticket->cost = $request->actual_cost;
        $ticket->technical_report = $request->report ?? $ticket->technical_report;
        $ticket->closed_at = now();
        $ticket->save();

        // 🔔 Se o técnico forçou o fecho mesmo havendo tickets mais urgentes, notificar o admin
        if ($force) {
            $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);
            $priorityOrder = ['crítica' => 4, 'alta' => 3, 'média' => 2, 'baixa' => 1];
            $currentPriority = $priorityOrder[$ticket->priority] ?? 0;

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

            if ($higherPriorityTickets > 0) {
                try {
                    $admins = User::whereHas('profile', function ($q) {
                        $q->where('name', User::ROLE_ADMIN);
                    })->get();

                    foreach ($admins as $admin) {
                        Notification::create([
                            'user_id' => $admin->id,
                            'title' => "⚠️ Ticket Não Prioritário Fechado - #{$ticket->id}",
                            'message' => "O técnico {$user->name} fechou o ticket #{$ticket->id} ({$ticket->title}) com prioridade '{$ticket->priority}', ignorando {$higherPriorityTickets} ticket(s) mais urgente(s) pendentes.",
                            'type' => 'priority_override',
                            'link' => "/ui/tickets/{$ticket->id}",
                        ]);
                    }
                } catch (\Exception $e) {
                    // Silencia falhas de notificação
                }
            }
        }

        // 🔔 Notificar criador que o ticket foi fechado
        $this->notifyBudgetEvent($ticket, 'closed',
            "O ticket #{$ticket->id} - {$ticket->title} foi concluído e fechado com custo final de {$request->actual_cost}€."
        );

        return response()->json([
            'message' => __('Intervenção concluída e ticket fechado com sucesso.'),
            'ticket' => $ticket->load(['equipment', 'room', 'technician', 'status']),
        ]);
    }
}

