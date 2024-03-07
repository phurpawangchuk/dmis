<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userpro1', function (Blueprint $table) {
            $table->id();
            $table->string('contactno');
            $table->string('address');
            $table->bigInteger('user_id');
            $table->integer('status');
            $table->integer('author');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('user1')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userpro1');
    }
};
