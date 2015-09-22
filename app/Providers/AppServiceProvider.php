<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (Cookie::get('mango_current_site') != false && Cookie::get('mango_current_site')!=null) {
            Session::put('site', Cookie::get('mango_current_site'));
        } else {
            Session::put('site', 1);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//

    }
}
