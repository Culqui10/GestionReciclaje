<?php

namespace Database\Seeders;

use App\Models\Vehicletype;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicletypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $t1 = new Vehicletype();
        $t1->name='Cargador frontal';
        $t1->save();

        $t2 = new Vehicletype();
        $t2->name='Cargador lateral';
        $t2->save();

        $t3 = new Vehicletype();
        $t3->name='Cargador traseral';
        $t3->save();
    }
}
