<?php

namespace Themes\Blue\Providers;

use Caffeinated\Themes\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Spatie\BladeX\Facades\BladeX;

class BladeServiceProvider extends ServiceProvider
{
    public function register()
    {
        BladeX::component('components.buttons.social')
            ->tag('social-button');

        BladeX::component('components.forms.input')
            ->tag('form-input');
    }
}
