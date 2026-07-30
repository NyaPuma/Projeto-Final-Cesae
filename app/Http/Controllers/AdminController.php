<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Notification;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use OpenApi\Attributes as OA;

class AdminController extends Controller
{
    /**
     * Retorna todos os utilizadores (Apenas para Administradores).
     */
    #[OA\Get(
        path: '/admin/users',
        tags: ['Admin'],
        summary: 'Listar utilizadores',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        responses: [new OA\Response(response: 200, description: 'Lista de utilizadores')]
    )]
    public function users(Request $request)
    {
        $q = $request->query('q');
        $role = $request->query('role');
        $status = $request->query('status'); // 'active' or 'inactive'

        $query = User::with('profile');

        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%");
            });
        }

        if ($role) {
            $query->whereHas('profile', function ($sub) use ($role) {
                $sub->where('name', $role);
            });
        }

        if ($status !== null && $status !== '') {
            $query->where('active', $status === 'active');
        }

        return response()->json(['users' => $query->orderBy('name')->paginate(15)]);
    }

    /**
     * Inativa um utilizador do sistema.
     */
    #[OA\Patch(
        path: '/admin/users/{id}/inactive',
        tags: ['Admin'],
        summary: 'Inativar utilizador',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Utilizador inativado'),
            new OA\Response(response: 404, description: 'Utilizador não encontrado'),
            new OA\Response(response: 422, description: 'Operação inválida'),
        ]
    )]
    public function inactivateUser(Request $request, int $id)
    {
        $user = User::find($id);
        if (! $user) {
            return response()->json(['message' => 'Utilizador não encontrado'], 404);
        }

        if ($user->isAdmin()) {
            return response()->json(['message' => 'Não é possível inativar um administrador'], 422);
        }

        $user->active = false;
        $user->save();

        return response()->json(['message' => 'Utilizador inativado com sucesso']);
    }

    /**
     * Regista um novo utilizador no sistema (incluindo avatar/foto).
     */
    public function storeUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'       => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', 'max:255', 'unique:users,email'],
            'password'   => ['required', 'string', 'min:8'],
            'profile_id' => ['required', 'integer', 'exists:user_profiles,id'],
            'active'     => ['sometimes', 'boolean'],
            'avatar'     => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        $user = User::create([
            'name'       => $request->input('name'),
            'email'      => $request->input('email'),
            'password'   => Hash::make($request->input('password')),
            'profile_id' => $request->input('profile_id'),
            'active'     => $request->boolean('active', true),
            'avatar'     => $avatarPath,
            'api_token'  => Str::random(60),
        ]);

        return response()->json(['user' => $user->load('profile')], 201);
    }

    /**
     * Atualiza um utilizador existente (incluindo alteração da foto).
     */
    public function updateUser(Request $request, int $id)
    {
        $user = User::find($id);
        if (! $user) {
            return response()->json(['message' => 'Utilizador não encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name'       => ['sometimes', 'string', 'max:255'],
            'email'      => ['sometimes', 'email', 'max:255', 'unique:users,email,' . $id],
            'password'   => ['nullable', 'string', 'min:8'],
            'profile_id' => ['sometimes', 'integer', 'exists:user_profiles,id'],
            'active'     => ['sometimes', 'boolean'],
            'avatar'     => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();

        if (! empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Upload e substituição do Avatar
        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($validated);

        return response()->json(['user' => $user->load('profile')]);
    }

    /**
     * Retorna os perfis de utilizador disponíveis.
     */
    public function profiles()
    {
        return response()->json(['profiles' => UserProfile::all()]);
    }

    /**
     * Lista equipamentos com a respetiva sala associada.
     */
    #[OA\Get(
        path: '/admin/equipment',
        tags: ['Admin'],
        summary: 'Listar equipamentos',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        responses: [new OA\Response(response: 200, description: 'Lista de equipamentos')]
    )]
    public function equipments(Request $request)
    {
        return response()->json(['equipments' => Equipment::with('room')->orderBy('name')->paginate(15)]);
    }

    /**
     * Regista um novo equipamento no sistema.
     */
    #[OA\Post(
        path: '/admin/equipment',
        tags: ['Admin'],
        summary: 'Criar equipamento',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        responses: [
            new OA\Response(response: 201, description: 'Equipamento criado'),
            new OA\Response(response: 422, description: 'Erro de validação'),
        ]
    )]
    public function storeEquipment(Request $request)
    {
        $data = $request->only(['name', 'serial', 'room_id']);
        $validator = Validator::make($data, [
            'name'    => ['required', 'string', 'max:255'],
            'serial'  => ['required', 'string', 'max:255', 'unique:equipments,serial'],
            'room_id' => ['nullable', 'integer', 'exists:rooms,id'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $equipment = Equipment::create([
            'name'    => $data['name'],
            'serial'  => $data['serial'],
            'room_id' => $data['room_id'] ?? null,
            'active'  => true,
        ]);

        return response()->json(['equipment' => $equipment], 201);
    }

    /**
     * Atualiza os dados de um equipamento existente.
     */
    #[OA\Patch(
        path: '/admin/equipment/{id}',
        tags: ['Admin'],
        summary: 'Atualizar equipamento',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Equipamento atualizado'),
            new OA\Response(response: 404, description: 'Equipamento não encontrado'),
            new OA\Response(response: 422, description: 'Erro de validação'),
        ]
    )]
    public function updateEquipment(Request $request, int $id)
    {
        $equipment = Equipment::find($id);
        if (! $equipment) {
            return response()->json(['message' => 'Equipamento não encontrado'], 404);
        }

        $data = $request->only(['name', 'serial', 'room_id', 'active']);
        $validator = Validator::make($data, [
            'name'    => ['sometimes', 'string', 'max:255'],
            'serial'  => ['sometimes', 'string', 'max:255', 'unique:equipments,serial,' . $id],
            'room_id' => ['nullable', 'integer', 'exists:rooms,id'],
            'active'  => ['sometimes', 'boolean'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $equipment->update($validator->validated());

        return response()->json(['equipment' => $equipment]);
    }

    /**
     * Remove fisicamente um equipamento do sistema.
     */
    #[OA\Delete(
        path: '/admin/equipment/{id}',
        tags: ['Admin'],
        summary: 'Eliminar equipamento',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Equipamento eliminado'),
            new OA\Response(response: 404, description: 'Equipamento não encontrado'),
        ]
    )]
    public function destroyEquipment(Request $request, int $id)
    {
        $equipment = Equipment::find($id);
        if (! $equipment) {
            return response()->json(['message' => 'Equipamento não encontrado'], 404);
        }

        $equipment->delete();

        return response()->json(['message' => 'Equipamento eliminado']);
    }

    /**
     * Regista uma manutenção preventiva no sistema.
     */
    #[OA\Post(
        path: '/admin/preventive',
        tags: ['Admin'],
        summary: 'Criar manutenção preventiva',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        responses: [
            new OA\Response(response: 201, description: 'Manutenção preventiva criada'),
            new OA\Response(response: 422, description: 'Erro de validação'),
        ]
    )]
    public function storePreventive(Request $request)
    {
        $admin = $this->authenticatedUser($request);
        $this->requireRole($admin, [User::ROLE_ADMIN]);

        $data = $request->only(['title', 'description', 'scheduled_at', 'technician_id']);
        $validator = Validator::make($data, [
            'title'         => ['required', 'string', 'max:255'],
            'description'  => ['nullable', 'string'],
            'scheduled_at'  => ['required', 'date'],
            'technician_id' => ['nullable', 'integer', 'exists:users,id'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $technician = null;
        if (! empty($data['technician_id'])) {
            $technician = User::find($data['technician_id']);
            if (! $technician || ! $technician->isTechnician()) {
                return response()->json(['message' => 'Técnico inválido'], 422);
            }
        }

        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);
        $ticket = Ticket::create([
            'user_id'      => $admin->id,
            'assigned_to'  => $technician?->id,
            'title'        => $data['title'],
            'description'  => $data['description'] ?? 'Manutenção preventiva agendada.',
            'priority'     => Ticket::PRIORITY_MEDIUM,
            'status_id'    => $openStatusId,
            'opened_at'    => now(),
            'scheduled_at' => $data['scheduled_at'],
            'scheduled'    => true,
        ]);

        return response()->json(['ticket' => $ticket], 201);
    }

    /**
     * Processa a decisão orçamental do Administrador (aprovar ou recusar).
     */
    public function approveBudget(Request $request, int $id)
    {
        $ticket = Ticket::find($id);
        if (! $ticket) {
            return response()->json(['message' => 'Ticket não encontrado'], 404);
        }

        // Tenta obter a decisão a partir de vários nomes comuns de parâmetros
        $decision = $request->input('decision')
            ?? $request->input('action')
            ?? $request->input('status')
            ?? 'approve';

        // Normalizar a decisão (ex: 'validar' / 'approve' / 'accept' => 'approve')
        if (in_array(strtolower($decision), ['approve', 'validar', 'aceitar', 'approved', 'accept'])) {
            $decision = 'approve';
        } else {
            $decision = 'reject';
        }

        $feedback = $request->input('feedback', null);

        // Se o método approveBudget existir na model Ticket, executa-o
        if (method_exists($ticket, 'approveBudget')) {
            $approved = $ticket->approveBudget(auth()->user(), $decision, $feedback);
        } else {
            // Fallback direto na BD caso a model não tenha o método
            if ($decision === 'approve') {
                $statusAberto = TicketStatus::where('name', 'like', '%abert%')->first();
                $ticket->budget_status = 'approved';
                $ticket->budget_requested = false;
                if ($statusAberto) {
                    $ticket->status_id = $statusAberto->id;
                }
            } else {
                $ticket->budget_status = 'rejected';
                $ticket->budget_feedback = $feedback;
            }
            $approved = $ticket->save();
        }

        if (! $approved) {
            return response()->json(['message' => 'Erro ao guardar decisão orçamental.'], 422);
        }

        // Tentar enviar notificação (sem bloquear em caso de erro)
        try {
            $notifyType = $decision === 'approve' ? 'approved' : 'rejected';
            $notifyMessage = $decision === 'approve'
                ? "O orçamento de {$ticket->budget_amount}€ para o ticket #{$ticket->id} foi APROVADO pelo administrador."
                : "O orçamento para o ticket #{$ticket->id} foi RECUSADO.";

            if ($ticket->assigned_to) {
                Notification::create([
                    'user_id' => $ticket->assigned_to,
                    'title'   => $decision === 'approve' ? "✅ Orçamento Aprovado - Ticket #{$ticket->id}" : "❌ Orçamento Recusado - Ticket #{$ticket->id}",
                    'message' => $notifyMessage,
                    'type'    => "budget_{$notifyType}",
                    'link'    => "/ui/tickets/{$ticket->id}",
                ]);
            }
        } catch (\Exception $e) {
        }

        return response()->json([
            'message' => $decision === 'approve'
                ? 'Orçamento aprovado com sucesso!'
                : 'Orçamento recusado.',
            'ticket'  => $ticket->fresh(['equipment', 'room', 'technician', 'status']),
        ]);
    }

    /**
     * Agendar Manutenção Preventiva (Administrador)
     */
    public function scheduleMaintenance(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'equipment_id' => 'required|exists:equipments,id',
            'scheduled_at' => 'required|date',
            'assigned_to'  => 'nullable|exists:users,id',
            'description'  => 'nullable|string',
        ]);

        // Obter o equipamento para associar a sala correspondente
        $equipment = Equipment::find($validated['equipment_id']);

        // Obter o estado inicial (ex: 'aberto')
        $status = TicketStatus::where('name', 'aberta')
            ->orWhere('name', 'aberto')
            ->first();

        $ticket = Ticket::create([
            'title'        => $validated['title'],
            'equipment_id' => $validated['equipment_id'],
            'room_id'      => $equipment?->room_id,
            'scheduled_at' => $validated['scheduled_at'],
            'assigned_to'  => $validated['assigned_to'] ?? null,
            'description'  => $validated['description'] ?? 'Manutenção preventiva agendada.',
            'scheduled'    => true,
            'user_id'      => auth()->id() ?? 1,
            'status_id'    => $status?->id ?? 1,
            'priority'     => 'média',
            'opened_at'    => now(),
        ]);

        return response()->json([
            'message' => 'Manutenção preventiva agendada com sucesso!',
            'ticket'  => $ticket
        ], 201);
    }
    public function overridePriorityAndAssignment(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        if ($request->has('priority')) {
            $ticket->priority = $request->priority;
        }
        if ($request->has('assigned_to')) {
            $ticket->assigned_to = $request->assigned_to;
            $ticket->status_id = Ticket::getStatusIdByName(Ticket::STATUS_IN_PROGRESS);
        }
        $ticket->save();

        return response()->json(['message' => __('Prioridade/Atribuição alterada pelo Administrador com sucesso.')]);
    }
    public function budgetsView()
    {
        return view('ui.budgets');
    }

    public function budgetsList(Request $request)
    {
        $status = $request->query('status'); // 'pending', 'approved', 'rejected'

        $query = Ticket::whereNotNull('budget_amount')
            ->with(['equipment', 'room', 'technician', 'user']);

        if ($status) {
            $query->where('budget_status', $status);
        }

        $tickets = $query->latest()->get();

        return response()->json([
            'tickets' => $tickets,
            'totals' => [
                'all'      => Ticket::whereNotNull('budget_amount')->sum('budget_amount'),
                'pending'  => Ticket::where('budget_status', 'pending')->sum('budget_amount'),
                'approved' => Ticket::where('budget_status', 'approved')->sum('budget_amount'),
                'rejected' => Ticket::where('budget_status', 'rejected')->sum('budget_amount'),
            ]
        ]);
    }
}
