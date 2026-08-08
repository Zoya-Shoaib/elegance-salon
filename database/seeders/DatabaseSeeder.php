<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call your Adminseeder here!
        $this->call([
            Adminseeder::class,
            ClientSeeder::class,
            InventorySeeder::class,
        ]);
    }
}