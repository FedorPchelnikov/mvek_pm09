<?php

namespace App\Http\Controllers;

use App\Enums\Premise;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CabinetController extends Controller
{
    public function index(Request $request): View
    {
        $bookings = $request->user()
            ->bookings()
            ->with('review')
            ->orderByDesc('created_at')
            ->get();

        return view('cabinet.index', [
            'bookings' => $bookings,
            'gallery' => Premise::gallery(),
        ]);
    }
}
