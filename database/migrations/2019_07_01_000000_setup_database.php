<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SetupDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Create the PGCRYPTO extension if it does not exist.
         */
        DB::statement("CREATE EXTENSION IF NOT EXISTS pgcrypto;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /**
         * Delete the PGCRYPTO extension if it exists.
         */
        DB::statement("DROP EXTENSION IF EXISTS pgcrypto;");
    }
}
