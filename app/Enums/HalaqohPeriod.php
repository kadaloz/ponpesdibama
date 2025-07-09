<?php

namespace App\Enums;

enum HalaqohPeriod: string
{
    case Sore = 'Sore';
    case Malam = 'Malam';

    public static function options(): array
    {
        return [
            self::Sore->value => 'Halaqoh Sore',
            self::Malam->value => 'Halaqoh Malam',
        ];
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
