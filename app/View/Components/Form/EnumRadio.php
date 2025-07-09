<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;
use UnitEnum;

class EnumRadio extends Component
{
    public string $name;
    public string $label;
    public ?string $checked;
    public array $options;

    public function __construct(string $name, string $label, string $enum, ?string $checked = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->checked = $checked;

        if (!enum_exists($enum)) {
            throw new \InvalidArgumentException("Class $enum is not a valid enum.");
        }

        $this->options = collect($enum::cases())->mapWithKeys(function (UnitEnum $case) {
            return [$case->value => method_exists($case, 'label') ? $case->label() : ucfirst(strtolower(str_replace('_', ' ', $case->name)))];
        })->toArray();
    }

    public function render()
    {
        return view('components.form.enum-radio');
    }
}

