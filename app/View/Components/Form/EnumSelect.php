<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;
use UnitEnum;

class EnumSelect extends Component
{
    public string $name;
    public string $label;
    public ?string $selected;
    public array $options;
    public ?string $placeholder;

   public function __construct(string $name, string $enum, string $label = '', ?string $selected = null, ?string $placeholder = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->selected = $selected;
        $this->placeholder = $placeholder;

        if (!enum_exists($enum)) {
            throw new \InvalidArgumentException("Class $enum is not a valid enum.");
        }

        $this->options = collect($enum::cases())->mapWithKeys(function (UnitEnum $case) {
            return [$case->value => method_exists($case, 'label') ? $case->label() : ucfirst(strtolower(str_replace('_', ' ', $case->name)))];
        })->toArray();
    }

    public function render()
    {
        return view('components.form.enum-select');
    }
}
