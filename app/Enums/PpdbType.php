<?php

namespace App\Enums;

enum PpdbType: string
{
    case Asrama = 'Asrama';
    case PulangPergi = 'Pulang-Pergi';

    public static function options(): array
    {
        return [
            self::Asrama->value => 'Asrama',
            self::PulangPergi->value => 'Pulang-Pergi',
        ];
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
