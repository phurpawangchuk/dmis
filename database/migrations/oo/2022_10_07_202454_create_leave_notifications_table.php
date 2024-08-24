<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('fid');
            $table->string('forward_to');
            $table->integer('flag')->default(0);
            $table->string('author');
            $table->string('message');
            $table->foreign('fid')->references('id')->on('leaves');
            $table->foreign('forward_to')->references('id')->on('users');
            $table->foreign('author')->references('id')->on('users');
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
        Schema::dropIfExists('leave_notifications');
    }
};
