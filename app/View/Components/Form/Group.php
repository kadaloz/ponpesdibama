<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Group extends Component
{
    public string $name;
    public string $label;

    public function __construct(string $name, string $label)
    {
        $this->name = $name;
        $this->label = $label;
    }

    public function render()
    {
        return view('components.form.group');
    }
}
