<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectWatcherEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
			CREATE EVENT project_watcher  
				ON SCHEDULE 
				EVERY 1 DAY
					STARTS (TIMESTAMP(CURRENT_DATE) + INTERVAL 1 DAY + INTERVAL 1 HOUR)
					ON COMPLETION PRESERVE
					DO BEGIN
        				UPDATE projects SET status = 2
        				WHERE (status = 1) AND (date_start = CURRENT_DATE);
        		
        				UPDATE projects SET status = 3
        				WHERE (status = 2) AND (date_ended = CURRENT_DATE);
					END
		");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP EVENT IF EXISTS project_watcher");
    }
}
