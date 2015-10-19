<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskFormsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        DB::statement("
            CREATE VIEW task_forms AS SELECT DISTINCT
                tasks.user_id
                , work_forms.work_id
                , work_forms.form_id
                , forms.description
                , tasks.id as 'task_id'
                , (SELECT task_instance.status FROM tasks task_instance WHERE task_instance.id = tasks.id) as 'status'
                , forms.document as 'master_document'
                , (SELECT task_instance.document FROM tasks task_instance WHERE task_instance.id = tasks.id) AS 'upload_document'
            FROM
                spmilaravel.work_forms
            INNER JOIN spmilaravel.works 
                ON (work_forms.work_id = works.id)
            INNER JOIN spmilaravel.tasks 
                ON (tasks.work_form_id = work_forms.id)
            INNER JOIN spmilaravel.forms 
                ON (work_forms.form_id = forms.id)
            ORDER BY work_forms.work_id;");
            */

        DB::statement("
            CREATE VIEW task_forms AS 
            SELECT tasks.id
                , tasks.user_id
                , tasks.batch_id
                , tasks.form_id
                , forms.description
                , derived1.status
                , derived1.document
                , derived1.upload                
            FROM tasks
            INNER JOIN forms 
                ON (tasks.form_id = forms.id)
            JOIN tasks AS derived1
            USING (user_id, batch_id, form_id)
            GROUP BY tasks.user_id
                , tasks.batch_id
                , tasks.form_id
                , forms.description
                , derived1.status
                , derived1.document
                , derived1.upload  
        ;");
        //WHERE (tasks.batch_id = (SELECT MAX(tk.batch_id) FROM tasks AS tk WHERE tk.work_id = tasks.work_id));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        DB::statement( 'DROP VIEW IF EXISTS task_forms' );
    }
}
