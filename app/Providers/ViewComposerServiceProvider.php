<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;
use App\Site;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Guard $auth, Request $request)
    {
        //
        view()->composer('*', function($view) use ($auth, $request)
        {
            $uri = $request->path();
            $uri=explode("/",$uri);
            $breadcrumb="<li>Home</li>";
            $stopped=false;
            $menuPath="";
            foreach($uri as $segment)
            {
                if(is_numeric($segment))
                {
                    $stopped=true;
                } else {
                    $breadcrumb.="<li>".ucfirst($segment)."</li>";
                    if(!$stopped)
                    {
                        $menuPath=$menuPath."/".$segment;
                    }
                }

            }

            $allSites=array();
            foreach(Site::orderBy('name','ASC')->get() as $site)
            {
                $allSites[$site->id]=$site->name;
            }
            $view->with('user',$auth->user())->with('breadcrumb',$breadcrumb)->with('menupath',$menuPath)->with('siteList',$allSites);
        });

        view()->composer('modals.pressJob', function($view) use ($auth, $request)
        {
            $presses=\App\Press::where('site_id',session('site'))->get();
            $view->with('presses',$presses);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
