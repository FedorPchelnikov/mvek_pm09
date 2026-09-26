<?php

namespace App\Enums;

enum BookingStatus: string
{
    case New = 'new';
    case Assigned = 'assigned';
    case Completed = 'completed';

    public function label(): string
    {
        return match ($this) {
            self::New => 'Новая',
            self::Assigned => 'Банкет назначен',
            self::Completed => 'Банкет завершен',
        };
    }

    public function badgeClasses(): string
    {
        return match ($this) {
            self::New => 'bg-blue-100 text-blue-800',
            self::Assigned => 'bg-amber-100 text-amber-800',
            self::Completed => 'bg-green-100 text-green-800',
        };
    }

    public static function options(): array
    {
        $options = [];

        foreach (self::cases() as $case) {
            $options[$case->value] = $case->label();
        }

        return $options;
    }
}
