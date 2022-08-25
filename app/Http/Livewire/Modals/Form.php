<?php

namespace App\Http\Livewire\Modals;

use Illuminate\Contracts\View\View;

class Form extends Modal
{
    public $inputsView;

    public function render(): View
    {
        return view('livewire.modals.form');
    }
}
