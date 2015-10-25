<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskDailyInsertProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE PROCEDURE task_daily_insert_procedure (
                workId INT
            )
            BEGIN
                DECLARE batchId, batchTotal INT;
                DECLARE expiredAt DATETIME;
                DECLARE newExpiredAt DATETIME;
        
                SELECT id, expired_at INTO batchId, expiredAt FROM task_batches WHERE (work_id = workId) AND (id = (SELECT MAX(id) FROM task_batches WHERE work_id = workId));
                SET batchTotal = (SELECT COUNT(id) FROM task_batches WHERE (work_id = workId) AND (id = (SELECT MAX(id) FROM task_batches WHERE work_id = workId)));
                
                IF (CURRENT_TIMESTAMP > expiredAt OR batchTotal = 0) THEN
                    SET newExpiredAt = CURRENT_TIMESTAMP + INTERVAL 1 DAY;
        
                    INSERT INTO task_batches (batch, work_id, expired_at, created_at, updated_at) VALUES (CURRENT_TIMESTAMP, workId, newExpiredAt, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
        
                    SET batchId = LAST_INSERT_ID();
        
                    INSERT INTO tasks (user_id, job_id, batch_id, work_id, form_id, document, `status`, expired_at, created_at, updated_at)
                    SELECT
                        user_jobs.user_id
                        , group_job_details.job_id
                        , batchId
                        , work_forms.work_id
                        , work_forms.form_id
                        , forms.document
                        , 1 AS 'status'
                        , newExpiredAt AS 'expired_at'
                        , CURRENT_TIMESTAMP() AS 'created_at'
                        , CURRENT_TIMESTAMP() AS 'updated_at'
                    FROM
                        user_jobs
                    INNER JOIN users 
                        ON (user_jobs.user_id = users.id)
                    INNER JOIN jobs 
                        ON (user_jobs.job_id = jobs.id)
                    INNER JOIN group_job_details 
                        ON (group_job_details.job_id = jobs.id)
                    INNER JOIN group_jobs 
                        ON (group_job_details.group_job_id = group_jobs.id)
                    INNER JOIN works 
                        ON (works.group_job_id = group_jobs.id)
                    INNER JOIN work_forms 
                        ON (work_forms.work_id = works.id)
                    INNER JOIN forms 
                        ON (work_forms.form_id = forms.id)
                    WHERE (works.id = workId) AND 
                    (
                        WEEKDAY(CURRENT_TIMESTAMP) IN 
                        (
                            SELECT
                                schedule_daily_days.day
                            FROM
                                works
                            INNER JOIN schedule_dailies 
                                ON (works.schedule_id = schedule_dailies.id)
                            INNER JOIN schedule_daily_days 
                                ON (schedule_daily_days.schedule_daily_id = schedule_dailies.id)
                            WHERE (works.id = workId) AND schedule_daily_days.deleted_at IS NULL
                        ) 
                    );
                ELSE
                    INSERT INTO tasks (user_id, job_id, batch_id, work_id, form_id, document, `status`, expired_at, created_at, updated_at)
                    SELECT 
                        user_id
                        , job_id
                        , batchId
                        , work_id
                        , form_id
                        , document
                        , 1 AS 'status'
                        , expiredAt
                        , CURRENT_TIMESTAMP() AS 'created_at'
                        , CURRENT_TIMESTAMP() AS 'updated_at'
                    FROM 
                    (
                        SELECT user_id, job_id, work_id, form_id, derived1.document
                        FROM
                        (
                            SELECT
                                user_jobs.user_id
                                , group_job_details.job_id
                                , work_forms.work_id
                                , work_forms.form_id
                                , forms.document
                            FROM
                                user_jobs
                            INNER JOIN users 
                                ON (user_jobs.user_id = users.id)
                            INNER JOIN jobs 
                                ON (user_jobs.job_id = jobs.id)
                            INNER JOIN group_job_details 
                                ON (group_job_details.job_id = jobs.id)
                            INNER JOIN group_jobs 
                                ON (group_job_details.group_job_id = group_jobs.id)
                            INNER JOIN works 
                                ON (works.group_job_id = group_jobs.id)
                            INNER JOIN work_forms 
                                ON (work_forms.work_id = works.id)
                            INNER JOIN forms 
                                ON (work_forms.form_id = forms.id)
                            WHERE (works.id = workId) AND 
                            (
                                WEEKDAY(CURRENT_TIMESTAMP) IN 
                                (
                                SELECT
                                    schedule_daily_days.day
                                FROM
                                    works
                                INNER JOIN schedule_dailies 
                                    ON (works.schedule_id = schedule_dailies.id)
                                INNER JOIN schedule_daily_days 
                                    ON (schedule_daily_days.schedule_daily_id = schedule_dailies.id)
                                WHERE works.id = workId AND schedule_daily_days.deleted_at IS NULL
                                ) 
                            )
                        ) AS derived1
                        LEFT JOIN 
                        (
                            SELECT user_id, job_id, work_id, form_id, document 
                            FROM tasks
                            WHERE (work_id = workId) AND (batch_id = batchId)
                        ) AS derived2
                            USING(user_id, job_id, work_id, form_id)
                        WHERE (derived2.document IS NULL)
                    ) AS derived3;
                END IF;
                
                UPDATE works SET last_execute = CURRENT_TIMESTAMP WHERE (id = workId);
                    
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
        DB::unprepared("DROP PROCEDURE IF EXISTS task_daily_insert_procedure");
    }
}