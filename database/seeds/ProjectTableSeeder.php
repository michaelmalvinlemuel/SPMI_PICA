<?php

use Illuminate\Database\Seeder;

use App\Project;
use App\ProjectAssessor;
use App\ProjectUser;

use App\ProjectNode;
use App\ProjectNodeAssessor;
use App\ProjectNodeDelegation;

use App\ProjectForm;
use App\ProjectFormItem;
use App\ProjectFormUpload;
use App\ProjectFormScore;


class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        include('spmilaravel (9).php');
        
        DB::table('projects')->delete();
        Project::insert($projects);
        
        DB::table('project_assessors')->delete();
        ProjectAssessor::insert($project_assessors);
        
        DB::table('project_users')->delete();
        ProjectUser::insert($project_users);
        
        DB::table('project_nodes')->delete();
        ProjectNode::insert($project_nodes);
        
        DB::table('project_node_assessors')->delete();
        ProjectNodeAssessor::insert($project_node_assessors);
        
        DB::table('project_node_delegations')->delete();
        ProjectNodeDelegation::insert($project_node_delegations);
        
        DB::table('project_forms')->delete();
        ProjectForm::insert($project_forms);
        
        DB::table('project_form_items')->delete();
        ProjectFormItem::insert($project_form_items);
        
        DB::table('project_form_uploads')->delete();
        ProjectFormUpload::insert($project_form_uploads);
        
        DB::table('project_form_scores')->delete();
        ProjectFormScore::insert($project_form_scores);
        
        
        
    }
}
