<?php

namespace App\Http\Controllers;

use App\Actions\CreateTicketAction;
use App\DTOs\CreateTicketData;
use App\DTOs\TicketFilters;
use App\Enums\TicketPriorityEnum;
use App\Http\Requests\StoreTicketRequest;
use App\Models\User;
use App\Repositories\Contracts\TicketRepositoryInterface;
use App\Services\AIService;
use App\Services\TechnicianAssignmentService;
use App\Services\TicketSearchService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class TicketController extends Controller
{
    public function __construct(
        private readonly TicketRepositoryInterface $ticketRepository,
        private readonly CreateTicketAction $createTicketAction,
        private readonly TechnicianAssignmentService $technicianService,
        private readonly TicketSearchService $searchService,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $query = Ticket::with(['equipment', 'room', 'technician', 'status']);

        if ($request->has('q') && ! empty($request->q)) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }

        return response()->json(['tickets' => $tickets]);
    }

    public function store(StoreTicketRequest $request): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $data = CreateTicketData::fromRequest($request->validated());

        $ticket = $this->createTicketAction->execute($user, $data);
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

            $query->whereBetween('created_at', [$dateFrom, $dateTo . ' 23:59:59']);
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
    public function show(Request $request, $id)
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

        $user = $request->user() ?? Auth::user();

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
                'message' => 'Prioridade inv├ílida. Valores v├ílidos: baixa, m├®dia, alta, cr├¡tica.',
            ], 422);
        }

        $filters = TicketFilters::fromRequest($request->all());

        return response()->json([
            'tickets' => $this->searchService->search($filters),
        ]);
    }

    public function show(Request $request, int $id): JsonResponse|View
    {
        $user = $this->authenticatedUser($request);
        $ticket = $this->ticketRepository->findWithRelations($id, ['equipment.category', 'room', 'user', 'technician', 'status']);

        if (! $ticket) {
            return response()->json(['message' => 'Ticket n├úo encontrado'], 404);
        }

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
                        'title'   => "{$icon} Orçamento " . ($eventType === 'approved' ? 'Aprovado' : 'Recusado') . " - Ticket #{$ticket->id}",
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

                $this->notifyBudgetEvent(
                    $ticket,
                    'submitted',
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

            $this->notifyBudgetEvent(
                $ticket,
                'auto_approved',
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

        $recomendacaoIA = app(AIService::class)->recomendarTecnico($ticket);

        return view('ui.ticket-detail', compact('ticket', 'recomendacaoIA'));
    }

    public function openTickets(Request $request): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_TECHNICIAN, User::ROLE_ADMIN]);

        $tickets = $this->ticketRepository->getOpenTickets();

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

        $this->notifyBudgetEvent(
            $ticket,
            'closed',
            "O ticket #{$ticket->id} - {$ticket->title} foi concluído e fechado com custo final de {$request->actual_cost}€."
        );

        return response()->json([
            'message' => __('Intervenção concluída e ticket fechado com sucesso.'),
            'ticket'  => $ticket->load(['equipment', 'room', 'technician', 'status']),
        ]);
    }

    public function getMostUrgentOpenTicket(Request $request): JsonResponse
    {
        $this->authenticatedUser($request);
        $excludeId = (int) $request->input('exclude', 0);

        $ticket = $this->technicianService->findMostUrgentOpenTicket($excludeId > 0 ? $excludeId : null);

        if (! $ticket) {
            return response()->json(['ticket_id' => null, 'message' => __('N├úo existem tickets abertos priorit├írios.')], 404);
        }

        return response()->json([
            'ticket_id' => $ticket->id,
            'title' => $ticket->title,
            'priority' => $ticket->priority,
        ]);
    }



    public function myTickets(Request $request)
    {
        // Obtém o utilizador autenticado
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Utilizador não autenticado.'], 401);
        }

        // Inicia a query para filtrar os tickets do utilizador
        $query = Ticket::with(['equipment', 'room', 'status']);

        // Se for técnico ou utilizador comum, filtra pelos criados por ele OU atribuídos a ele
        $query->where(function ($q) use ($user) {
            $q->where('user_id', $user->id)           // Criados pelo utilizador/técnico
                ->orWhere('assigned_to', $user->id);  // Atribuídos ao técnico
        });

        // Filtro por termo de pesquisa ('q')
        if ($request->filled('q')) {
            $searchTerm = $request->input('q');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        // Filtro por estado
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Filtro por prioridade
        if ($request->filled('priority')) {
            $query->where('priority', $request->input('priority'));
        }

        // Filtro por datas
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->input('date_from'));
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->input('date_to'));
        }

        // Ordenação e paginação
        $tickets = $query->orderBy('created_at', 'desc')->paginate(10);

        return response()->json($tickets);
    }


}
