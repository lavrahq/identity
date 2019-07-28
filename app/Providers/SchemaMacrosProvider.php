<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class SchemaMacrosProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Blueprint::macro('uuidId', function () {
            return $this->uuid('id')
                ->primary()
                ->default(DB::raw("gen_random_uuid()"));
        });
    }
}
