<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class PassportSeeder extends Seeder
{
    public function run(): void
    {
        Artisan::call('key:generate', [
            '--force' => true
        ]);

        Artisan::call('passport:install');

        Artisan::call('passport:client', [
            '--password' => true,
            '--name'     => 'users',
            '--provider' => 'users'
        ]);
    }
}
