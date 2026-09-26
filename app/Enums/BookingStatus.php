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

    public static function options(): array
    {
        $options = [];

        foreach (self::cases() as $case) {
            $options[$case->value] = $case->label();
        }

        return $options;
    }
}
