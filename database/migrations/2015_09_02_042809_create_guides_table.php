<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guides', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('standard_document_id')->unsigned();
            $table->foreign('standard_document_id')->references('id')->on('standard_documents')->onDelete('cascade');
            $table->string('no')->unique();
            $table->date('date');
            $table->string('description')->unique();
            $table->string('document');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('guides');
        array_map('unlink', glob(env('APP_UPLOAD') . "/guide/*"));
    }
}