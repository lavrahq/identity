<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Caffeinated\Themes\Facades\Theme;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Theme::set('blue');
    }
}
