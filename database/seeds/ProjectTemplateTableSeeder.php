<?php

use Illuminate\Database\Seeder;

use App\ProjectTemplate;
use App\ProjectNodeTemplate;
use App\ProjectNodeFormTemplate;
use App\ProjectNodeFormItemTemplate;


class ProjectTemplateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        include('spmi (15).php');
        
        DB::table('project_templates')->delete();
        ProjectTemplate::insert($project_templates);
        
        DB::table('project_node_templates')->delete();
        ProjectNodeTemplate::insert($project_node_templates);
        
        DB::table('project_node_form_templates')->delete();
        ProjectNodeFormTemplate::insert($project_node_form_templates);
        
        DB::table('project_node_form_item_templates')->delete();
        ProjectNodeFormItemTemplate::insert($project_node_form_item_templates);
    }
}
