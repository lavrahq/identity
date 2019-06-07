<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('gender_id')
                ->nullable();
            $table->bigInteger('avatar_id')
                ->nullable();
            $table->bigInteger('avatar_email_id')
                ->nullable();

            $table->string('first_name');
            $table->string('middle_name')
                ->nullable();
            $table->string('last_name')
                ->nullable();
            $table->string('display_name')
                ->nullable();
            $table->string('title')
                ->nullable();
            $table->string('department')
                ->nullable();
            $table->string('location')
                ->nullable();
            $table->string('language')
                ->nullable();
            $table->longText('bio')
                ->nullable();
            $table->string('birthplace')
                ->nullable();

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
        Schema::dropIfExists('profiles');
    }
}
