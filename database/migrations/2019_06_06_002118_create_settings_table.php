<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('label');
            $table->longText('description')
                ->nullable();
            $table->string('key');
            $table->string('value')
                ->nullable();
            $table->string('default');
            $table->enum('type', ['boolean', 'integer', 'float', 'string', 'array', 'object'])
                ->default('string');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
