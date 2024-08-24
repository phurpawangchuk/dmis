<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_documents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('parliament_id');
            $table->string('document_id');
            $table->string('filename');
            $table->string('filepath');
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
        Schema::dropIfExists('session_documents');
    }
}
