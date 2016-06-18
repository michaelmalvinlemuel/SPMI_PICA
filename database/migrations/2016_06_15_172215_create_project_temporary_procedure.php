<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTemporaryProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("CREATE PROCEDURE proc_project_temporary ()
            BEGIN
	            DROP TEMPORARY TABLE IF EXISTS general_result;
	            CREATE TEMPORARY TABLE IF NOT EXISTS general_result (
		            tmp_id INT DEFAULT NULL, 
		            tmp_name VARCHAR(255) DEFAULT NULL, 
		            tmp_status INT DEFAULT NULL, 
		            tmp_node_id INT,
		            tmp_node_name VARCHAR(255) DEFAULT NULL
	            ) ENGINE=MEMORY DEFAULT CHARSET=utf8;
        END;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS proc_project_temporary");
    }
}
