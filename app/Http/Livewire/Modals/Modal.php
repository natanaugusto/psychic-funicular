<?php

namespace App\Http\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;
use Psy\Exception\TypeErrorException;
use Livewire\Exceptions\PublicPropertyNotFoundException;

abstract class Modal extends ModalComponent
{
    public const ACCEPTS_MODEL_AS = ['object', 'integer'];
    public $title;
    public $confirmBtnLabel = 'Ok';
    public $confirmBtnColor = 'blue';
    public $cancelBtnLabel = 'Cancel';
    public $cancelBtnColor = 'gray';
    /**
     * @var null|array [$class, $action, $model, $event]
     */
    public $confirmAction = null;

    public function confirm(): void
    {
        if (is_null($this->confirmAction)) {
            throw new PublicPropertyNotFoundException(property:'confirmAction', component:__CLASS__);
        }

        list($class, $action, $model, $event) = $this->confirmAction;
        $instance = app()->make(abstract:$class);
        if (in_array(gettype($model), self::ACCEPTS_MODEL_AS)) {
            if (is_numeric($model)) {
                $model = $instance->getModel()::find($model);
            }
        } else {
            throw new TypeErrorException(
                'ConfirmModal just accept ' . implode(separator:',', array:self::ACCEPTS_MODEL_AS) . '. ' . gettype($model) . ' was passed'
            );
        }

        if ($instance->{$action}($model)) {
            if ($event) {
                $this->emit($event);
            }
            $this->closeModal();
        }
    }

    public function cancel(): void
    {
        $this->closeModal();
    }
}
