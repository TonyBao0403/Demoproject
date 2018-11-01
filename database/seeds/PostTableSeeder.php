<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostTableSeeder extends Seeder {
    public function run()
    {
        DB::table('posts')->delete();
        Post::create(['title' => 'Hello!!!', 'note' => 'Laravel~~~','author' => '1']);
    }

     

}