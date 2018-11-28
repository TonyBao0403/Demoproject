<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        //刪除原有資料   也可新建seeder class
        App\Post::truncate();
        //快速新增資料10筆，也可進入tinker利用這行新建資料
        factory(App\Post::class,20)->create();
        $this->command->info('Post table seeded!');
        
    }
}
