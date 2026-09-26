<?php

namespace App\Models;

use App\Enums\BookingStatus;
use App\Enums\PaymentMethod;
use App\Enums\Premise;
use Database\Factories\BookingFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['user_id', 'premise', 'banquet_date', 'payment_method', 'status'])]
class Booking extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'premise' => Premise::class,
            'payment_method' => PaymentMethod::class,
            'status' => BookingStatus::class,
            'banquet_date' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function review(): HasOne
    {
        return $this->hasOne(Review::class);
    }

    public function canBeReviewed(): bool
    {
        return $this->status === BookingStatus::Completed
            && $this->review()->doesntExist();
    }
}
