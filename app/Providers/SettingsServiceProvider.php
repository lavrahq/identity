<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Entities\Setting;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        config([
            'dbs' => Setting::all([
                'key', 'value', 'default', 'type'
            ])
                ->keyBy('key')
                ->transform(function ($setting) {
                    if (! $setting->value) {
                        $value = $setting->default;
                        settype($value, $setting->type);

                        return $value;
                    }

                    $value = $setting->value;
                    settype($value, $setting->type);

                    return $value;
                })
                ->toArray()
        ]);
    }
}
