<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            DELETE FROM mysql.event
                WHERE db = '" . env('DB_DATABASE', 'forge') . "';
        ");
        Schema::create('works', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->datetime('start');
            $table->datetime('ended')->nullable();
            $table->datetime('last_execute');
            $table->integer('group_job_id')->unsigned();
            $table->foreign('group_job_id')->references('id')->on('group_jobs')->onDelete('cascade');
            $table->char('type', 1);
            $table->integer('schedule_id');
            $table->string('schedule_type');
            $table->string('schedule_name');
            $table->boolean('schedule_status');
            $table->unique(['name', 'deleted_at']);
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
        Schema::drop('works');
    }
}
