<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('user_id');
            $table->date('fromDate');
            $table->date('toDate');
            $table->integer('status')->default(0);
            $table->integer('leave_category_id');
            $table->string('employeeRemarks')->nullable();
            $table->string('headRemarks')->nullable();;
            $table->integer('department_id');
            $table->integer('division_id');
            $table->timestamps();
            $table->foreign('leave_category_id')->references('id')->on('leave_categories');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('division_id')->references('id')->on('divisions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leaves');
    }
}
