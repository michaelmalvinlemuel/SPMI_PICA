<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNextWeekdayFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE FUNCTION next_weekday (
                `date` DATETIME,
                `day` INT
            ) RETURNS DATETIME
            BEGIN
            IF (WEEKDAY(`date`) = `day`) THEN
                RETURN DATE_ADD(`date`, INTERVAL 7 DAY);
            ELSE
                IF (WEEKDAY(`date`) < `day`) THEN   
                    RETURN DATE_ADD(`date`, INTERVAL (`day` - WEEKDAY(`date`)) DAY);
                ELSE
                    RETURN DATE_ADD(`date`, INTERVAL ( 7 - ABS(`day` - WEEKDAY(`date`))) DAY);
                END IF;
            END IF;
            END;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP FUNCTION IF EXISTS next_weekday");
    }
}
