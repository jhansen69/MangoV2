<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class JobsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //assign all jobs to test user
        $user = \App\User::where('username', '=', 'Tester')->first();
        $settings=array('draw'=>15000,'paper_type'=>1);
        $job=new \App\Job;
        $job->site_id = 2;
        $job->type="press";
        $job->user_id=$user->id;
        $job->pub_id=1;
        $job->run_id=1;
        $job->equipment_id=1;
        $job->tied_to_id=0;
        $job->recurrence_id=0;
        $job->product_date=date("Y-m-d");
        $job->request_date=date("Y-m-d");
        $job->start=date("Y-m-d",strtotime("-1 day")).' 11:30:00';
        $job->end=date("Y-m-d",strtotime("-1 day")).' 13:30:00';
        $job->source="seeder";
        $job->settings=$settings;
        $job->save();

        \App\Job::create(['site_id' => 2,
            'type'=>"press",
            "user_id"=>$user->id,
            "pub_id"=>1,
            "run_id"=>2,
            "equipment_id"=>1,
            "tied_to_id"=>0,
            "recurrence_id"=>0,
            "product_date"=>date("Y-m-d",strtotime("+1 day")),
            "request_date"=>date("Y-m-d",strtotime("+1 day")),
            "start"=>date("Y-m-d").' 10:45:00',
            "end"=>date("Y-m-d").' 12:00:00',
            "source"=>"seeder",
            'settings'=>$settings
        ]);

        \App\Job::create(['site_id' => 3,
            'type'=>"press",
            "user_id"=>$user->id,
            "pub_id"=>2,
            "run_id"=>3,
            "equipment_id"=>1,
            "tied_to_id"=>0,
            "recurrence_id"=>0,
            "product_date"=>date("Y-m-d",strtotime("+2 days")),
            "request_date"=>date("Y-m-d",strtotime("+2 days")),
            "start"=>date("Y-m-d",strtotime("+1 day")).' 15:15:00',
            "end"=>date("Y-m-d",strtotime("+1 day")).' 16:30:00',
            "source"=>"seeder",
            'settings'=>$settings
        ]);



    }
}
