<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNextMonthFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("CREATE FUNCTION next_month (
                `datetime` DATETIME,
                `date` INT
            ) RETURNS DATETIME
            BEGIN
                DECLARE oldDate INT;
                DECLARE newDate DATETIME;
    
                SET oldDate = (
                    SELECT CAST(DATE_FORMAT(`datetime`, '%d') AS SIGNED)
                );
    
                IF (oldDate < `date`) THEN
                    RETURN DATE_ADD(`datetime`, INTERVAL (`date`-oldDate) DAY);
                ELSE
                    SET newDate = DATE_ADD(`datetime`, INTERVAL 1 MONTH);
                    SET newDate = DATE_SUB(`newDate`, INTERVAL ABS(oldDate - `date`) DAY);
                    RETURN newDate; 
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
        DB::unprepared("DROP FUNCTION IF EXISTS next_month;");
    }
}
