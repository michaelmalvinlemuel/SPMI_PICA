<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskWorksView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        DB::unprepared("
            CREATE FUNCTION work_status (
                userId INT
                , batchId INT
            )
            RETURNS INT
            BEGIN
                DECLARE total, stat INT;
    
                SET total = (
                    SELECT COUNT(DISTINCT `status`) 
                    FROM tasks
                    WHERE tasks.user_id = userId AND (tasks.batch_id = batchId)
                );
            
                IF (total > 1) THEN
                    RETURN 1;
                ELSE
                    SET stat = (
                        SELECT DISTINCT `status` 
                        FROM tasks
                        WHERE tasks.user_id = userId AND (tasks.batch_id = batchId)
                    );
                    
                    RETURN stat;
                END IF;
            END;
        ");
        
        DB::unprepared("
            CREATE VIEW task_works AS SELECT
                tasks.user_id
                , tasks.job_id
                , tasks.batch_id
                , tasks.work_id
                , works.name
                , work_status(tasks.user_id, tasks.batch_id) AS 'status'
                , task_batches.created_at
                , task_batches.expired_at
            FROM tasks
            INNER JOIN works 
                ON (tasks.work_id = works.id)
            INNER JOIN task_batches 
                ON (tasks.batch_id = task_batches.id)
            GROUP BY tasks.user_id
                , tasks.job_id
                , tasks.batch_id
                , tasks.work_id
                , works.name
                , work_status(tasks.user_id, tasks.batch_id)
                , task_batches.created_at
                , task_batches.expired_at;
        ");
    //WHERE (tasks.batch_id = (SELECT MAX(tk.batch_id) FROM tasks AS tk WHERE tk.work_id = tasks.work_id));
            
    }
    public function down()
    {
        
        DB::unprepared("
            DROP FUNCTION IF EXISTS work_status;
            DROP VIEW IF EXISTS task_works;");
        
       // DB::statement('DROP FUNCTION IF EXISTS work_status');
    }
}
