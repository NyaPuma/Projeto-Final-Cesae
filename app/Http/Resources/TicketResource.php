<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class TicketResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'reference' => $this->reference,
            'title' => $this->title,
            'description' => $this->description,
            'priority' => $this->priority,
            'urgent' => $this->urgent,
            'user_id' => $this->user_id,
            'assigned_to' => $this->assigned_to,
            'equipment_id' => $this->equipment_id,
            'room_id' => $this->room_id,
            'status_id' => $this->status_id,
            'status' => $this->status,
            'user' => $this->whenLoaded('user', fn () => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
            ]),
            'technician' => $this->whenLoaded('technician', fn () => [
                'id' => $this->technician->id,
                'name' => $this->technician->name,
            ]),
            'equipment' => $this->whenLoaded('equipment', fn () => [
                'id' => $this->equipment->id,
                'name' => $this->equipment->name,
            ]),
            'room' => $this->whenLoaded('room', fn () => [
                'id' => $this->room->id,
                'name' => $this->room->name,
                'code' => $this->room->code,
            ]),
            'status_name' => $this->status?->name,
            'opened_at' => $this->opened_at?->toIso8601String(),
            'in_progress_at' => $this->in_progress_at?->toIso8601String(),
            'closed_at' => $this->closed_at?->toIso8601String(),
            'scheduled_at' => $this->scheduled_at?->toIso8601String(),
            'due_at' => $this->due_at?->toIso8601String(),
            'budget_requested' => $this->budget_requested,
            'budget_status' => $this->budget_status,
            'budget_amount' => $this->budget_amount,
            'budget_requested_at' => $this->budget_requested_at?->toIso8601String(),
            'resolution' => $this->resolution,
            'minutes_spent' => $this->minutes_spent,
            'sla_breached' => $this->sla_breached,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
