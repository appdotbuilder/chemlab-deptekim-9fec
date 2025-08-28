<?php

namespace Database\Factories;

use App\Models\TicketsPassword;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TicketsPassword>
 */
class TicketsPasswordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ticket_code' => TicketsPassword::generateTicketCode(),
            'user_id' => User::factory(),
            'status' => fake()->randomElement(['open', 'in_progress', 'resolved', 'rejected']),
            'handler_id' => null,
            'reason' => fake()->paragraph(),
            'admin_notes' => fake()->boolean(30) ? fake()->paragraph() : null,
            'temporary_password' => null,
            'resolved_at' => null,
        ];
    }

    /**
     * Indicate that the ticket is open.
     */
    public function open(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'open',
            'handler_id' => null,
            'admin_notes' => null,
            'temporary_password' => null,
            'resolved_at' => null,
        ]);
    }

    /**
     * Indicate that the ticket is in progress.
     */
    public function inProgress(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'in_progress',
            'handler_id' => User::factory(),
            'admin_notes' => fake()->paragraph(),
        ]);
    }

    /**
     * Indicate that the ticket is resolved.
     */
    public function resolved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'resolved',
            'handler_id' => User::factory(),
            'admin_notes' => fake()->paragraph(),
            'temporary_password' => fake()->password(8, 12),
            'resolved_at' => fake()->dateTimeBetween('-1 month', 'now'),
        ]);
    }

    /**
     * Indicate that the ticket is rejected.
     */
    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'rejected',
            'handler_id' => User::factory(),
            'admin_notes' => fake()->paragraph(),
            'resolved_at' => fake()->dateTimeBetween('-1 month', 'now'),
        ]);
    }
}