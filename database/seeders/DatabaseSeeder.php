<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  
    public function run()
    {
        $this->call(ModuleTableSeeder::class); 
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(LeaderTableSeeder::class); 
        $this->call(PermissionSeeder::class); 
        
    }
}