<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\ProjectNode;
use App\ProjectUser;
use App\ProjectForm;
use App\ProjectFormItem;
use Response;
use App\Form;

class ProjectController extends Controller
{
    
    public function recursiveNode($nodes, $parent) 
    {
        //$nodes = json_decode(json_encode($nodes), true);
        //return $nodes;
       

        foreach ($nodes as $key => $value) {

                $projectNode = new ProjectNode;
                $projectNode->name = $value['header'];
                $projectNode->description = $value['description'];
                $projectNode->touch();
                $parent->projects()->save($projectNode);

            if (count($value['children']) > 0) {

                
                $this->recursiveNode($value['children'], $projectNode);
                //return $projectNode;

            } else {

                $projectForm = new ProjectForm;
                $projectForm->project_node_id = $projectNode['id'];
                $projectForm->weight = $value['weight'];
                $projectForm->touch();
                $projectForm->save();

                $forms = $value['forms'];
                foreach($forms as $key1 => $value1) {
                    $projectFormItem = new ProjectFormItem;
                    $projectFormItem->project_form_id = $projectForm['id'];
                    $projectFormItem->form_id = $value1['id'];
                    $projectFormItem->touch();
                    $projectFormItem->save();
                }

                //return 0;
            }
        }
        
    }

    public function selectNode($nodes, $parent) {
        
        foreach($nodes as $key => $value) {

            $projectNode = ProjectNode::where('project_id', '=', $value->id)->where('project_type', '<>', 'App\Project')->get();

            if (count($projectNode) > 0) {

                foreach ($nodes as $key2 => $value2) {
                   $nodes[$key2]['header'] = $value2->name;
                }

                $nodes[$key]['children'] = $projectNode;
                $this->selectNode($projectNode, $nodes[$key]);

            } else {

                $projectForm = ProjectForm::where('project_node_id', '=', $value->id)->get();
                $projectFormItem = ProjectFormItem::where('project_form_id', '=', $projectForm[0]->id)->get();
                $form = [];

                foreach ($projectFormItem as $key1 => $value1) {
                    $form[$key1] = Form::find($value1->form_id);
                }

                foreach ($nodes as $key2 => $value2) {
                   $nodes[$key2]['header'] = $value2->name;
                }

                $nodes[$key]['children'] = [];
                $nodes[$key]['forms'] = $form;
                $nodes[$key]['weight'] = $projectForm[0]->weight;
            }
        }
    }

    public function recursiveNodeDelete($nodes) {

        foreach ($nodes->projects as $key => $value) {
            $projectNode = ProjectNode::find($value->id);

            $this->recursiveNodeDelete($projectNode);

            $projectNode->delegations()->delete();

            $projectNodeForm = ProjectForm::where('project_node_id', '=', $value->id)->get();

            foreach($projectNodeForm as $key1 => $value1) {
                $projectNodeForm[$key1]->forms()->delete();    
            }
            
           
            $projectNode->forms()->delete();
        }

        $nodes->delete();
        //$nodes->delegations()->delete();
        

    }


    public function index()
    {
        return Project::with('leader')->get();
    }

    public function store(Request $request)
    {
        //$users = {};
        $users = $request->input('users');
        

        foreach ($users as $key => $value) {
            //return $value['leader'];
            if ($value['leader'] == true) {
                $leader = $value['id'];
                break;
            }
        }

        $project = new Project;
        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->date_start = $request->input('start');
        $project->date_ended = $request->input('ended');
        $project->user_id = $leader;
        $project->status = '1';

        $project->touch();
        //$project->save();

        foreach($users as $key => $value) {
            $projectUser = new ProjectUser;
            $projectUser->project_id = $project->id;
            $projectUser->user_id = $value['id'];
            $projectUser->touch();
            $projectUser->save();
        }

        $projectNode = [];
        $projectNode = $request->input('projects');
        //return Response::json($projectNode, 200, [], JSON_PRETTY_PRINT);

        //return $projectNode[0]['children'];
        $temp = $this->recursiveNode($projectNode, $project);
        return $temp;

    }

    public function show($id)
    {
        $project = Project::with('users')->with('projects')->find($id);

        foreach ($project->projects as $key => $value) {
            $project->projects[$key]['header'] = $value->name;
        }
        
        foreach ($project->users as $key => $value) {
            if ($project->user_id == $value->id) {
                $project->users[$key]['leader'] = true;
            } else {
                $project->users[$key]['leader'] = false;
            }
        }

        $this->selectNode($project['projects'], $project);
        
        return $project;
        //return Response::json($project, 200, [], JSON_PRETTY_PRINT);
    }

    public function update(Request $request)
    {
        $users = $request->input('users');

        foreach ($users as $key => $value) {
            if ($value['leader'] == true) {
                $leader = $value['id'];
                break;
            }
        }

        $project = Project::with('projects')->find($request->input('id'));

        $this->recursiveNodeDelete($project);
        $project->projectUsers()->delete();

        //$project->deleted_at = null;
        $project = new Project;
        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->date_start = $request->input('start');
        $project->date_ended = $request->input('ended');
        $project->user_id = $leader;
        $project->status = $request->input('status');

        $project->touch();

        foreach($users as $key => $value) {
            $projectUser = new ProjectUser;
            $projectUser->project_id = $project->id;
            $projectUser->user_id = $value['id'];
            $projectUser->touch();
            $projectUser->save();
        }

        $projectNode = [];
        $projectNode = $request->input('projects');
        //return Response::json($projectNode, 200, [], JSON_PRETTY_PRINT);

        //return $projectNode[0]['children'];
        $temp = $this->recursiveNode($projectNode, $project);
        
        //$project->touch();
        

        //$project->save();

        //return $temp;

    }

    public function destroy(Request $request) 
    {
        $project = Project::with('projects')->find($request->input('id'));
        //return $project;
        $this->recursiveNodeDelete($project);

        $project->projectUsers()->delete();
        $project->delete();
    }

}
