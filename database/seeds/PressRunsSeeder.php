<?php

use Illuminate\Database\Seeder;

class PressRunsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $run=new \App\PressRun;
        $run->pub_id = 1;
        $run->name = 'Test Run';
        $run->save();

        $run=new \App\PressRun;
        $run->pub_id = 1;
        $run->name = 'Test Run 2';
        $run->save();

        $run=new \App\PressRun;
        $run->pub_id = 2;
        $run->name = 'Another Run';
        $run->save();


    }
}
