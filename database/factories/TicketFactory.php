<?php

namespace Database\Factories;

use App\Enums\TicketPriorityEnum;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'reporter_name' => null,
            'reporter_contact' => null,
            'source' => 'web',
            'assigned_to' => null,
            'room_id' => null,
            'equipment_id' => null,
            'status_id' => TicketStatus::query()->inRandomOrder()->value('id'),
            'reference' => 'TKT-'.now()->format('YmdHis').'-'.fake()->unique()->randomNumber(5),
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'priority' => fake()->randomElement([
                TicketPriorityEnum::Low->value,
                TicketPriorityEnum::Medium->value,
                TicketPriorityEnum::High->value,
                TicketPriorityEnum::Critical->value,
            ]),
            'opened_at' => now()->subHours(2),
            'in_progress_at' => null,
            'closed_at' => null,
            'reopened_at' => null,
            'scheduled_at' => null,
            'scheduled_end' => null,
            'scheduled' => false,
            'minutes_spent' => fake()->numberBetween(15, 240),
            'estimated_cost' => fake()->randomFloat(2, 0, 250),
            'budget_requested' => false,
            'budget_status' => null,
            'budget_amount' => null,
            'budget_approved_by' => null,
        ];
    }
}
