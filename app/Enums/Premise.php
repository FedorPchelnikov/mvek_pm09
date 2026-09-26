<?php

namespace App\Enums;

enum Premise: string
{
    case Hall = 'hall';
    case Restaurant = 'restaurant';
    case SummerVeranda = 'summer_veranda';
    case ClosedVeranda = 'closed_veranda';

    public function label(): string
    {
        return match ($this) {
            self::Hall => 'Зал',
            self::Restaurant => 'Ресторан',
            self::SummerVeranda => 'Летняя веранда',
            self::ClosedVeranda => 'Закрытая веранда',
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
