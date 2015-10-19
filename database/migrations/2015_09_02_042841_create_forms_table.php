<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('instruction_id')->unsigned();
            $table->foreign('instruction_id')->references('id')->on('instructions')->onDelete('cascade');
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
        Schema::drop('forms');
        array_map('unlink', glob(env('APP_UPLOAD') . "/form/*"));
    }
}
