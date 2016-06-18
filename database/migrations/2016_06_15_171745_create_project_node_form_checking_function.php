<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectNodeFormCheckingFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("CREATE FUNCTION func_node_form_checking (
                projectId INT
            ) RETURNS INT(11)
            BEGIN
	            DECLARE ret INT;
	            SET ret = (SELECT COUNT(id) FROM project_forms 
	            WHERE `deleted_at` IS NULL 
	            AND project_node_id = projectId);
	            RETURN ret;
        END;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP FUNCTION IF EXISTS func_node_form_checking");
    }
}
