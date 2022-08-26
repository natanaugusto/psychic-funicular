<?php

use App\Http\Livewire\CompanyTable;
use App\Models\Company;
use App\Models\User;
use Livewire\Testing\TestableLivewire;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertSoftDeleted;

beforeEach(function () {
    /**
     * @var TestableLivewire $component
     * @var CompanyTable $instance
     */
    extract(createLivewireComponentInstance(name:CompanyTable::class));
    $this->component = $component;
    $this->instance = $instance;
});

it(description:'test mount', closure:function () {
    expect(value:$this->instance->getPrimaryKey())
        ->toBe(expected:CompanyTable::PRIMARY_KEY);

    expect(value:$this->instance->getTableWrapperAttributes())
        ->toBe(expected:CompanyTable::TABLE_WRAPPER_ATTRS);
    expect(value:$this->instance->getSearchStatus())->toBeTrue();
    expect(value:$this->instance->getColumnSelectStatus())->toBeFalse();
});

it(description:'test companies page', closure:function () {
    /**
    * @var Collection|User
    */
    $user = User::factory()->create();
    $companies = Company::factory(count:50)->create();

    $response = actingAs($user)->get(route(name:'companies'));
    $response->assertViewIs(value:'companies');
    $response->assertSee(__(key:'Companies'));
    $response->assertSeeLivewire(component:'company-table');

    $columns = getTableColumns($this->instance, $this->component);
    $columnsArr = array_map(
        callback:static fn ($column) => $column->getTitle(),
        array:$columns
    );
    foreach ($columnsArr as $column) {
        $response->assertSee(__(key:$column));
    }

    $columnsArr = array_map(
        callback:static fn ($column) => $column->getFrom(),
        array:$columns
    );
    foreach ($companies->chunk(size:$this->instance->getPerPage())[0] as $company) {
        foreach ($company->toArray() as $attr => $val) {
            if (in_array(needle:$attr, haystack:$columnsArr)) {
                $response->assertSee(__(key:$val));
            }
        }
    }
});

it(description:'test delete', closure:function () {
    $company = Company::factory()->createOne();
    assertDatabaseHas(table:Company::class, data:$company->toArray());
    $this->component->call('delete', $company);
    assertSoftDeleted(table:Company::class, data:$company->toArray());
});

function getTableColumns(CompanyTable $instance, TestableLivewire $component): array
{
    $columns = $instance->columns();
    expect(value:$columns)->toBeArray();
    foreach ($columns as $column) {
        $component->assertSee(__(key:$column->getTitle()));
    }

    return $columns;
}
