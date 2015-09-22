<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Job;
use App\SiteJob;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $jobs=Job::all();
        $siteJobs=SiteJob::all();
        return view('pages.dashboard', compact('jobs', 'siteJobs'));
    }
}
