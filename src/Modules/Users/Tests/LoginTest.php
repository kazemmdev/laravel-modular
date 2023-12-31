<?php

use Modules\Users\User;

use function Pest\Laravel\post;

it('can accept a login request with valid credential', function () {
    User::factory()->create(['email' => "test@app.io"]);

    post('/api/v1/login', [
        'email'    => "test@app.io",
        'password' => 'password'
    ])->assertStatus(202);
});

it('can reject a login request with invalid password', function () {
    User::factory()->create(['email' => "test@app.io"]);

    post('/api/v1/login', [
        'email'    => "test@app.io",
        'password' => 'invalid'
    ])->assertStatus(401);
});

it('can reject a login request with invalid email', function () {
    post('/api/v1/login', [
        'email'    => "test@app.io",
        'password' => 'password'
    ])->assertStatus(422);
});

it('can reject a login request with invalid form data request', function () {
    post('/api/v1/login', [
        'test' => "test",
    ])->assertStatus(422);
});
