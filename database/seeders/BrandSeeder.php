<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $b1 = new Brand();
        $b1->name='Marca Lamborguini';
        $b1->save();

        $b2 = new Brand();
        $b2->name='Marca Ferrari';
        $b2->save();

        $b3 = new Brand();
        $b3->name='Marca Volvo';
        $b3->save();

        $b4 = new Brand();
        $b4->name='Marca Toyota';
        $b4->save();
    }
}
