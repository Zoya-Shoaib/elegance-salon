<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Adminseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
                'name'=>"admin",
                'email'    =>"admin@elegance.com",
                'password' => Hash::make("admin123"),
                'role' => "admin"
                
            ]);
    }
}
