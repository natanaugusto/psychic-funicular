<?php

use App\Http\Livewire\CompanyTable;
use App\Http\Livewire\ConfirmModal;
use App\Models\Company;
use Livewire\Testing\TestableLivewire;

use function Pest\Faker\faker;
use function Pest\Laravel\assertSoftDeleted;

beforeEach(function () {
    $this->attrs = [
        'title' => faker()->title,
        'description' => faker()->text(),
        'confirmBtnLabel' => 'Delete',
    ];
    /**
     * @var TestableLivewire $component
     * @var ConfirmModal $instance
     */
    extract(array:createLivewireComponentInstance(
        name:ConfirmModal::class,
        params:$this->attrs
    ));
    $this->component = $component;
    $this->instance = $instance;
});

it(description:'mount', closure:function () {
    $this->component
        ->assertViewIs(name:'livewire.confirm-modal')
        ->assertOk();

    foreach ($this->attrs as $val) {
        $this->component->assertSee($val);
    }
});

it(description:'call confirm - CompanyTable::delete', closure:function () {
    $company = Company::factory()->createOne();
    $this->component->set('confirmAction', [
        CompanyTable::class,
        'delete',
        $company,
        'refreshDatatable'
    ]);
    $this->component->call('confirm');
    $this->component->assertEmitted('refreshDatatable');
    assertSoftDeleted(table:Company::class, data:['id' => $company->id]);
});
