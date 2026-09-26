<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BookingStatus;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function index(Request $request): View
    {
        $status = BookingStatus::tryFrom((string) $request->query('status'));
        $direction = $request->query('direction') === 'asc' ? 'asc' : 'desc';

        $bookings = Booking::query()
            ->with('user')
            ->when($status, fn ($query) => $query->where('status', $status))
            ->orderBy('created_at', $direction)
            ->orderBy('id', $direction)
            ->paginate(10)
            ->withQueryString();

        return view('admin.bookings.index', [
            'bookings' => $bookings,
            'statuses' => BookingStatus::options(),
            'currentStatus' => $status?->value,
            'direction' => $direction,
        ]);
    }

    public function update(Request $request, Booking $booking): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::enum(BookingStatus::class)],
        ]);

        $booking->update(['status' => $validated['status']]);

        return redirect()
            ->back()
            ->with('status', 'Статус заявки №'.$booking->id.' изменен на «'.BookingStatus::from($validated['status'])->label().'».');
    }
}
