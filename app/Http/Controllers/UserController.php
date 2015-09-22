<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Site;
use Kodeine\Acl\Models\Eloquent\Role;
use Kodeine\Acl\Models\Eloquent\Permission;

class UserController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        if(session()->get('site')==1)
        {
            $users=User::get();

        } else {
            $users=User::get()->sites->where('id','=',session()->get('site'));
        }
        return view('pages.users.list',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //

        return view('pages.users.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'username' => 'required|min:5',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed',
        ]);
        User::create([
            'username' => $request->username,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => ($request->password!=''?bcrypt($request->password):bcrypt('mangotoken')),
            'gender'=> $request->gender
        ]);
        flash()->success('Success','The user has been created successfully');
        return redirect('/config/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
        $user=User::get($id);
        return view('pages.users.profile',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
        $user=User::findOrFail($id);
        return view('pages.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::findOrFail($id);

        $this->validate($request, [
            'username' => 'required|min:5',
            'email' => 'required|unique:users,email,' . $user->id,
            'password' => 'confirmed',
        ]);


        if ($request->password == '') {
            $user->update($request->except('password', 'password_confirmations'));
        } else {
            $user->update($request);
        }

        flash()->success('Success', 'The user has been updated successfully');

        return redirect('/config/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        User::findOrFail($id)->delete();
        flash()->success('Success','The user has been deleted successfully');
        return redirect('/config/users');
    }

    public function roles($id)
    {
        $user=User::findOrFail($id);


        $tempUserRoles=array();
        foreach($user->getRoles() as $key=>$value)
        {
            $tempUserRoles[$key]=$value;
        }
        $roles=array();
        foreach(Role::orderBy('name')->get()->toArray() as $pointer)
        {
            $roles[$pointer['id']]=$pointer['name'];
            //because the ->getRoles() function does not return the ID, we'll need to rebuild it here
            if(in_array($pointer['slug'],$tempUserRoles))
            {
                $userRoles[]=$pointer['id'];
            }
        }
        return view('pages.users.roles', compact ('user','roles','userRoles','id'));
    }

    public function rolesStore(Request $request,$id)
    {
        $user=User::findOrFail($id);

        $roles=$request->only('roles');
        $user->syncRoles($roles['roles']);
        flash()->success('Success','The user roles have been updated successfully');
        return redirect('/config/users');
    }

    public function sites($id)
    {
        $user=User::findOrFail($id);


        $userSites=array();
        foreach($user->sites as $site)
        {
            $userSites[]=$site->id;
        }
        $sites=array();
        foreach(Site::orderBy('name')->get()->toArray() as $pointer)
        {
            $sites[$pointer['id']]=$pointer['name'];
        }
        return view('pages.users.sites', compact ('user','sites','userSites','id'));
    }

    public function sitesStore(Request $request,$id)
    {
        $user=User::findOrFail($id);
        //remove all existing attachments
        $sites=$request->only('sites');
        if(isset($sites))
        {
            $user->sites()->sync($sites['sites']);
        }
        flash()->success('Success','The user sites have been updated successfully');

        return redirect('/config/users');
    }

    public function permissions($id)
    {
        $user=User::findOrFail($id);


        $tempUserPermissions=array();
        foreach($user->getPermissions() as $key=>$value)
        {
            $tempUserPermissions[$key]=$value;
        }
        $permissions=array();
        foreach(Permission::orderBy('name')->get()->toArray() as $pointer)
        {
            $permissions[$pointer['id']]=$pointer['name'];
            //because the ->getPermission() function does not return the ID, we'll need to rebuild it here
            if(in_array($pointer['slug'],$tempUserPermissions))
            {
                $userPermissions[]=$pointer['id'];
            }
        }
        return view('pages.users.permissions', compact ('user','permissions','userPermissions','id'));
    }

    public function permissionsStore(Request $request,$id)
    {
        $user=User::findOrFail($id);

        $permissions=$request->only('permissions');
        $user->syncPermissions($permissions['permissions']);
        flash()->success('Success','The user permissions have been updated successfully');
        return redirect('/config/users');
    }
}
