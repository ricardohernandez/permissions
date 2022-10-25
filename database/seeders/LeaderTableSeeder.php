<?php

namespace Database\Seeders;

use App\Models\Leader;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LeaderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $leader = new Leader();
        $leader->user_id = 1;
        $leader->save();    
        
        $leader = new Leader();
        $leader->user_id = 2;
        $leader->save();   

        $leader = new Leader();
        $leader->user_id = 3;
        $leader->save();   

        $leader = new Leader();
        $leader->user_id = 4;
        $leader->save();   
    }
}
