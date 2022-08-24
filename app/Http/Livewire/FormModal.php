<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;


class FormModal extends ModalComponent
{
    public $inputsView;

    public function render(): View
    {
        return view('livewire.form-modal');
    }
}
