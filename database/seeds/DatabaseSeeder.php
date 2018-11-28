<?php

use Illuminate\Database\Seeder;
use App\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        $this->call(PostTableSeeder::class);
        //$this->call(IssueTableSeeder::class);
        //$this->command->info('User table seeded!');


        
    }
}
