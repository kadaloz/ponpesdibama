<?php

use InvalidArgumentException;

if (!function_exists('enum_values')) {
    function enum_values(string $enumClass): array
    {
        if (!enum_exists($enumClass)) {
            throw new InvalidArgumentException("Class {$enumClass} is not a valid enum.");
        }

        return array_map(fn($case) => $case->value, $enumClass::cases());
    }
}
