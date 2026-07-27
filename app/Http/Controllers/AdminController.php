<?php

namespace App\Http\Controllers;

use App\Actions\ApproveBudgetAction;
use App\Actions\CreatePreventiveTicketAction;
use App\DTOs\BudgetDecisionData;
use App\Enums\BudgetStatusEnum;
use App\Http\Requests\AssignTechnicianRequest;
use App\Http\Requests\BudgetDecisionRequest;
use App\Http\Requests\StorePreventiveRequest;
use App\Models\Ticket;
use App\Models\User;
use App\Services\TechnicianAssignmentService;
use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{
    public function __construct(
        private readonly TechnicianAssignmentService $technicianService,
        private readonly ApproveBudgetAction $approveBudgetAction,
        private readonly CreatePreventiveTicketAction $createPreventiveAction,
    ) {}

    public function approveBudget(BudgetDecisionRequest $request, int $id): JsonResponse
    {
        $admin = $this->authenticatedUser($request);
        $this->requireRole($admin, [User::ROLE_ADMIN]);

        $ticket = Ticket::find($id);
        if (! $ticket) {
            return $this->jsonNotFound('Ticket não encontrado');
        }

        $ticket = $this->approveBudgetAction->execute(
            $ticket,
            $admin,
            BudgetDecisionData::fromRequest($request->validated()),
        );

        $message = $ticket->budget_status === BudgetStatusEnum::Approved->value
            ? 'Orçamento aprovado. Ticket desbloqueado para intervenção.'
            : 'Orçamento recusado. Reparação abortada.';

        return response()->json(['message' => $message, 'ticket' => $ticket]);
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

    public function storePreventive(StorePreventiveRequest $request): JsonResponse
    {
        $admin = $this->authenticatedUser($request);
        $this->requireRole($admin, [User::ROLE_ADMIN]);

        $ticket = $this->createPreventiveAction->execute(
            $admin,
            $request->title,
            $request->description,
            $request->technician_id,
            $request->scheduled_at,
        );

        return response()->json(['ticket' => $ticket], 201);
    }
}
