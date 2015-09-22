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
