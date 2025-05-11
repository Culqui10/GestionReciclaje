<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Usertype;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asegúrar que las tipo de usuarios existen y obtender  IDs
        $usertypes = Usertype::whereIn('name', [
            'Conductor',
            'Recolector',
            'Ciudadano',
        ])->get()->keyBy('name');

        $useres = [
            ['name' => 'Crystian', 'lastname' => 'Culqui','dni' => '12345678', 'usertype_id' => $usertypes['Conductor']->id, 'email' => 'Culqui@gmail.com', 'password' => bcrypt('12345678')],
            ['name' => 'Eduar', 'lastname' => 'Torres','dni' => '12345677', 'usertype_id' => $usertypes['Recolector']->id, 'email' => 'Torres@gmail.com', 'password' => bcrypt('12345678')],
            ['name' => 'Jairo', 'lastname' => 'Sandoval','dni' => '12345666', 'usertype_id' => $usertypes['Conductor']->id, 'email' => 'Sandoval@gmail.com', 'password' => bcrypt('12345678')],
            ['name' => 'Edwin', 'lastname' => 'Lucero','dni' => '12345555', 'usertype_id' => $usertypes['Recolector']->id, 'email' => 'Lucero@gmail.com', 'password' => bcrypt('12345678')],
            ['name' => 'Eliana', 'lastname' => 'Barturen','dni' => '12344444', 'usertype_id' => $usertypes['Conductor']->id, 'email' => 'Barturen@gmail.com', 'password' => bcrypt('12345678')],
            ['name' => 'Josue', 'lastname' => 'Cumpa','dni' => '12333333', 'usertype_id' => $usertypes['Recolector']->id, 'email' => 'Cumpa@gmail.com', 'password' => bcrypt('12345678')],
            ['name' => 'Jairo', 'lastname' => 'Elías','dni' => null, 'usertype_id' => $usertypes['Ciudadano']->id, 'email' => 'jairopoke@gmail.com', 'password' => bcrypt('123456'), 'zone_id' => 2],
        ];

        foreach ($useres as $user) {
            User::create($user);
        }
    }
}
