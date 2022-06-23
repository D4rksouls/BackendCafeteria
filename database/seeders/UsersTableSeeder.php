<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {

        $password = Hash::make('12345678');

        DB::table('users')->insert([
            'document' => 10056342,
            'name' => 'Administrador',
            'email' => 'Admin'.'@gmail.com',
            'password' => $password,
        ]);

        $faker = \Faker\Factory::create();

        for($i = 0 ; $i < 5 ; $i++ ){
            User::create([
                'document' => rand(10000000,19999999),
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $password,
            ]);
        }
    }
}
