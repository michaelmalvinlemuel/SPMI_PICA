<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectNodeFormTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_node_form_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('weight', 11, 2);
            $table->integer('project_node_template_id')->unsigned();
            $table->foreign('project_node_template_id', 'pnt_foreign')->references('id')->on('project_node_templates')->onDelete('cascade');
            //$table->unique(['project_node_template_id'], 'foreign_node_template');
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
        Schema::drop('project_node_form_templates');
    }
}
