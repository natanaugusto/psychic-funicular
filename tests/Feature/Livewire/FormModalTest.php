<?php

use App\Http\Livewire\FormModal;

beforeEach(function () {
    /**
     * @var TestableLivewire $component
     * @var FormModal $instance
     */
    extract(array:createLivewireComponentInstance(
        name:FormModal::class,
        params:['inputsView' => 'companies.inputs']
    ));
    $this->component = $component;
    $this->instance = $instance;
});


it(description:'mount', closure:function () {
    $this->component
        ->assertViewIs(name:'livewire.form-modal')
        ->assertOk();
});
