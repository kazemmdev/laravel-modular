<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\Users\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->firstOrCreate([
            "email" => config('auth.admin.email')
        ], [
            'name'              => config('auth.admin.name'),
            "email"             => config('auth.admin.email'),
            "password"          => Hash::make(config('auth.admin.password')),
            'email_verified_at' => now(),
        ]);
    }
}
