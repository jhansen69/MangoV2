<?php

use Illuminate\Database\Seeder;
use Kodeine\Acl\Models\Eloquent\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        \App\Roles::create(['name' => 'Super Admin',
            'slug'=>"super_admin",
            "Description"=>"Root Administrator Access, created at software install."]);
        */
        $roleAdmin = new Role();
        $roleAdmin->name = 'Super Admin';
        $roleAdmin->slug = 'super_admin';
        $roleAdmin->description = 'Root administrator access, created at software install.';
        $roleAdmin->save();

        $roleBasic = new Role();
        $roleBasic->name = 'Basic Access';
        $roleBasic->slug = 'lowest_access';
        $roleBasic->description = 'Lowest level access, general view-only';
        $roleBasic->save();

        $user = \App\User::where('username' , '=', 'Super Admin')->first();
        // by object
        $user->assignRole($roleAdmin);

        $user = \App\User::where('username' , '=', 'Tester')->first();
        // by object
        $user->assignRole($roleBasic);


    }
}
