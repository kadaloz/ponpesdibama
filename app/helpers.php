<?php

function enum_values(string $enumClass): array
{
    if (!enum_exists($enumClass)) {
        throw new InvalidArgumentException("Class $enumClass is not a valid enum.");
    }

    return array_column($enumClass::cases(), 'value');
}
