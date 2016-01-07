<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectFormUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_form_uploads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_form_item_id')->unsigned();
            $table->foreign('project_form_item_id')->references('id')->on('project_form_items')->onDelete('cascade');
            $table->string('upload');
            $table->string('description')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->datetime('uploaded_at');
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
        Schema::drop('project_form_uploads');
    }
}
