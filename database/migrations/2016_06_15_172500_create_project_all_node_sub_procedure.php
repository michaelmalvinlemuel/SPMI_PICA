<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectAllNodeSubProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_project_all_node_sub`(
	IN pn_id INT,
	OUT result INT,
	OUT childId INT,
	IN pId INT,
	IN pName VARCHAR (255)
    )
BEGIN
	DECLARE done3 INT;
		
	DECLARE test INT;
	DECLARE pnc_id INT;
	DECLARE pnc_name VARCHAR(255);
	DECLARE pnc_description VARCHAR(255);
	DECLARE ppc_id INT;
	DECLARE pnc_project_type VARCHAR(255);
	DECLARE pnc_deleted_at DATETIME;
	DECLARE project_node_child_cursor CURSOR FOR
	SELECT `id`
		, `name`
		, `description`
		, `project_id`
		, `project_type`
		, `deleted_at`
	 FROM `project_nodes`
	 WHERE `deleted_at` IS NULL 
	 AND `project_id` = pn_id
	 AND `project_type` = 'App\\\ProjectNode';
	 
	 DECLARE CONTINUE HANDLER FOR NOT FOUND SET done3 = TRUE;
	 
	 OPEN project_node_child_cursor;
	 
		get_project_node_child: LOOP
		
			IF done3 THEN
				LEAVE get_project_node_child;
			END IF;
			
			FETCH project_node_child_cursor INTO pnc_id, pnc_name, pnc_description, ppc_id, pnc_project_type, pnc_deleted_at;
			
			SET test = (SELECT func_node_form_checking(pnc_id));
					
			IF test = 0 THEN
				/* this is not end of child */
				SET result = 0;
				CALL proc_project_all_node_sub(pnc_id, @result, @childId, pId, pName);
				
			ELSE
				/* this is end of child */
				SET result = 1;
				SET childId = pnc_id;
				
				INSERT INTO general_result (tmp_id, tmp_name, tmp_status, tmp_node_id, tmp_node_name) 
				SELECT pId, pName, '0', `id`, `description` FROM `project_nodes` 
				WHERE `id` = pnc_id AND `deleted_at` IS NULL;
						
				
			END IF;
			
		END LOOP get_project_node_child;
		
	 CLOSE project_node_child_cursor;
    END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS proc_project_all_node_sub");
    }
}
