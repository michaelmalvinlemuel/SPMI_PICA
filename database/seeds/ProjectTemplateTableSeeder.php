<?php

use Illuminate\Database\Seeder;
use App\Project;
use App\ProjectNode;
use App\ProjectTemplate;
use App\ProjectNodeTemplate;

class ProjectTemplateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('project_templates')->delete();
        
        $project = Project::get();
        foreach($project as $key => $value) {
            $template = new ProjectTemplate;
            $template->id = $value->id;
            $template->code = $value->code;
            $template->name = $value->name;
            $template->description = $value->description;
            $template->status = 0;
            $template->deleted_at = $value->deleted_at;
            $template->created_at = $value->created_at;
            $template->updated_at = $value->updated_at;
            $template->save();
        }
        
        DB::table('project_node_templates')->delete();
        
        $projectNode = ProjectNode::get();
        foreach($projectNode as $key => $value) {
            $templateNode = new ProjectNodeTemplate;
            $templateNode->id = $value->id;
            $templateNode->name = $value->name;
            $templateNode->description = $value->description;
            $templateNode->project_template_id = $value->project_id;
            if ($value->project_type == 'App\Project') {
                $templateNode->project_template_type = 'App\ProjectTemplate';
            } else {
                $templateNode->project_template_type = 'App\ProjectNodeTemplate';
            }
            $templateNode->created_at = $value->created_at;
            $templateNode->updated_at = $value->updated_at;
            $templateNode->deleted_at = $value->deleted_at;
            $templateNode->save(); 
            
        }
    }
}
