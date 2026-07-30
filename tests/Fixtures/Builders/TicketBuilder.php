<?php

namespace Tests\Fixtures\Builders;

use App\Enums\BudgetStatusEnum;
use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Equipment;
use App\Models\Room;
use App\Models\Ticket;
use App\Models\User;
use App\Services\TicketStatusService;

class TicketBuilder
{
    private array $attributes = [];

    public function __construct()
    {
        $this->attributes = [
            'title' => 'Test Ticket',
            'description' => 'Test Description',
            'priority' => TicketPriorityEnum::Medium->value,
            'status_id' => app(TicketStatusService::class)->getByName(TicketStatusEnum::Open),
            'opened_at' => now(),
        ];
    }

    public static function new(): self
    {
        return new self;
    }

    public function withTitle(string $title): self
    {
        $this->attributes['title'] = $title;

        return $this;
    }

    public function withDescription(string $description): self
    {
        $this->attributes['description'] = $description;

        return $this;
    }

    public function withPriority(string $priority): self
    {
        $this->attributes['priority'] = $priority;

        return $this;
    }

    public function withStatus(string $status): self
    {
        $enum = TicketStatusEnum::tryFrom($status);
        $this->attributes['status_id'] = $enum
            ? app(TicketStatusService::class)->getByName($enum)
            : null;

        return $this;
    }

    public function withUser(User $user): self
    {
        $this->attributes['user_id'] = $user->id;

        return $this;
    }

    public function withAssignedTo(User $technician): self
    {
        $this->attributes['assigned_to'] = $technician->id;

        return $this;
    }

    public function withEquipment(Equipment $equipment): self
    {
        $this->attributes['equipment_id'] = $equipment->id;

        return $this;
    }

    public function withRoom(Room $room): self
    {
        $this->attributes['room_id'] = $room->id;

        return $this;
    }

    public function withScheduledAt(string $scheduledAt): self
    {
        $this->attributes['scheduled_at'] = $scheduledAt;
        $this->attributes['scheduled'] = true;

        return $this;
    }

    public function withBudget(float $amount): self
    {
        $this->attributes['budget_requested'] = true;
        $this->attributes['budget_status'] = BudgetStatusEnum::Pending->value;
        $this->attributes['budget_amount'] = $amount;
        $this->attributes['budget_requested_at'] = now();
        $this->attributes['status_id'] = app(TicketStatusService::class)->getByName(TicketStatusEnum::PendingBudget);

        return $this;
    }

    public function withCost(float $cost): self
    {
        $this->attributes['cost'] = $cost;

        return $this;
    }

    public function withMinutesSpent(int $minutes): self
    {
        $this->attributes['minutes_spent'] = $minutes;

        return $this;
    }

    public function build(): Ticket
    {
        return Ticket::create($this->attributes);
    }

    public function buildArray(): array
    {
        return $this->attributes;
    }
}
