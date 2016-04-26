<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_recipients', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('assignment_template_id')->unsigned();
            $table->foreign('assignment_template_id', 'frg_ar_at')->references('id')->on('assignment_templates')->onDelete('cascade');
            
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
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
        Schema::drop('assignment_recipients');
    }
}
