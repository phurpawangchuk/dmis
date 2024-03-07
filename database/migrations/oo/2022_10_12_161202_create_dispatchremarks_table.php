<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispatchRemarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispatch_remarks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('fid');
            $table->string('remarks');
            $table->string('author');
            $table->timestamps();
            $table->foreign('author')->references('id')->on('users');
            $table->foreign('fid')->references('id')->on('dispatch_letters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dispatch_remarks');
    }
};
