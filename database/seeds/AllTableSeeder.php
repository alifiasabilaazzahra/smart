<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AllTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        // //users

        //     //Student
            for($i = 1; $i <= 5; $i++){
            
                DB::table('users')->insert([
                    'user_id'   => $this->genId(),
                    'role'   => 0,
                    'email'     => $faker->email,
                    'password'  => '$2y$10$DuDYTJ.DHIZdG1iGGnRoaegNewtIURrWal4eHFoYsgQdzNDIBQp4m'
                ]);
            }

        //     //teacher
            for($i = 1; $i <= 5; $i++){
            
                DB::table('users')->insert([
                    'user_id'   => $this->genId(),
                    'role'   => 1,
                    'email'     => $faker->email,
                    'password'  => '$2y$10$DuDYTJ.DHIZdG1iGGnRoaegNewtIURrWal4eHFoYsgQdzNDIBQp4m'
                ]);
            }
        
        //     //Admin
            DB::table('users')->insert([
                'user_id'   => $this->genId(),
                'role'   => 3,
                'email'     => 'admin@simpleschool.com',
                'password'  => '$2y$10$DuDYTJ.DHIZdG1iGGnRoaegNewtIURrWal4eHFoYsgQdzNDIBQp4m'
            ]);
    }

    public function genId($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
