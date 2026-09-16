<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('inventories')->insert([
            [
                'name'           => 'L\'Oréal Professionnel Hair Serum 100ml',
                'category'       => 'Hair Care',
                'stock_level'    => 15,
                'target_stock'   => 30,
                'supplier_name'  => 'L\'Oréal Beauty Supplies',
                'cost_per_unit'  => 2500.00,
                'is_active'      => true,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'Schwarzkopf Keratin Color Cream 60ml',
                'category'       => 'Hair Color',
                'stock_level'    => 8,
                'target_stock'   => 25,
                'supplier_name'  => 'Glamour Traders',
                'cost_per_unit'  => 1850.50,
                'is_active'      => true,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'Hydra Facial Cleansing Gel 500ml',
                'category'       => 'Skincare',
                'stock_level'    => 5,
                'target_stock'   => 10,
                'supplier_name'  => 'DermaCare Imports',
                'cost_per_unit'  => 4200.00,
                'is_active'      => true,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'OPI Gel Color Polish - Passion Red',
                'category'       => 'Nail Care',
                'stock_level'    => 20,
                'target_stock'   => 20,
                'supplier_name'  => 'NailArt Co.',
                'cost_per_unit'  => 1200.00,
                'is_active'      => true,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'Argan Oil Deep Conditioner 1L',
                'category'       => 'Hair Care',
                'stock_level'    => 3,
                'target_stock'   => 12,
                'supplier_name'  => 'L\'Oréal Beauty Supplies',
                'cost_per_unit'  => 3500.00,
                'is_active'      => true,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'Disposable Facial Sponges (Pack of 50)',
                'category'       => 'Disposables',
                'stock_level'    => 45,
                'target_stock'   => 50,
                'supplier_name'  => 'Salon Essentials PK',
                'cost_per_unit'  => 650.00,
                'is_active'      => true,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]);
    }
}