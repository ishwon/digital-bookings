<?php

namespace Database\Seeders;

use App\Models\Salesperson;
use Illuminate\Database\Seeder;

class SalespersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Salesperson::factory()->count(10)->create();
    }
}
