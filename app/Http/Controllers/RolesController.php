<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Kodeine\Acl\Models\Eloquent\Role;
use Kodeine\Acl\Models\Eloquent\Permission;


class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $roles=Role::get();
        return view('pages.roles.list',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('pages.roles.add');
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
            'slug' => 'required',
        ]);
        Role::create($request->all());
        flash()->success('Success','The record has been created successfully');
        return redirect('/admin/roles');
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
        return view('pages.roles.list');
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
        $role=Role::findOrFail($id);
        return view('pages.roles.edit',compact('role'));
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
            'slug' => 'required',
        ]);
        Role::findOrFail($id)->update($request->all());
        flash()->success('Success','The record has been updated successfully');
        return redirect('/admin/roles');
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
        Role::findOrFail($id)->delete();
        flash()->success('Success','The record has been deleted successfully');
        return redirect('/admin/roles');
    }

    public function permissions($id)
    {
        $permissions=array(0=>'None');
        foreach(Permission::select('id','name')->orderBy('name','asc')->get()->toArray() as $pointer)
        {
            $permissions[$pointer['id']]=$pointer['name'];
        }

        $rolePermissions=array();
        foreach(Role::findOrFail($id)->permissions->toArray() as $pointer)
        {
            $rolePermissions[]=$pointer['id'];
        }

        return view('pages.roles.permissions',compact('id','permissions', 'rolePermissions'));
    }

    public function permissionsStore(Request $request, $id)
    {
        $role=Role::findOrFail($id);
        $role->syncPermissions($request->permissions);
        flash()->success('Success','You have successfully added permissions for the selected role.');
        return redirect('/admin/roles');
    }
}
