<?php

use App\Models\User;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

use function Pest\Laravel\actingAs;

test(description:'dashboard access', closure:function () {
    $response = $this->get('/');
    $response->assertStatus(HttpResponse::HTTP_FOUND);
    $response->assertRedirect(route(name:'login'));

    $response = $this->get(route('dashboard'));
    $response->assertStatus(HttpResponse::HTTP_FOUND);
    $response->assertRedirect(route(name:'login'));


    /**
    * @var Collection|User
    */
    $user = User::factory()->create();

    actingAs($user);
    $response = $this->get('/');
    $response->assertStatus(HttpResponse::HTTP_FOUND);
    $response->assertRedirect(route(name:'dashboard'));

    $response = $this->get(route('dashboard'));
    $response->assertStatus(HttpResponse::HTTP_OK);
});
