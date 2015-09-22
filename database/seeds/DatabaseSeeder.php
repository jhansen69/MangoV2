<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserTableSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(SiteSeeder::class);
        $this->call(PubsSeeder::class);
        $this->call(PressRunsSeeder::class);
        $this->call(JobsSeeder::class);

        Model::reguard();
    }
}
