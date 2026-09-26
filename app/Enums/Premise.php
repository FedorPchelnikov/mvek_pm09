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

    public function images(): array
    {
        return match ($this) {
            self::Hall => [
                'images/premises/hall-1.jpg',
                'images/premises/hall-2.jpg',
            ],
            self::Restaurant => [
                'images/premises/restaurant-1.jpg',
                'images/premises/restaurant-2.jpg',
            ],
            self::SummerVeranda => [
                'images/premises/summer-veranda-1.jpg',
                'images/premises/summer-veranda-2.jpg',
                'images/premises/summer-veranda-3.jpg',
                'images/premises/summer-veranda-4.jpg',
            ],
            self::ClosedVeranda => [
                'images/premises/closed-veranda-1.jpg',
                'images/premises/closed-veranda-2.jpg',
                'images/premises/closed-veranda-3.webp',
                'images/premises/closed-veranda-4.png',
            ],
        };
    }

    public function image(): string
    {
        return $this->images()[0];
    }

    public static function gallery(): array
    {
        $gallery = [];

        foreach (self::cases() as $case) {
            foreach ($case->images() as $image) {
                $gallery[] = ['src' => $image, 'alt' => $case->label()];
            }
        }

        return $gallery;
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
