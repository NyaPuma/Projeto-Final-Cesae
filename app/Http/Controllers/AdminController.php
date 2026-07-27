<?php

namespace App\Http\Controllers;

use App\DTOs\BudgetDecisionData;
use App\Enums\TicketStatusEnum;
use App\Http\Requests\AssignTechnicianRequest;
use App\Http\Requests\BudgetDecisionRequest;
use App\Http\Requests\StoreEquipmentRequest;
use App\Http\Requests\StorePreventiveRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateEquipmentRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Equipment;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\NotificationService;
use App\Services\TechnicianAssignmentService;
use App\Services\TicketStatusService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function __construct(
        private readonly NotificationService $notificationService,
        private readonly TicketStatusService $statusService,
        private readonly TechnicianAssignmentService $technicianService,
    ) {}

    // --- User Management ---

    public function users(Request $request): JsonResponse
    {
        $query = User::with('profile');

        if ($request->filled('q')) {
            $safeQ = str_replace(['%', '_'], ['\%', '\_'], $request->q);
            $query->where(function ($sub) use ($safeQ) {
                $sub->where('name', 'like', "%{$safeQ}%")
                    ->orWhere('email', 'like', "%{$safeQ}%");
            });
        }

        if ($request->filled('role')) {
            $query->whereHas('profile', fn ($sub) => $sub->where('name', $request->role));
        }

        if ($request->filled('status')) {
            $query->where('active', $request->status === 'active');
        }

        return response()->json(['users' => $query->orderBy('name')->paginate(15)]);
    }

    public function storeUser(StoreUserRequest $request): JsonResponse
    {
        $plainToken = Str::random(60);

        $newUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_id' => $request->profile_id,
            'active' => $request->boolean('active', true),
            'api_token' => hash_hmac('sha256', $plainToken, config('app.key')),
        ]);

        return response()->json(['user' => $newUser->load('profile')], 201);
    }

    public function updateUser(UpdateUserRequest $request, int $id): JsonResponse
    {
        $admin = $this->authenticatedUser($request);
        $this->requireRole($admin, [User::ROLE_ADMIN]);

        $user = User::find($id);
        if (! $user) {
            return $this->jsonNotFound('Utilizador não encontrado');
        }

        $validated = $request->validated();

        if (! empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        if (isset($validated['active']) && ! $validated['active'] && $user->isAdmin()) {
            return response()->json(['message' => 'Não é possível inativar um administrador via atualização'], 422);
        }

        $user->update($validated);

        return response()->json(['user' => $user->load('profile')]);
    }

    public function inactivateUser(Request $request, int $id): JsonResponse
    {
        $admin = $this->authenticatedUser($request);
        $this->requireRole($admin, [User::ROLE_ADMIN]);

        $user = User::find($id);
        if (! $user) {
            return $this->jsonNotFound('Utilizador não encontrado');
        }

        if ($user->isAdmin()) {
            return response()->json(['message' => 'Não é possível inativar um administrador'], 422);
        }

        $user->active = false;
        $user->save();

        return response()->json(['message' => 'Utilizador inativado com sucesso']);
    }

    public function profiles(): JsonResponse
    {
        return response()->json(['profiles' => UserProfile::all()]);
    }

    // --- Equipment Management ---

    public function equipments(Request $request): JsonResponse
    {
        return response()->json(['equipments' => Equipment::with('room')->orderBy('name')->paginate(15)]);
    }

    public function storeEquipment(StoreEquipmentRequest $request): JsonResponse
    {
        $equipment = Equipment::create([
            'name' => $request->name,
            'serial' => $request->serial,
            'room_id' => $request->room_id,
            'category_id' => $request->category_id,
            'active' => true,
        ]);

        return response()->json(['equipment' => $equipment], 201);
    }

    public function updateEquipment(UpdateEquipmentRequest $request, int $id): JsonResponse
    {
        $equipment = Equipment::find($id);
        if (! $equipment) {
            return $this->jsonNotFound('Equipamento não encontrado');
        }

        $equipment->update($request->validated());

        return response()->json(['equipment' => $equipment]);
    }

    public function destroyEquipment(Request $request, int $id): JsonResponse
    {
        $equipment = Equipment::find($id);
        if (! $equipment) {
            return $this->jsonNotFound('Equipamento não encontrado');
        }

        $equipment->delete();

        return response()->json(['message' => 'Equipamento eliminado']);
    }

    // --- Budget Approval ---

    public function approveBudget(BudgetDecisionRequest $request, int $id): JsonResponse
    {
        $admin = $this->authenticatedUser($request);
        $this->requireRole($admin, [User::ROLE_ADMIN]);

        $decisionData = BudgetDecisionData::fromRequest($request->validated());

        $ticket = Ticket::find($id);
        if (! $ticket) {
            return $this->jsonNotFound('Ticket não encontrado');
        }

        if (! $ticket->budget_requested || $ticket->budget_status !== Ticket::BUDGET_PENDING) {
            return response()->json(['message' => 'Não existe pedido de orçamento pendente'], 422);
        }

        $approved = $ticket->approveBudget($admin, $decisionData->decision, $decisionData->feedback);

        if (! $approved) {
            return response()->json(['message' => 'Aprovação falhou'], 422);
        }

        $notifyMessage = $decisionData->decision === 'approve'
            ? "O orçamento de {$ticket->budget_amount}€ para o ticket #{$ticket->id} foi APROVADO pelo administrador."
            : "O orçamento de {$ticket->budget_amount}€ para o ticket #{$ticket->id} foi RECUSADO.".($decisionData->feedback ? " Motivo: {$decisionData->feedback}" : '');

        $this->notificationService->notifyBudgetDecision($ticket, $decisionData->decision, $notifyMessage);

        return response()->json([
            'message' => $decisionData->decision === 'approve'
                ? 'Orçamento aprovado. Ticket desbloqueado para intervenção.'
                : 'Orçamento recusado. Reparação abortada.',
            'ticket' => $ticket->load(['equipment', 'room', 'technician', 'status']),
        ]);
    }

    public function assignTechnician(AssignTechnicianRequest $request, int $id): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_ADMIN]);

        $ticket = Ticket::findOrFail($id);
        $technicianId = $request->validated('technician_id');

        $technician = $this->technicianService->assignToTicket($ticket, $technicianId ? (int) $technicianId : null);

        if (! $technician) {
            $message = $technicianId ? 'Técnico inválido' : 'Não existem técnicos disponíveis';

            return response()->json(['message' => $message], 422);
        }

        return response()->json(['ticket' => $ticket]);
    }

    // --- Preventive Maintenance ---

    public function storePreventive(StorePreventiveRequest $request): JsonResponse
    {
        $admin = $this->authenticatedUser($request);
        $this->requireRole($admin, [User::ROLE_ADMIN]);

        $technician = null;
        if (! empty($request->technician_id)) {
            $technician = User::find($request->technician_id);
            if (! $technician || ! $technician->isTechnician()) {
                return response()->json(['message' => 'Técnico inválido'], 422);
            }
        }

        $openStatusId = $this->statusService->getByName(TicketStatusEnum::Open);
        $ticket = Ticket::create([
            'user_id' => $admin->id,
            'assigned_to' => $technician?->id,
            'title' => $request->title,
            'description' => $request->description ?? 'Manutenção preventiva agendada.',
            'priority' => Ticket::PRIORITY_MEDIUM,
            'status_id' => $openStatusId,
            'opened_at' => now(),
            'scheduled_at' => $request->scheduled_at,
            'scheduled' => true,
        ]);

        return response()->json(['ticket' => $ticket], 201);
    }
}
