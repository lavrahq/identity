<?php

namespace App\Providers;

use Spatie\BladeX\Facades\BladeX;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        BladeX::component('components.buttons.social')
            ->tag('social-button');

        BladeX::component('components.forms.input')
            ->tag('form-input');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
