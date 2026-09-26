<?php

namespace Database\Seeders;

use App\Enums\BookingStatus;
use App\Enums\PaymentMethod;
use App\Enums\Premise;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        if (User::where('login', 'demo2026')->exists()) {
            return;
        }
        // фейковые пользователи
        $demo = User::create([
            'login' => 'demo2026',
            'name' => 'Иванов Иван Иванович',
            'phone' => '+7 (912) 345-67-89',
            'email' => 'demo@banquetam.net',
            'password' => 'demo2026pass',
        ]);
        // фейковые пользователи
        $second = User::create([
            'login' => 'petrova2026',
            'name' => 'Петрова Анна Сергеевна',
            'phone' => '+7 (903) 111-22-33',
            'email' => 'petrova@banquetam.net',
            'password' => 'petrova2026pass',
        ]);

        Booking::create([
            'user_id' => $demo->id,
            'premise' => Premise::Hall,
            'banquet_date' => Carbon::today()->addDays(14),
            'payment_method' => PaymentMethod::Card,
            'status' => BookingStatus::New,
        ]);

        Booking::create([
            'user_id' => $demo->id,
            'premise' => Premise::Restaurant,
            'banquet_date' => Carbon::today()->addDays(30),
            'payment_method' => PaymentMethod::Online,
            'status' => BookingStatus::Assigned,
        ]);

        $completedBooking = Booking::create([
            'user_id' => $demo->id,
            'premise' => Premise::SummerVeranda,
            'banquet_date' => Carbon::today()->subDays(10),
            'payment_method' => PaymentMethod::Card,
            'status' => BookingStatus::Completed,
        ]);

        Booking::create([
            'user_id' => $second->id,
            'premise' => Premise::ClosedVeranda,
            'banquet_date' => Carbon::today()->addDays(45),
            'payment_method' => PaymentMethod::Online,
            'status' => BookingStatus::New,
        ]);

        Booking::create([
            'user_id' => $second->id,
            'premise' => Premise::Hall,
            'banquet_date' => Carbon::today()->subDays(3),
            'payment_method' => PaymentMethod::Card,
            'status' => BookingStatus::Assigned,
        ]);

        Booking::create([
            'user_id' => $demo->id,
            'premise' => Premise::Hall,
            'banquet_date' => Carbon::today()->subDays(20),
            'payment_method' => PaymentMethod::Online,
            'status' => BookingStatus::Completed,
        ]);

        // фейк отзыв
        $completedBooking->review()->create([
            'user_id' => $demo->id,
            'rating' => 5,
            'text' => 'Отличная летняя веранда, банкет прошёл замечательно. Персонал внимательный, всё понравилось.',
        ]);
    }
}
