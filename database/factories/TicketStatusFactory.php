<?php

namespace Database\Factories;

use App\Enums\TicketStatusEnum;
use App\Models\TicketStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TicketStatus>
 */
class TicketStatusFactory extends Factory
{
    protected $model = TicketStatus::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                TicketStatusEnum::Open->value,
                TicketStatusEnum::InProgress->value,
                TicketStatusEnum::Closed->value,
                TicketStatusEnum::Cancelled->value,
                TicketStatusEnum::PendingBudget->value,
                TicketStatusEnum::Rejected->value,
                'aguarda peças',
                'em revisão',
                'sem rede',
            ]),
            'code' => 'STS-'.strtoupper($this->faker->unique()->lexify('????')),
            'description' => $this->faker->sentence(12),
            'type_id' => null,
        ];
    }
}
