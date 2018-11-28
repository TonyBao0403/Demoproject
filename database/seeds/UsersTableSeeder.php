<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Model::unguard();

        //刪除原有資料   也可新建seeder class
        App\User::truncate();
        //快速新增資料10筆，也可進入tinker利用這行新建資料
        $users = factory(App\User::class ,20)->create();
        $this->command->info('User table seeded!');
        //Model::reguard();


        /*DB::table('users')->insert([
            'name' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
        ]);*/
    }
}
