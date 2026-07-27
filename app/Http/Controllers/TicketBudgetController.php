<?php

namespace App\Http\Controllers;

use App\DTOs\BudgetSubmissionData;
use App\Enums\BudgetStatusEnum;
use App\Enums\TicketStatusEnum;
use App\Http\Requests\RequestBudgetRequest;
use App\Http\Requests\SubmitBudgetRequest;
use App\Models\Ticket;
use App\Models\User;
use App\Services\NotificationService;
use App\Services\TicketStatusService;
use Illuminate\Http\JsonResponse;

class TicketBudgetController extends Controller
{
    private const BUDGET_THRESHOLD = 50.00;

    public function __construct(
        private readonly TicketStatusService $statusService,
        private readonly NotificationService $notificationService,
    ) {}

    public function submitEstimate(SubmitBudgetRequest $request, int $id): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_TECHNICIAN, User::ROLE_ADMIN]);

        $data = BudgetSubmissionData::fromSubmitEstimate($request->validated());
        $ticket = Ticket::findOrFail($id);

        if ($request->has('budget_details')) {
            $ticket->budget_details = $data->budgetDetails;
        }

        if (! $ticket->assigned_to) {
            $ticket->assigned_to = $user->id;
        }

        $ticket->budget_requested = true;
        $ticket->budget_amount = $data->estimatedBudget;

        $threshold = config('services.budget.threshold', self::BUDGET_THRESHOLD);

        if ($data->estimatedBudget > $threshold) {
            return $this->handleAboveThreshold($ticket, $data->estimatedBudget, $threshold);
        }

        return $this->handleBelowThreshold($ticket, $data->estimatedBudget, $threshold);
    }

    public function requestAuthorization(RequestBudgetRequest $request, int $id): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_TECHNICIAN, User::ROLE_ADMIN]);

        $data = BudgetSubmissionData::fromDetailedRequest($request->validated());
        $ticket = Ticket::findOrFail($id);

        if ($request->has('budget_details')) {
            $ticket->budget_details = $data->budgetDetails;
        }

        $threshold = config('services.budget.threshold', self::BUDGET_THRESHOLD);

        if ($data->estimatedBudget > $threshold) {
            $ticket->budget_requested = true;
            $ticket->budget_status = BudgetStatusEnum::Pending->value;
            $ticket->budget_amount = $data->estimatedBudget;
            $ticket->budget_requested_at = now();

            $pendingStatusId = $this->statusService->getByName(TicketStatusEnum::PendingBudget);
            if ($pendingStatusId) {
                $ticket->status_id = $pendingStatusId;
            }

            $ticket->save();

            return response()->json([
                'message' => __('Pedido de orçamento submetido com detalhes. Aguarde aprovação.'),
                'ticket' => $ticket->load(['equipment', 'room', 'technician', 'status']),
            ]);
        }

        $inProgressId = $this->statusService->getByName(TicketStatusEnum::InProgress);
        if ($inProgressId) {
            $ticket->status_id = $inProgressId;
        }
        $ticket->save();

        return response()->json([
            'message' => __('Custo dentro do limiar. Intervenção autorizada automaticamente.'),
            'ticket' => $ticket->load(['equipment', 'room', 'technician', 'status']),
        ]);
    }

    private function handleAboveThreshold(Ticket $ticket, float $amount, float $threshold): JsonResponse
    {
        $ticket->budget_status = BudgetStatusEnum::Pending->value;
        $ticket->budget_requested_at = now();

        $pendingStatusId = $this->statusService->getByName(TicketStatusEnum::PendingBudget);
        if ($pendingStatusId) {
            $ticket->status_id = $pendingStatusId;
        }

        $ticket->save();

        $this->notificationService->notifyBudgetSubmitted(
            $ticket,
            "O técnico submeteu um orçamento de {$amount}€ para o ticket #{$ticket->id} - {$ticket->title}. Aguarda aprovação."
        );

        return response()->json([
            'message' => __('Custo estimado excede o limiar. Ticket pendente de aprovação orçamental.'),
            'ticket' => $ticket->load(['equipment', 'room', 'technician', 'status']),
        ]);
    }

    private function handleBelowThreshold(Ticket $ticket, float $amount, float $threshold): JsonResponse
    {
        $ticket->budget_status = null;
        $inProgressId = $this->statusService->getByName(TicketStatusEnum::InProgress);
        if ($inProgressId) {
            $ticket->status_id = $inProgressId;
        }
        $ticket->save();

        $this->notificationService->notifyBudgetAutoApproved(
            $ticket,
            "Orçamento de {$amount}€ para o ticket #{$ticket->id} foi auto-aprovado (dentro do limiar de {$threshold}€). Pode prosseguir."
        );

        return response()->json([
            'message' => __('Custo estimado dentro da autonomia. Pode prosseguir com a intervenção.'),
            'ticket' => $ticket->load(['equipment', 'room', 'technician', 'status']),
        ]);
    }
}
