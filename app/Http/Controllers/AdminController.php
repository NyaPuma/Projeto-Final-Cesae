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
use App\Models\User;
use App\Repositories\Contracts\TicketRepositoryInterface;
use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{
    public function __construct(
        private readonly TicketRepositoryInterface $ticketRepository,
        private readonly ApproveBudgetAction $approveBudgetAction,
        private readonly AssignTechnicianAction $assignTechnicianAction,
        private readonly CreatePreventiveTicketAction $createPreventiveAction,
    ) {}

    public function approveBudget(BudgetDecisionRequest $request, int $id): JsonResponse
    {
        $admin = $this->authenticatedUser($request);
        $this->requireRole($admin, [User::ROLE_ADMIN]);

        $ticket = $this->ticketRepository->findById($id);
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

        $ticket = $this->ticketRepository->findById($id);
        if (! $ticket) {
            return $this->jsonNotFound('Ticket não encontrado');
        }

        $data = AssignTechnicianData::fromRequest($request->validated());
        $technician = $this->assignTechnicianAction->execute($ticket, $data->technicianId);

        if (! $technician) {
            $message = $data->technicianId ? 'Técnico inválido' : 'Não existem técnicos disponíveis';

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
