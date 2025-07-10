<?php

use InvalidArgumentException;

if (!function_exists('enum_values')) {
    function enum_values(string $enumClass): array
    {
        if (!class_exists($enumClass) || !method_exists($enumClass, 'cases')) {
            throw new InvalidArgumentException("Class {$enumClass} is not a valid enum.");
        }

        return array_map(fn($case) => $case->value, $enumClass::cases());
    }
}

if (!function_exists('enum_options')) {
    function enum_options(string $enumClass): array
    {
        if (!class_exists($enumClass) || !method_exists($enumClass, 'cases')) {
            throw new InvalidArgumentException("Class {$enumClass} is not a valid enum.");
        }

        return collect($enumClass::cases())->mapWithKeys(fn($case) => [
            $case->value => method_exists($case, 'label') ? $case->label() : $case->value,
        ])->toArray();
    }
}
