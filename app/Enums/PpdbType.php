<?php

namespace App\Enums;

enum PpdbType: string
{
    case Asrama = 'Asrama';
    case PulangPergi = 'Pulang-Pergi';

    public function label(): string
    {
        return match ($this) {
            self::Asrama => 'Asrama',
            self::PulangPergi => 'Pulang-Pergi',
        };
    }
}
