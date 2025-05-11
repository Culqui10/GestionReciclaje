<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Brandmodel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandmodelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asegúrar que las marcas existen y obtender  IDs
        $brands = Brand::whereIn('name', [
            'Marca Lamborguini',
            'Marca Ferrari',
            'Marca Volvo',
            'Marca Toyota'
        ])->get()->keyBy('name');

        $brandmodels = [
            ['name' => 'Lamborghini Aventador', 'brand_id' => $brands['Marca Lamborguini']->id],
            ['name' => 'Lamborghini Huracán', 'brand_id' => $brands['Marca Lamborguini']->id],
            ['name' => 'Ferrari LaFerrari', 'brand_id' => $brands['Marca Ferrari']->id],
            ['name' => 'Ferrari F8', 'brand_id' => $brands['Marca Ferrari']->id],
            ['name' => 'Volvo XC90', 'brand_id' => $brands['Marca Volvo']->id],
            ['name' => 'Volvo S60', 'brand_id' => $brands['Marca Volvo']->id],
            ['name' => 'Toyota Corolla', 'brand_id' => $brands['Marca Toyota']->id],
            ['name' => 'Toyota Camry', 'brand_id' => $brands['Marca Toyota']->id],
        ];

        foreach ($brandmodels as $brandmodel) {
            Brandmodel::create($brandmodel);
        }
    }
}
