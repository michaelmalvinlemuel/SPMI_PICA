<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNextYearFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("CREATE FUNCTION next_year (
                `datetime` DATETIME
                , dateInput INT
                , monthInput INT
            ) RETURNS DATETIME
        BEGIN
            DECLARE currentYearStart DATETIME;
            DECLARE curYear VARCHAR(255);
    
            SET curYear =  CONCAT(YEAR(CURRENT_TIMESTAMP), '-', monthInput, '-', dateInput);
    
            SET currentYearStart = (SELECT CAST(curYear AS DATETIME));
    
            IF (currentYearStart < CURRENT_TIMESTAMP) THEN
                RETURN DATE_ADD(currentYearStart, INTERVAL 1 YEAR);
            ELSE
                RETURN currentYearStart;
            END IF;
    
        END;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP FUNCTION IF EXISTS next_year;");
    }
}
