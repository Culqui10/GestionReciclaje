<?php

namespace Database\Seeders;

use App\Models\Routestatu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RouteStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rs1 = new Routestatu();
        $rs1->name='Iniciado';
        $rs1->save();

        $rs2 = new Routestatu();
        $rs2->name='Finalizado';
        $rs2->save();
    }
}
