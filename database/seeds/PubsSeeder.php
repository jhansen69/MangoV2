<?php

use Illuminate\Database\Seeder;

class PubsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $pub=new \App\Pub();
        $pub->name = 'Idaho Press-Tribune';
        $pub->color = '004401';
        $pub->site_id=2;
        $pub->save();

        $pub=new \App\Pub();
        $pub->name = 'Idaho State Journal';
        $pub->color = '931B1D';
        $pub->site_id=3;
        $pub->save();

    }
}
