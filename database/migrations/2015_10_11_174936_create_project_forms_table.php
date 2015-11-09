<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('weight', 11, 2);
            $table->decimal('score', 11, 2);
            $table->integer('project_node_id')->unsigned();
            $table->foreign('project_node_id')->references('id')->on('project_nodes')->onDelete('cascade');
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
        Schema::drop('project_forms');
    }
}
