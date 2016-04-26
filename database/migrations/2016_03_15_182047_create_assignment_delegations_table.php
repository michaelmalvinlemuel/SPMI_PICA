<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentDelegationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_delegations', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('assignment_recipient_id')->unsigned();
            $table->foreign('assignment_recipient_id', 'frg_ad_ar')->references('id')->on('assignment_recipients')->onDelete('cascade');
            
            $table->integer('assignment_attachment_template_id')->unsigned();
            $table->foreign('assignment_attachment_template_id', 'frg_ad_aat')->references('id')->on('assignment_attachment_templates')->onDelete('cascade');
            
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
        Schema::drop('assignment_delegations');
    }
}
