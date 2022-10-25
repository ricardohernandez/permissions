<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
  
    public function run()
    {
        $faker = \Faker\Factory::create();

        $user = new User();
        $user->name = 'SUPER';
        $user->leader_id = 1;
        $user->email = "ricardo.hernandez.esp@gmail.com";
        $user->email_verified_at = now();
        $user->phone =$faker->phoneNumber;
        $user->date_admission = now();
        $user->password =  Hash::make('asdf1212');
        $user->save();
        
        $user = new User();
        $user->name = 'ADMIN';
        $user->leader_id = 2;
        $user->email = "ricardo.hernandez@km-t.cl";
        $user->email_verified_at = now();
        $user->phone =$faker->phoneNumber;
        $user->date_admission = now();
        $user->password =  Hash::make('asdf1212');
        $user->save();

        $user = new User();
        $user->name = 'SUPERVISOR';
        $user->leader_id = 2;
        $user->email = $faker->unique()->safeEmail;
        $user->email_verified_at = now();
        $user->phone =$faker->phoneNumber;
        $user->date_admission = now();
        $user->password =  Hash::make('asdf1212');
        $user->save();

        $user = new User();
        $user->name = 'SUPERVISOR 2';
        $user->leader_id = 2;
        $user->email = $faker->unique()->safeEmail;
        $user->email_verified_at = now();
        $user->phone =$faker->phoneNumber;
        $user->date_admission = now();
        $user->password =  Hash::make('asdf1212');
        $user->save();

        $user = new User();
        $user->name = 'USUARIO 1';
        $user->leader_id = 3;
        $user->email = $faker->unique()->safeEmail;
        $user->email_verified_at = now();
        $user->phone =$faker->phoneNumber;
        $user->date_admission = now();
        $user->password =  Hash::make('asdf1212');
        $user->save();

        $user = new User();
        $user->name = 'USUARIO 2';
        $user->leader_id = 3;
        $user->email = $faker->unique()->safeEmail;
        $user->email_verified_at = now();
        $user->phone =$faker->phoneNumber;
        $user->date_admission = now();
        $user->password =  Hash::make('asdf1212');
        $user->save();

        $user = new User();
        $user->name = 'USUARIO 3';
        $user->leader_id = 4;
        $user->email = $faker->unique()->safeEmail;
        $user->email_verified_at = now();
        $user->phone =$faker->phoneNumber;
        $user->date_admission = now();
        $user->password =  Hash::make('asdf1212');
        $user->save();

        
        $user = new User();
        $user->name = 'USUARIO 4';
        $user->leader_id = 4;
        $user->email = $faker->unique()->safeEmail;
        $user->email_verified_at = now();
        $user->phone =$faker->phoneNumber;
        $user->date_admission = now();
        $user->password =  Hash::make('asdf1212');
        $user->save();

        $user = new User();
        $user->name = 'USUARIO 5';
        $user->leader_id = 4;
        $user->email = $faker->unique()->safeEmail;
        $user->email_verified_at = now();
        $user->phone =$faker->phoneNumber;
        $user->date_admission = now();
        $user->password =  Hash::make('asdf1212');
        $user->save();

        User::factory(10)->create();

    }
}
