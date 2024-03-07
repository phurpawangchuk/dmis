<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispatchletterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispatch_letters', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('from_agency_id');
            $table->uuid('from_dept_id');
            $table->uuid('from_division_id')->nullable();
            $table->char('fiscal_year');
            $table->integer('dispatch_number');
            $table->date('issue_date');
            $table->string('to_adressed');
            $table->string('to_office');
            $table->string('to_dept');
            $table->string('to_division')->nullable();
            $table->string('to_place')->nullable();
            $table->string('to_subject')->nullable();
            $table->string('to_reference_number')->nullable();
            $table->string('attachment_file')->nullable();
            $table->string('author');
            $table->timestamps();
            $table->foreign('author')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dispatch_letters');
    }
};
