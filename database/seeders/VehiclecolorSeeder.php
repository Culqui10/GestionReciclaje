<?php

namespace Database\Seeders;

use App\Models\Vehiclecolor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehiclecolorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $c1 = new Vehiclecolor();
        $c1->name = 'Rojo';
        $c1->color_code = '#F30C0C';
        $c1->save();

        $c2 = new Vehiclecolor();
        $c2->name = 'Verde';
        $c2->color_code = '#12B017';
        $c2->save();

        $c3 = new Vehiclecolor();
        $c3->name = 'Azul';
        $c3->color_code = '#2255E7 ';
        $c3->save();

        $c4 = new Vehiclecolor();
        $c4->name = 'Amarillo';
        $c4->color_code = '#F6EC1D';
        $c4->save();
    }
}
