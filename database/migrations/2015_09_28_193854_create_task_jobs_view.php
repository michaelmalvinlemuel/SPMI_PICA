<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskJobsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         DB::statement("
            CREATE VIEW task_jobs AS SELECT
                tasks.user_id
                , tasks.job_id
                , jobs.name
            FROM
                tasks
            INNER JOIN jobs 
                ON (tasks.job_id = jobs.id)
            GROUP BY tasks.user_id
                , tasks.job_id
                , jobs.name
        ;");
    }
    public function down()
    {
        DB::statement( 'DROP VIEW task_jobs' );
    }
}
