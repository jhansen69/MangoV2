<?php

use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $tester = \App\User::where('username', '=', 'Tester')->first();
        $admin = \App\User::where('username', '=', 'Super Admin')->first();

        $site=new \App\Site();
        $site->name = 'Global';
        $site->domain = 'parent.com';
        $site->save();

        $admin->sites()->attach($site->id);

        $site=new \App\Site();
        $site->name = 'Idaho Press-Tribune';
        $site->domain = 'idahopress.com';
        $site->save();

        $admin->sites()->attach($site->id);

        $site=new \App\Site();
        $site->name = 'Idaho State Journal';
        $site->domain = 'idahostatejournal.com';
        $site->save();

        $tester->sites()->attach($site->id);
        $admin->sites()->attach($site->id);

    }
}
