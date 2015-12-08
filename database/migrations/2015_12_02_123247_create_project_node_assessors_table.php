<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectNodeAssessorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_node_assessors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_node_id')->unsigned();
            $table->foreign('project_node_id')->references('id')->on('project_nodes')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['project_node_id', 'user_id', 'deleted_at'], 'unique_assessors');
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
        Schema::drop('project_node_assessors');
    }
}
