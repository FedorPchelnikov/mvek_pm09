<?php

namespace App\Http\Controllers;

use App\Enums\BookingStatus;
use App\Enums\PaymentMethod;
use App\Enums\Premise;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function create(): View
    {
        return view('bookings.create', [
            'premises' => Premise::options(),
            'paymentMethods' => PaymentMethod::options(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'premise' => ['required', Rule::enum(Premise::class)],
            'banquet_date' => ['required', 'date_format:d.m.Y', 'after_or_equal:today'],
            'payment_method' => ['required', Rule::enum(PaymentMethod::class)],
        ]);

        $request->user()->bookings()->create([
            'premise' => $validated['premise'],
            'banquet_date' => Carbon::createFromFormat('d.m.Y', $validated['banquet_date']),
            'payment_method' => $validated['payment_method'],
            'status' => BookingStatus::New,
        ]);

        return redirect()
            ->route('cabinet')
            ->with('status', 'Заявка отправлена на согласование администратору.');
    }
}
