<?php

namespace App\Enums;

enum HalaqohPeriod: string
{
    case Sore = 'Sore';
    case Malam = 'Malam';

    public function label(): string
    {
        return match ($this) {
            self::Sore => 'Sore (Ba’da Ashar)',
            self::Malam => 'Malam (Ba’da Isya)',
        };
    }


    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
