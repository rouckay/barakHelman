<?php

namespace Database\Seeders;

use App\Models\customers;
use App\Models\employees;
use App\Models\Finance;
use App\Models\markets;
use App\Models\numeraha;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        customers::factory(100)->create();
        employees::factory(100)->create();
        numeraha::factory(100)->create();
        markets::factory(100)->create();
        Finance::factory(100)->create();
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
