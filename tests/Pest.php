<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Modules\Users\User;
use Tests\TestCase;

uses(
    TestCase::class,
    RefreshDatabase::class
)->in('../src/Modules/*/Tests');

function actingAsAdmin()
{
    $user = User::first();
    Passport::actingAs($user);
    return $user;
}
