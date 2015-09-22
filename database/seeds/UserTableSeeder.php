<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $password=bcrypt('bubbles');
        \App\User::create(['email' => 'jhansen@pioneernewsgroup.com',
                           'username'=>"Super Admin",
                           "first_name"=>"Joe",
                           "last_name"=>"Hansen",
                           "avatar"=>"male.png",
                           "gender"=>"male",
                           "kjk34Token"=>"1",
                           'password'=>$password]);

        $password=bcrypt('tester');
        \App\User::create(['email' => 'webtech@idahopress.com',
            'username'=>"Tester",
            "first_name"=>"Joe",
            "last_name"=>"Tester",
            "avatar"=>"male.png",
            "gender"=>"male",
            'password'=>$password]);
    }
}
