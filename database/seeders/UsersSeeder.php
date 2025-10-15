<?php

namespace Database\Seeders;

use App\Models;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{

    public function run(): void
    {
        Models\User::factory(10)->create();
    }
}
