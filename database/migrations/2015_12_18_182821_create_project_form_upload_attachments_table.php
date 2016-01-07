<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectFormUploadAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_form_upload_attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_form_upload_id')->unsigned();
            $table->foreign('project_form_upload_id')->references('id')->on('project_form_uploads')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('attachment');
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
        Schema::drop('project_form_upload_attachments');
    }
}
