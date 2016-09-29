<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectFormIndicatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_form_indicators', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_form_id')->unsigned();
            $table->foreign('project_form_id', 'pfi_pfi')->references('id')->on('project_forms')->onDelete('cascade');
            $table->string('value');
            $table->integer('order');
            $table->integer('size');
            $table->string('description');
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
        Schema::drop('project_form_indicators');
    }
}
