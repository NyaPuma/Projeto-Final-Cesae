<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Notification;
use App\Models\Room;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
            $query->where(function($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%");
            });
        }

        if ($role) {
            $query->whereHas('profile', function($sub) use ($role) {
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
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 200, description: 'Utilizador inativado'),
            new OA\Response(response: 404, description: 'Utilizador não encontrado'),
            new OA\Response(response: 422, description: 'Operação inválida')
        ]
    )]
    public function inactivateUser(Request $request, int $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Utilizador não encontrado'], 404);
        }

        // Um administrador nunca é desativado por esta via para evitar bloqueios acidentais da gestão.
        if ($user->isAdmin()) {
            return response()->json(['message' => 'Não é possível inativar um administrador'], 422);
        }

        // A desativação é lógica: o utilizador deixa de conseguir autenticar-se sem apagar o registo.
        $user->active = false;
        $user->save();

        return response()->json(['message' => 'Utilizador inativado com sucesso']);
    }

    /**
     * Regista um novo utilizador no sistema.
     */
    public function storeUser(Request $request)
    {
        $data = $request->only(['name', 'email', 'password', 'profile_id', 'active']);
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'profile_id' => ['required', 'integer', 'exists:user_profiles,id'],
            'active' => ['sometimes', 'boolean'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => \Illuminate\Support\Facades\Hash::make($data['password']),
            'profile_id' => $data['profile_id'],
            'active' => $data['active'] ?? true,
            'api_token' => \Illuminate\Support\Str::random(60),
        ]);

        return response()->json(['user' => $user->load('profile')], 201);
    }

    /**
     * Atualiza um utilizador existente.
     */
    public function updateUser(Request $request, int $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Utilizador não encontrado'], 404);
        }

        $data = $request->only(['name', 'email', 'password', 'profile_id', 'active']);
        $validator = Validator::make($data, [
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'email', 'max:255', 'unique:users,email,'.$id],
            'password' => ['nullable', 'string', 'min:8'],
            'profile_id' => ['sometimes', 'integer', 'exists:user_profiles,id'],
            'active' => ['sometimes', 'boolean'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();
        if (!empty($validated['password'])) {
            $validated['password'] = \Illuminate\Support\Facades\Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return response()->json(['user' => $user->load('profile')]);
    }

    /**
     * Retorna os perfis de utilizador disponíveis.
     */
    public function profiles()
    {
        return response()->json(['profiles' => \App\Models\UserProfile::all()]);
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
        // Ordena e pagina para manter a listagem leve mesmo com inventários grandes.
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
            new OA\Response(response: 422, description: 'Erro de validação')
        ]
    )]
    public function storeEquipment(Request $request)
    {
        $data = $request->only(['name', 'serial', 'room_id']);
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'serial' => ['required', 'string', 'max:255', 'unique:equipments,serial'],
            'room_id' => ['nullable', 'integer', 'exists:rooms,id'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // O equipamento nasce ativo para poder ser usado imediatamente após o registo.
        $equipment = Equipment::create([
            'name' => $data['name'],
            'serial' => $data['serial'],
            'room_id' => $data['room_id'] ?? null,
            'active' => true,
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
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 200, description: 'Equipamento atualizado'),
            new OA\Response(response: 404, description: 'Equipamento não encontrado'),
            new OA\Response(response: 422, description: 'Erro de validação')
        ]
    )]
    public function updateEquipment(Request $request, int $id)
    {
        $equipment = Equipment::find($id);
        if (!$equipment) {
            return response()->json(['message' => 'Equipamento não encontrado'], 404);
        }

        $data = $request->only(['name', 'serial', 'room_id', 'active']);
        $validator = Validator::make($data, [
            'name' => ['sometimes', 'string', 'max:255'],
            'serial' => ['sometimes', 'string', 'max:255', 'unique:equipments,serial,'.$id],
            'room_id' => ['nullable', 'integer', 'exists:rooms,id'],
            'active' => ['sometimes', 'boolean'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Só aplicamos os campos validados para não apagar informação que não veio no pedido.
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
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 200, description: 'Equipamento eliminado'),
            new OA\Response(response: 404, description: 'Equipamento não encontrado')
        ]
    )]
    public function destroyEquipment(Request $request, int $id)
    {
        $equipment = Equipment::find($id);
        if (!$equipment) {
            return response()->json(['message' => 'Equipamento não encontrado'], 404);
        }

        // Remoção física apenas porque o módulo assume inventário sem histórico neste registo.
        $equipment->delete();

        return response()->json(['message' => 'Equipamento eliminado']);
    }



    /**
     * Aprova um pedido de orçamento associado a um ticket de avaria.
     */
    #[OA\Patch(
        path: '/admin/tickets/{id}/approve-budget',
        tags: ['Admin'],
        summary: 'Aprovar orçamento',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 200, description: 'Orçamento aprovado'),
            new OA\Response(response: 422, description: 'Pedido inválido')
        ]
    )]
    #[OA\Post(
        path: '/admin/preventive',
        tags: ['Admin'],
        summary: 'Criar manutenção preventiva',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        responses: [
            new OA\Response(response: 201, description: 'Manutenção preventiva criada'),
            new OA\Response(response: 422, description: 'Erro de validação')
        ]
    )]
    public function storePreventive(Request $request)
    {
        $admin = $this->authenticatedUser($request);
        $this->requireRole($admin, [User::ROLE_ADMIN]);

        $data = $request->only(['title', 'description', 'scheduled_at', 'technician_id']);
        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'scheduled_at' => ['required', 'date'],
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
        }

        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);
        $ticket = Ticket::create([
            'user_id' => $admin->id,
            'assigned_to' => $technician?->id,
            'title' => $data['title'],
            'description' => $data['description'] ?? 'Manutenção preventiva agendada.',
            'priority' => Ticket::PRIORITY_MEDIUM,
            'status_id' => $openStatusId,
            'opened_at' => now(),
            'scheduled_at' => $data['scheduled_at'],
            'scheduled' => true,
        ]);

        return response()->json(['ticket' => $ticket], 201);
    }

    /**
     * Processa a decisão orçamental do Administrador (aprovar ou recusar).
     * Suporta tanto o formato PATCH original como o POST do frontend (action + feedback).
     * Rota: PATCH /admin/tickets/{id}/approve-budget
     * Rota: POST /admin/tickets/{id}/budget-decision (compatibilidade frontend)
     */
    public function approveBudget(Request $request, int $id)
    {
        // A autorização do admin é sempre verificada a partir do token da própria API.
        $admin = $this->authenticatedUser($request);

        // Redundância intencional: a rota já está protegida, mas confirmamos aqui por defesa em profundidade.
        $this->requireRole($admin, [User::ROLE_ADMIN]);

        // Suporta ambos os formatos: {decision, feedback} e {action, feedback}
        $decision = $request->input('decision', $request->input('action', 'approve'));
        $feedback = $request->input('feedback', null);

        $data = ['decision' => $decision, 'feedback' => $feedback];
        $validator = Validator::make($data, [
            'decision' => ['nullable', 'string', 'in:approve,reject'],
            'feedback' => ['nullable', 'string', 'max:5000'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Só tickets com pedido pendente podem ser aprovados.
        $ticket = Ticket::find($id);
        if (!$ticket) {
            return response()->json(['message' => 'Ticket não encontrado'], 404);
        }

        // Não avançamos se o ticket não estiver no estado correto para aprovação.
        if (!$ticket->budget_requested || $ticket->budget_status !== Ticket::BUDGET_PENDING) {
            return response()->json(['message' => 'Não existe pedido de orçamento pendente'], 422);
        }

        // Se for recusa, guarda o feedback
        if ($decision === 'reject' && !empty($feedback)) {
            $ticket->budget_feedback = $feedback;
        }

        // A regra de negócio fica no modelo para manter a decisão consistente em toda a aplicação.
        $approved = $ticket->approveBudget($admin, $data['decision'] ?? 'approve', $data['feedback'] ?? null);

        if (!$approved) {
            return response()->json(['message' => 'Aprovação falhou'], 422);
        }

        // 🔔 Notificar o técnico e o criador do ticket sobre a decisão
        try {
            $notifyType = $decision === 'approve' ? 'approved' : 'rejected';
            $notifyMessage = $decision === 'approve'
                ? "O orçamento de {$ticket->budget_amount}€ para o ticket #{$ticket->id} foi APROVADO pelo administrador. Pode prosseguir com a intervenção."
                : "O orçamento de {$ticket->budget_amount}€ para o ticket #{$ticket->id} foi RECUSADO." . ($feedback ? " Motivo: {$feedback}" : '');

            // Notificar o técnico atribuído
            if ($ticket->assigned_to) {
                Notification::create([
                    'user_id' => $ticket->assigned_to,
                    'title' => $decision === 'approve'
                        ? "✅ Orçamento Aprovado - Ticket #{$ticket->id}"
                        : "❌ Orçamento Recusado - Ticket #{$ticket->id}",
                    'message' => $notifyMessage,
                    'type' => "budget_{$notifyType}",
                    'link' => "/ui/tickets/{$ticket->id}",
                ]);
            }

            // Notificar o criador do ticket
            if ($ticket->user_id) {
                Notification::create([
                    'user_id' => $ticket->user_id,
                    'title' => "📋 Decisão Orçamental - Ticket #{$ticket->id}",
                    'message' => $notifyMessage,
                    'type' => "budget_{$notifyType}",
                    'link' => "/ui/tickets/{$ticket->id}",
                ]);
            }
        } catch (\Exception $e) {
            // Silencia falhas de notificação
        }

        // Devolve o ticket já com o novo estado para simplificar o consumo no frontend.
        return response()->json([
            'message' => $decision === 'approve'
                ? 'Orçamento aprovado. Ticket desbloqueado para intervenção.'
                : 'Orçamento recusado. Reparação abortada.',
            'ticket' => $ticket->load(['equipment', 'room', 'technician', 'status']),
        ]);
    }
}
