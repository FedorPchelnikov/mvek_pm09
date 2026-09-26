<?php

namespace App\Http\Controllers;

use App\Enums\BookingStatus;
use App\Models\Booking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Booking $booking): RedirectResponse
    {
        abort_unless($booking->user_id === $request->user()->id, 403);

        if ($booking->status !== BookingStatus::Completed || $booking->review()->exists()) {
            return redirect()
                ->route('cabinet')
                ->with('error', 'Отзыв можно оставить только по завершенному банкету и только один раз.');
        }

        $validated = $request->validate([
            'rating' => ['required', 'integer', 'between:1,5'],
            'text' => ['required', 'string', 'max:1000'],
        ]);

        $booking->review()->create([
            'user_id' => $request->user()->id,
            'rating' => $validated['rating'],
            'text' => $validated['text'],
        ]);

        return redirect()
            ->route('cabinet')
            ->with('status', 'Отзыв добавлен.');
    }
}
