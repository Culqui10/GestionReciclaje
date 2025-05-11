<?php

namespace Database\Seeders;

use App\Models\Typemantenimiento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypemantenimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $m1 = new Typemantenimiento();
        $m1->name='Limpieza';
        $m1->save();

        $m2 = new Typemantenimiento();
        $m2->name='Reparacion';
        $m2->save();
    }
}
