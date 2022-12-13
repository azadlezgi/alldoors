<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

//        for($i=0; $i<=2; $i++){
//            $faker = Factory::create();
//            User::create([
//                'name' => $faker->name,
//                'email' => $faker->email,
//                'password' => Hash::make('adminminad')
//            ]);
//
//        }


        User::create([
            'username' => 'admin',
            'name' => 'Admin',
            'email' => 'i_behruz19@mail.ru',
            'password' => Hash::make('adminminad'),
            'status' => 1,
        ]);
    }
}
