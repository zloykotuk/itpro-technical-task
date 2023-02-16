<?php

namespace Database\Seeders;

use App\Models\Integration;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        Integration::query()->insert([
            [
                'id' => 1,
                'name' => 'Creatio',
                'token' => null,
                'host' => 'https://www.creatio.com/ua/',
                'username' => 'username',
                'password' => 'password'
            ],
            [
                'id' => 2,
                'name' => 'Perfectum',
                'token' => '6IQIcOwDdstrjcFF',
                'host' => 'https://perfectum.ua/',
                'username' => 'perfectum',
                'password' => 'password1'
            ]
        ]);
    }
}
