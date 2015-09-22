<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Kodeine\Acl\Models\Eloquent\Permission;
use Kodeine\Acl\Models\Eloquent\Role;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $permissions=Permission::get();

        return view('pages.permissions.list',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $allPermissions=array("Does not inherit");
        foreach(Permission::get() as $perm)
        {
            $allPermissions[$perm->id]=$perm->name;
        }
        return view('pages.permissions.add',compact('allPermissions'));
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
            'name' => 'required',
        ]);
        $permission=Permission::create([
            'name' => $request->name,
            'slug' => [
                'create' => ($request->slug['create']!='false')?true:false,
                'view' => ($request->slug['view']!='false')?true:false,
                'update' => ($request->slug['update']!='false')?true:false,
                'delete' => ($request->slug['delete']!='false')?true:false,
                'special' => ($request->slug['special']!='false')?true:false
            ],
            'description' => $request->description
        ]);

        //always add any new permissions to the super_admin role
        $role=Role::find(1);
        $role->syncPermissions(Permission::all());

        flash()->success('Success','The permission has been created successfully');
        return redirect('/admin/permissions');
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
        return view('pages.permissions.list');
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
        $permission=Permission::findOrFail($id);

        $allPermissions=array("Does not inherit");
        foreach(Permission::get() as $perm)
        {
            $allPermissions[$perm->id]=$perm->name;
        }
        return view('pages.permissions.edit',compact('permission','allPermissions'));
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

        $this->validate($request, [
            'name' => 'required',
        ]);

        $permission=Permission::findOrFail($id);
        $permission->update([
            'name' => $request->name,
            'slug' => [
                'create' => ($request->slug['create']!='false')?true:false,
                'view' => ($request->slug['view']!='false')?true:false,
                'update' => ($request->slug['update']!='false')?true:false,
                'delete' => ($request->slug['delete']!='false')?true:false,
                'special' => ($request->slug['special']!='false')?true:false
            ],
            'description' => $request->description
        ]);
        //always sync permissions to the super_admin role
        $role=Role::find(1);
        $role->syncPermissions(Permission::all());

        flash()->success('Success','The permission has been updated successfully');

        return redirect('/admin/permissions');
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
        Permission::findOrFail($id)->delete();
        flash()->success('Success','The permission has been deleted successfully');
        return redirect('/admin/permissions');
    }
}
