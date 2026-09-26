<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case Card = 'card';
    case Online = 'online';

    public function label(): string
    {
        return match ($this) {
            self::Card => 'Банковская карта',
            self::Online => 'Онлайн-оплата',
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
