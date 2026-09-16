<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clients')->insert([
            [
                'name'         => 'Penelope Cruz',
                'phone'      => '(123) 456-7890',
                'email'     => 'penelope.cruz@example.com',
                'preferences'       => 'Prefers Marcus for Hair Styling',
                'notes'      => 'Allergic to specific hair dye chemicals. Prefers quiet environment.',
                'member_since' => 2024,
                'total_visits'      => 5,
                'last_visit_at'   => '2026-06-15',
                'last_service'      => 'Balayage',
                'is_vip'            => true,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'         => 'Ayesha Khan',
                'phone'      => '(030) 012-3456',
                'email'     => 'ayesha.khan@example.com',
                'preferences'       => 'Prefers Nida for Hair Treatments',
                'notes'      => 'Sensitive scalp. Prefers sulphate-free shampoos.',
                'member_since' => 2025,
                'total_visits'      => 3,
                'last_visit_at'   => '2026-07-10',
                'last_service'      => 'Hair Spa & Cut',
                'is_vip'            => false,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'         => 'Sana Fatima',
                'phone'      => '(031) 298-7654',
                'email'     => 'sana.fatima@example.com',
                'preferences'       => 'Prefers Kiran for Bridal Makeup',
                'notes'      => 'Requested trial makeup before event.',
                'member_since' => 2026,
                'total_visits'      => 1,
                'last_visit_at'   => '2026-07-20',
                'last_service'      => 'Party Makeup',
                'is_vip'            => true,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'         => 'Mariam Ali',
                'phone'      => '(033) 355-5123',
                'email'     => 'mariam.ali@example.com',
                'preferences'       => 'No specific stylist preference',
                'notes'      => 'Needs quick appointments during weekend mornings.',
                'member_since' => 2026,
                'total_visits'      => 0,
                'last_visit_at'   => null,
                'last_service'      => null,
                'is_vip'            => false,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'         => 'Zainab Ahmed',
                'phone'      => '(032) 144-4889',
                'email'     => 'zainab.ahmed@example.com',
                'preferences'       => 'Prefers Mehwish for Manicure & Pedicure',
                'notes'      => 'Prefers organic/vegan polish products.',
                'member_since' => 2023,
                'total_visits'      => 12,
                'last_visit_at'   => '2026-07-22',
                'last_service'      => 'Gel Pedicure',
                'is_vip'            => true,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'         => 'Hira Tariq',
                'phone'      => '(034) 566-6778',
                'email'     => 'hira.tariq@example.com',
                'preferences'       => 'Prefers Rabia for Skincare Services',
                'notes'      => 'Dry skin type. Requires extra hydrating mask.',
                'member_since' => 2026,
                'total_visits'      => 2,
                'last_visit_at'   => '2026-07-01',
                'last_service'      => 'Hydra Facial',
                'is_vip'            => false,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);
    }
}