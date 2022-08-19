<?php

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertSoftDeleted;

it(description:'has functional Model and Factory', closure:function () {
    $company = Company::factory()->createOne();
    assertDatabaseHas(table:Company::class, data:$company->toArray());

    $nName = 'New Company Name';
    $company->name = $nName;
    $company->save();
    assertDatabaseHas(table:Company::class, data:['id' => $company->id, 'name' => $nName]);

    $company->delete();
    assertSoftDeleted(table:Company::class, data:['id' => $company->id]);
});

it(description:'belongs to creator', closure:function () {
    $company = Company::factory()->create();
    expect(value:$company->creator)->toBeInstanceOf(User::class);
    expect(value:$company->creator())->toBeInstanceOf(BelongsTo::class);
});
