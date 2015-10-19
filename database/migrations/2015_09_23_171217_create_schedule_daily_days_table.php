<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleDailyDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_daily_days', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('schedule_daily_id')->unsigned();
            $table->foreign('schedule_daily_id')->references('id')->on('schedule_dailies')->onDelete('cascade');
            $table->char('day', 1);
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
        Schema::drop('schedule_daily_days');
    }
}
