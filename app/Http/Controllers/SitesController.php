<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Site;
use App\User;
class SitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        /*
        $user=User::find(1);
        echo ($user->can('update.sites')) ? 'can update':'nope';
        dd($user->getPermissions());
        */
        $sites=Site::withTrashed()->get();



        return view('pages.sites.list',compact('sites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('pages.sites.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:sites,name',
            'domain' => 'required'
        ]);
        Site::create([
            'name' => $request->name,
            'domain' => $request->domain,
            'street' => $request->street,
            'city' => $request->city,
            'state' => $request->state,
            'zip'=> $request->zip,
            'phone'=> $request->phone
        ]);
        flash()->success('Success','The site has been created successfully');
        return redirect('/admin/sites');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $site=Site::findOrFail($id);
        return view('pages.sites.view',compact('site'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $site=Site::findOrFail($id);
        return view('pages.sites.edit',compact('site'));
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


        $site=Site::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|unique',
            'domain' => 'required'
        ]);

        $site->update($request);

        flash()->success('Success','The site has been updated successfully');

        return redirect('/admin/sites');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Site::findOrFail($id)->delete();
        flash()->success('Success','The site has been deleted successfully');
        return redirect('/admin/sites');
    }
}
