<?php

namespace Database\Seeders;

use App\Models\Usertype;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsertypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $u1 = new Usertype();
        $u1->name='Administrador';
        $u1->save();

        $u2 = new Usertype();
        $u2->name='Ciudadano';
        $u2->save();

        $u3 = new Usertype();
        $u3->name='Conductor';
        $u3->save();

        $u4 = new Usertype();
        $u4->name='Recolector';
        $u4->save();
    }
}
