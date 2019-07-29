<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->uuidId();
            $table->uuid('user_id');

            $table->string('email')
                ->unique();
            $table->enum('status', ['primary', 'pending'])
                ->default('pending');

            $table->timestamps();
            $table->timestamp('verified_at')
                ->nullable();

            $table->unique(['user_id', 'status']);

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
        Schema::dropIfExists('emails');
    }
}
