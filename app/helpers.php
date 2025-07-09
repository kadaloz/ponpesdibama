<?php

use UnitEnum;

/**
 * Ambil semua nilai dari enum PHP
 *
 * @param class-string<UnitEnum> $enumClass
 * @return array
 */
function enum_values(string $enumClass): array
{
    if (!enum_exists($enumClass)) {
        throw new InvalidArgumentException("Class $enumClass is not a valid enum.");
    }

    return array_column($enumClass::cases(), 'value');
}
