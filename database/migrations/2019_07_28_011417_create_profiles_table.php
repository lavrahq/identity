<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->uuidId();
            $table->uuid('user_id')
                ->unique();

            $table->string('first_name')
                ->nullable();
            $table->string('middle_name')
                ->nullable();
            $table->string('last_name')
                ->nullable();
            $table->string('suffix')
                ->nullable();
            $table->string('display_name')
                ->nullable();
            $table->enum('sex', ['M', 'F']);
            $table->date('birthday')
                ->nullable();

            $table->string('address')
                ->nullable();
            $table->string('address2')
                ->nullable();
            $table->string('address3')
                ->nullable();
            $table->string('city')
                ->nullable();
            $table->string('province')
                ->nullable();
            $table->string('country')
                ->nullable();
            $table->string('postal')
                ->nullable();

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
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
