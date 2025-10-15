<?php

namespace Database\Seeders;

use App\Models;
use Illuminate\Database\Seeder;

class TicketsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Models\Ticket::factory(10)->create();
    }
}
