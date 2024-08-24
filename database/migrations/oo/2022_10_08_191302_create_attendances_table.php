<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('user_id');
            $table->integer('checkIn');
            $table->string('inStatus');
            $table->string('outStatus')->nullable();
            $table->integer('checkOut')->nullable();
            $table->integer('status')->default(0);
            $table->string('ip_address');
            $table->string('inNotes')->nullable();
            $table->string('outNotes')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('attendances');
    }
};
