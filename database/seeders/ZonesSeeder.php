<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ZonesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $zones = [
            ['name' => 'José Leonardo Ortiz', 'area' => '200', 'description' => ''],
            ['name' => 'La Victoria', 'area' => '150', 'description' => ''],
            ['name' => 'Chiclayo', 'area' => '100', 'description' => ''],
            ['name' => 'Pimentel', 'area' => '80', 'description' => ''],
            ['name' => 'Monsefú', 'area' => '120', 'description' => ''],
            ['name' => 'Eten', 'area' => '100', 'description' => ''],
            ['name' => 'Reque', 'area' => '50', 'description' => ''],
            ['name' => 'Pomalca', 'area' => '60', 'description' => ''],
        ];

        foreach ($zones as $zone) {
            \App\Models\Zone::create($zone);
        }
    }
}
