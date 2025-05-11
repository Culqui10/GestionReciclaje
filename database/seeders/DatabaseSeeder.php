<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Zone;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(BrandSeeder::class);
        $this->call(ZonesSeeder::class);
        $this->call(RouteStatusSeeder::class);
        $this->call(VehicletypeSeeder::class);
        $this->call(VehiclecolorSeeder::class);
        $this->call(UsertypesSeeder::class);
        
        $this->call(BrandmodelSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(TypemantenimientoSeeder::class);
        
    }
}
