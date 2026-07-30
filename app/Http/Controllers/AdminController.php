<?php

namespace App\Http\Controllers;

use App\Actions\ApproveBudgetAction;
use App\Actions\AssignTechnicianAction;
use App\Actions\CreatePreventiveTicketAction;
use App\DTOs\AssignTechnicianData;
use App\DTOs\BudgetDecisionData;
use App\Enums\BudgetStatusEnum;
use App\Http\Requests\AssignTechnicianRequest;
use App\Http\Requests\BudgetDecisionRequest;
use App\Http\Requests\StorePreventiveRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;

final class AdminController extends Controller
{
    public function __construct(
        private readonly ApproveBudgetAction $approveBudgetAction,
        private readonly AssignTechnicianAction $assignTechnicianAction,
        private readonly CreatePreventiveTicketAction $createPreventiveAction,
    ) {}

    /**
     * Aprova ou recusa o orçamento associado a um ticket.
     */
    public function approveBudget(BudgetDecisionRequest $request, Ticket $ticket): JsonResponse
    {
        // 1. Autorização via Policy
        $this->authorize('approveBudget', $ticket);

        $admin = $request->user();

        // 2. Executa a ação de aprovação/recusa do orçamento
        $updatedTicket = $this->approveBudgetAction->execute(
            $ticket,
            $admin,
            BudgetDecisionData::fromRequest($request->validated())
        );

        // 3. Validação do estado e definição da mensagem formatada com i18n
        $isApproved = $updatedTicket->budget_status === BudgetStatusEnum::Approved;
        $message = $isApproved
            ? __('Orçamento aprovado. Ticket desbloqueado para intervenção.')
            : __('Orçamento recusado. Reparação abortada.');

        $updatedTicket->loadMissing(['equipment', 'room', 'technician', 'status']);

        return response()->json([
            'message' => $message,
            'ticket' => new TicketResource($updatedTicket),
        ]);
    }

    /**
     * Atribui manualmente ou automaticamente um técnico a um ticket.
     */
    public function assignTechnician(AssignTechnicianRequest $request, Ticket $ticket): JsonResponse
    {
        // 1. Autorização via Policy
        $this->authorize('assignTechnician', $ticket);

        $data = AssignTechnicianData::fromRequest($request->validated());
        $technician = $this->assignTechnicianAction->execute($ticket, $data->technicianId);

        // 2. Trata falha na atribuição de técnico
        if (! $technician) {
            $message = $data->technicianId
                ? __('Técnico selecionado é inválido ou indisponível.')
                : __('Não existem técnicos disponíveis de momento.');

            return response()->json(['message' => $message], 422);
        }

        $ticket->loadMissing(['equipment', 'room', 'technician', 'status']);

        return response()->json([
            'message' => __('Técnico atribuído com sucesso.'),
            'ticket' => new TicketResource($ticket),
        ]);
    }

    /**
     * Cria um novo ticket de manutenção preventiva.
     */
    public function storePreventive(StorePreventiveRequest $request): JsonResponse
    {
        // 1. Autorização via Policy (verificação na classe Model)
        $this->authorize('createPreventive', Ticket::class);

        $admin = $request->user();

        // 2. Executa a criação do ticket preventivo com os dados validados
        $ticket = $this->createPreventiveAction->execute(
            admin: $admin,
            title: $request->validated('title'),
            description: $request->validated('description'),
            technicianId: $request->integer('technician_id'),
            scheduledAt: $request->date('scheduled_at')
        );

        $ticket->loadMissing(['equipment', 'room', 'technician', 'status']);

        return response()->json([
            'message' => __('Ticket preventivo criado com sucesso.'),
            'ticket' => new TicketResource($ticket),
        ], 201);
    }
}
