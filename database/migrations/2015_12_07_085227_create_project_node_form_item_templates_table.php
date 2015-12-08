<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectNodeFormItemTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_node_form_item_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_node_form_template_id')->unsigned();
            $table->foreign('project_node_form_template_id', 'pnft_foreign')
                ->references('id')->on('project_node_form_templates')->onDelete('cascade');
            $table->integer('form_id')->unsigned();
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
            $table->string('document');
            //$table->unique(['project_form_template_id'], 'foreign_project_form_template');
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
        Schema::drop('project_node_form_item_templates');
    }
}
