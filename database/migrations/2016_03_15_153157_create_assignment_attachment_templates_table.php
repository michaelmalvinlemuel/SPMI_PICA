<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentAttachmentTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_attachment_templates', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('assignment_template_id')->unsigned();
            $table->foreign('assignment_template_id', 'frg_aat_at')->references('id')->on('assignment_templates')->onDelete('cascade');
            
            $table->string('name');
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
        Schema::drop('assignment_attachment_templates');
    }
}
