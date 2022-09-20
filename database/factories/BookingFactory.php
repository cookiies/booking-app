<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $start = $this->faker->dateTimeThisMonth('+0 days', '+1 month');

        // Faker library doesn't use DateTimeImmutable,
        // using clone to pass by value (instead of by reference)
        $end_clone = clone $start;

        $end = $end_clone->modify('+1 hours');

        return [
            'title' => $this->faker->text(20),
            'start' => $start,
            'end' => $end,
            'user_id' => User::all()->random(),
        ];
    }
}
