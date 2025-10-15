<?php

namespace Database\Factories;

use App\Models;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{

    protected $model = Models\Ticket::class;

    public function definition(): array
    {
        return [
            'customer_id' => Models\Customer::factory(),
            'subject'     => $this->faker->sentence(),
            'text'        => $this->faker->paragraph(),
            'status'      => $this->faker->numberBetween(0, 2),
            'response_at' => $this->faker->optional()->dateTime(),
        ];
    }
}
