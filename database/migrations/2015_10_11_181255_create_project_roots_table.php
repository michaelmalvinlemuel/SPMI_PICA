<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectRootsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_roots', function (Blueprint $table) {
            $table->increments('id');
            $table->string('abstract');
            $table->datetime('date_start');
            $table->datetime('date_ended');
            $table->integer('project_id');
            $table->string('project_type');
            $table->integer('user_id')->unsigned(); //pimpro
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::drop('project_roots');
    }
}
