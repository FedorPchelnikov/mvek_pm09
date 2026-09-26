<?php

namespace Database\Factories;

use App\Enums\BookingStatus;
use App\Enums\PaymentMethod;
use App\Enums\Premise;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'premise' => fake()->randomElement(Premise::cases()),
            'banquet_date' => fake()->dateTimeBetween('+1 day', '+3 months'),
            'payment_method' => fake()->randomElement(PaymentMethod::cases()),
            'status' => BookingStatus::New,
        ];
    }
}
