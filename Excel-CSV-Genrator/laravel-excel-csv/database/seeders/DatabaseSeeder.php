<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**php 
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        

         for($i = 0; $i < 50; $i++) {
            \App\Models\UserScore::create([
                 'score' => rand(10,100),
                 'user_id' => $i
             ]);
         }


    }
}
