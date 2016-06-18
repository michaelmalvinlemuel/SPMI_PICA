<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectAllNodeProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_project_all_node`()
BEGIN
	
	
	DECLARE done1 INT DEFAULT FALSE; 
	DECLARE p_id INT;
	DECLARE p_name VARCHAR(255);
	DECLARE p_deleted_at DATETIME;
	DECLARE p_status INT;
	
	DECLARE project_cursor CURSOR FOR 
	SELECT
	    `id`
	    , `name`
	    , `deleted_at`
	    , `status`
	FROM
	    `spmilaravel`.`projects`
	WHERE deleted_at IS NULL AND `status` = 1;
	
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done1 = TRUE;
	
	CALL proc_project_temporary;
	
	OPEN project_cursor;
	
		get_project: LOOP
		
		
			FETCH project_cursor INTO p_id, p_name, p_deleted_at, p_status;
			
			IF done1 THEN
				LEAVE get_project;
			END IF;
        
			BLOCK1: BEGIN
				
				DECLARE done2 INT DEFAULT FALSE; 
				
				DECLARE test INT;
				DECLARE test_child INT;
				
				DECLARE pn_id INT;
				DECLARE pn_name VARCHAR(255);
				DECLARE pn_description VARCHAR(255);
				DECLARE pp_id INT;
				DECLARE pn_project_type VARCHAR(255);
				DECLARE pn_deleted_at DATETIME;
				
				DECLARE has_form INT;
				
				DECLARE project_node_cursor CURSOR FOR
				SELECT `id`
					, `name`
					, `description`
					, `project_id`
					, `project_type`
					, `deleted_at`
				 FROM `project_nodes`
				 WHERE `deleted_at` IS NULL 
				 AND `project_id` = p_id
				 AND `project_type` = 'App\\\Project';
				 
				 DECLARE CONTINUE HANDLER FOR NOT FOUND SET done2 = TRUE;
				 
			 
				 OPEN project_node_cursor;
					
										
					get_project_node: LOOP
						
						IF done2 THEN
							LEAVE get_project_node;
						END IF;
						
						FETCH project_node_cursor INTO pn_id, pn_name, pn_description, pp_id, pn_project_type, pn_deleted_at;
						
						/* check by project form */
						SET test = (SELECT func_node_form_checking(pn_id));
						
						/* if has project form */
						IF test = 0 THEN
						
							/* this is not end of child */
							CALL proc_project_all_node_sub(pn_id, @result, @nextId, p_id, p_name);
							
						ELSE
							/* this is end of child */
							INSERT INTO general_result (tmp_id, tmp_name, tmp_status, tmp_node_id, tmp_node_name) 
							SELECT p_id, p_name, '0', `id`, `description` FROM `project_nodes` 
							WHERE `id` = pn_id AND `deleted_at` IS NULL;
							
						END IF;
						
					END LOOP get_project_node;
				
					
				 CLOSE project_node_cursor;
			
			END BLOCK1;
			
			
			
		END LOOP get_project;
	
	
	
	CLOSE project_cursor;
	

	SELECT nodes.tmp_id AS project_id
		, nodes.tmp_name AS project_name
		, nodes.tmp_node_id AS project_node_id
		, nodes.tmp_node_name AS project_node_description
		, project_forms.id AS project_node_form_id
		, project_forms.`weight` AS weight
		, project_form_scores.score AS score
		, forms.description AS form
		, project_form_uploads.upload AS upload
	FROM (SELECT DISTINCT tmp_id, tmp_name, tmp_node_id, tmp_node_name FROM spmilaravel.general_result) AS nodes 
	INNER JOIN project_forms ON (project_forms.`project_node_id` = nodes.tmp_node_id)
	LEFT JOIN project_form_scores ON (project_forms.id = project_form_scores.`project_form_id` 
		AND project_form_scores.updated_at = (SELECT MAX(sub.updated_at) FROM project_form_scores AS sub))
	INNER JOIN project_form_items ON (project_forms.id = project_form_items.project_form_id)
	INNER JOIN forms ON (forms.id = project_form_items.form_id)
	LEFT JOIN project_form_uploads ON (project_form_items.id = project_form_uploads.project_form_item_id
		AND project_form_uploads.updated_at = (SELECT MAX(sub_upload.updated_at) FROM project_form_uploads AS sub_upload))
	;
	
	
	
	
	
						  
	 
	
	
	
	
	
    END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS proc_project_all_node");
    }
}
