<?php

namespace App\Http\Controllers;

use App\DTOs\BudgetSubmissionData;
use App\Enums\BudgetStatusEnum;
use App\Enums\TicketStatusEnum;
use App\Http\Requests\RequestBudgetRequest;
use App\Http\Requests\SubmitBudgetRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use App\Services\NotificationService;
use App\Services\TicketStatusService;
use Illuminate\Http\JsonResponse;

final class TicketBudgetController extends Controller
{
    public function __construct(
        private readonly TicketStatusService $statusService,
        private readonly NotificationService $notificationService,
    ) {}

    /**
     * Submete uma estimativa orçamental para um ticket.
     */
    public function submitEstimate(SubmitBudgetRequest $request, Ticket $ticket): JsonResponse
    {
        // 1. Autorização via Policy
        $this->authorize('update', $ticket);

        $data = BudgetSubmissionData::fromSubmitEstimate($request->validated());

        $this->applyBudgetChanges($ticket, $data, $request->user());

        $threshold = (float) config('services.custom.budget.threshold', 0);

        if ($data->estimatedBudget > $threshold) {
            return $this->handleAboveThreshold($ticket, $data->estimatedBudget, $threshold);
        }

        return $this->handleBelowThreshold($ticket, $data->estimatedBudget, $threshold);
    }

    /**
     * Solicita autorização de orçamento detalhado para um ticket.
     */
    public function requestAuthorization(RequestBudgetRequest $request, Ticket $ticket): JsonResponse
    {
        // 1. Autorização via Policy
        $this->authorize('update', $ticket);

        $data = BudgetSubmissionData::fromDetailedRequest($request->validated());

        $this->applyBudgetChanges($ticket, $data, $request->user());

        $threshold = (float) config('services.custom.budget.threshold', 0);

        if ($data->estimatedBudget > $threshold) {
            return $this->handleAboveThreshold($ticket, $data->estimatedBudget, $threshold);
        }

        return $this->handleBelowThreshold($ticket, $data->estimatedBudget, $threshold);
    }

    /**
     * Aplica as alterações comuns de orçamento e atribuição ao ticket.
     */
    private function applyBudgetChanges(Ticket $ticket, BudgetSubmissionData $data, $user): void
    {
        if ($data->budgetDetails !== null) {
            $ticket->budget_details = $data->budgetDetails;
        }

        if (! $ticket->assigned_to) {
            $ticket->assigned_to = $user->id;
        }

        $ticket->budget_requested = true;
        $ticket->budget_amount = $data->estimatedBudget;
    }

    /**
     * Processa o fluxo quando o orçamento excede o limiar configurado.
     */
    private function handleAboveThreshold(Ticket $ticket, float $amount, float $threshold): JsonResponse
    {
        $ticket->budget_status = BudgetStatusEnum::Pending->value;
        $ticket->budget_requested_at = now();

        $pendingStatusId = $this->statusService->getByName(TicketStatusEnum::PendingBudget);
        if ($pendingStatusId) {
            $ticket->status_id = $pendingStatusId;
        }

        $ticket->save();
        $ticket->loadMissing(['equipment', 'room', 'technician', 'status']);

        $this->notificationService->notifyBudgetSubmitted(
            $ticket,
            __('O técnico submeteu um orçamento de :amount€ para o ticket #:id - :title. Aguarda aprovação.', [
                'amount' => $amount,
                'id' => $ticket->id,
                'title' => $ticket->title,
            ])
        );

        return response()->json([
            'message' => __('Custo estimado excede o limiar. Ticket pendente de aprovação orçamental.'),
            'ticket' => new TicketResource($ticket),
        ]);
    }

    /**
     * Processa o fluxo quando o orçamento está abaixo do limiar configurado.
     */
    private function handleBelowThreshold(Ticket $ticket, float $amount, float $threshold): JsonResponse
    {
        $ticket->budget_status = null;

        $inProgressId = $this->statusService->getByName(TicketStatusEnum::InProgress);
        if ($inProgressId) {
            $ticket->status_id = $inProgressId;
        }

        $ticket->save();
        $ticket->loadMissing(['equipment', 'room', 'technician', 'status']);

        $this->notificationService->notifyBudgetAutoApproved(
            $ticket,
            __('Orçamento de :amount€ para o ticket #:id foi auto-aprovado (dentro do limiar de :threshold€). Pode prosseguir.', [
                'amount' => $amount,
                'id' => $ticket->id,
                'threshold' => $threshold,
            ])
        );

        return response()->json([
            'message' => __('Custo estimado dentro da autonomia. Pode prosseguir com a intervenção.'),
            'ticket' => new TicketResource($ticket),
        ]);
    }
}
