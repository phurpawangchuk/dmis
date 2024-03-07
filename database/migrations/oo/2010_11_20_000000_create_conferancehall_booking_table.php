<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConferanceHallBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conferance_bookings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('fromDate');
            $table->date('toDate');
            $table->string('fromTime');
            $table->string('toTime');
            $table->integer('status')->default(0);
            $table->string('author');
            $table->string('conferancehall_id');
            $table->string('remarks')->nullable();
            $table->timestamps();
            $table->foreign('author')->references('id')->on('users');
            $table->foreign('conferancehall_id')->references('id')->on('conferance_masters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conferance_bookings');
    }
}
