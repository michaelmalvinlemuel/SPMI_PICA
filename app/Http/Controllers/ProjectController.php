<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\ProjectNode;
use App\ProjectNodeDelegation;
use App\ProjectUser;
use App\ProjectForm;
use App\ProjectFormItem;
use App\ProjectFormUpload;
use Response;
use App\Form;

class ProjectController extends Controller
{

    private $leader = [];
    
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

                $delegations = $nodes[$key]['delegations'];

                foreach($delegations as $key1 => $value1) {
                    $projectDelegation = new ProjectNodeDelegation;
                    $projectDelegation->project_node_id = $projectNode->id;
                    $projectDelegation->user_id = $value1['id'];
                    $projectDelegation->touch();
                    $projectDelegation->save();
                }
                    

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
                    $projectFormItem->document = $value1['document'];
                    $projectFormItem->touch();
                    $projectFormItem->save();
                    
                   	if (isset($value1['uploads'])) {
	                    $projectUpload = $value1['uploads'];
	                    $projectUpload = json_decode(json_encode($projectUpload), true);
	                    
	                    foreach($projectUpload as $key2 => $value2) {
	                    	$upload = new ProjectFormUpload;
	                    	$upload->project_form_item_id = $projectFormItem->id;
	                    	$upload->upload = $value2['upload'];
	                    	$upload->user_id = $value2['user_id'];
	                    	$upload->touch();
	                    	$upload->save();
	                    	//echo $upload->id;
	                    }
                   	}
                }

                //return 0;
            }
        }
        
    }
	
    public function selectNodeAll($nodes, $parent) {
    
    	foreach($nodes as $key => $value) {
    
    		$projectNode = ProjectNode::with('delegations')->where('project_id', '=', $value->id)->where('project_type', '<>', 'App\Project')->get();
    
    		if (count($projectNode) > 0) {
    
    			foreach ($nodes as $key2 => $value2) {
    				$nodes[$key2]['header'] = $value2->name;
    			}
    
    			$nodes[$key]['children'] = $projectNode;
    			$this->selectNodeAll($projectNode, $nodes[$key]);
    
    		} else {
    
    			$projectForm = ProjectForm::where('project_node_id', '=', $value->id)->get();
    			$projectFormItem = ProjectFormItem::where('project_form_id', '=', $projectForm[0]->id)->get();
    			$form = [];
    
    			foreach ($projectFormItem as $key1 => $value1) {
    				$form[$key1] = Form::with('instruction.guide.standardDocument.standard')->find($value1->form_id);
    				$form[$key1]['project_form_item_id'] = $value1->id;
    
    				$projectUpload = ProjectFormUpload::where('project_form_item_id', '=', $value1->id)->get();
    				$form[$key1]['uploads'] = $projectUpload;
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
    
    public function selectNode($nodes, $parent) {
        
        foreach($nodes as $key => $value) {

            $projectNode = ProjectNode::with('delegations')->where('project_id', '=', $value->id)->where('project_type', '<>', 'App\Project')->get();

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
           			$form[$key1]['project_form_item_id'] = $value1->id; 
           			
           			$lastUpload = ProjectFormUpload::where('project_form_item_id', '=', $value1->id)->max('created_at');
           			$projectUpload = ProjectFormUpload::where('project_form_item_id', '=', $value1->id)
           				->where('created_at', '=', $lastUpload)->with('users')->first();
                	$form[$key1]['uploads'] = $projectUpload;
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

            $projectNodeDelegation = ProjectNodeDelegation::where('project_node_id', '=', $value->id);
            $projectNodeDelegation->delete();

            $this->recursiveNodeDelete($projectNode);

            $projectNodeForm = ProjectForm::where('project_node_id', '=', $value->id)->get();

            foreach($projectNodeForm as $key1 => $value1) {
            	$formItem = $projectNodeForm[$key1]->forms()->get();
            	foreach($formItem as $key2 => $value2) {
            		$formItem[$key2]->uploads()->delete();
            	}
                $projectNodeForm[$key1]->forms()->delete();    
            }
            
           
            $projectNode->forms()->delete();
        }

        $nodes->delete();
        //$nodes->delegations()->delete();
        

    }

    public function index()
    {
        $project = Project::with('leader')->get();
        return Response::json($project, 200, [], JSON_PRETTY_PRINT);
    }

    public function store(Request $request)
    {
        //$users = {};
        //return Response::json($request->all(), 500, [], JSON_PRETTY_PRINT);

        $users = $request->input('users');
        $leader = null;

        foreach ($users as $key => $value) {
            //return $value['leader'];
            if ($value['leader'] == true) {
                $leader = $value['id'];
                //$this->leader[0] = $leader;
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

        $this->leader = [];

        return $temp;

    }

    public function show($id)
    {
        $project = Project::with('users')->with('projects.delegations')->find($id);

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

        $this->selectNodeAll($project['projects'], $project);
        
        return Response::json($project, 200, [], JSON_PRETTY_PRINT);
        return $project;
    }
    
    public function showLast($id)
    {
    	$project = Project::with('users')->with('projects.delegations')->find($id);
    
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
    
    	return Response::json($project, 200, [], JSON_PRETTY_PRINT);
    	return $project;
    
    }

    public function update(Request $request, $id)
    {
        $users = $request->input('users');

        foreach ($users as $key => $value) {
            if ($value['leader'] == true) {
                $leader = $value['id'];
                $this->leader[0] = $leader;
                break;
            }
        }

        $project = Project::with('projects')->find($id);

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
        
        $this->leader = [];
        //$project->touch();
        

        //$project->save();

        //return $temp;

    }

    public function destroy($id) 
    {
        $project = Project::with('projects')->find($id);
        //return $project;
        $this->recursiveNodeDelete($project);

        $project->projectUsers()->delete();
        $project->delete();

        $this->leader = [];
    }

    public function user($id) {
        $project = Project::whereHas('projectUsers', function($query) use($id) {
            $query->where('user_id', '=', $id);
        })->with('leader')->get();

        return Response::json($project, 200, [], JSON_PRETTY_PRINT);
    }

    Public function delegate(Request $request) {

        $projectId = $request->input('project_id');
        

        $projectDelegation = ProjectNodeDelegation::where('project_node_id', '=', $projectId);
        $projectDelegation->delete();    
        
        
        $project = $request->input('delegations');
        //return Response::json($project, 200, [], JSON_PRETTY_PRINT);

        foreach ($project as $key => $value) {

            $newProjectDelegation = new ProjectNodeDelegation;
            $newProjectDelegation->project_node_id = $projectId;
            $newProjectDelegation->user_id = $value['id'];
            $newProjectDelegation->touch();
            $newProjectDelegation->save();

        }

    }
    
    public function form($id) {
    	$delegation = ProjectFormItem::with('projectForm.projectNode.delegations')->with('form')->with('uploads.users')->find($id);
    	return Response::json($delegation, 200, [], JSON_PRETTY_PRINT);
    	
    }
    
    public function leader($id) {
    	$delegation = Project::with('leader')->find($id);
    	return $delegation;//Response::json($delegation, 200, [], JSON_PRETTY_PRINT);
    }
    
	public function upload(Request $request) {
		$user = User::find($request->input('user_id'));
		
		$filename = $request->file('file')->getClientOriginalName();
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		$filename = basename($request->input('description'), "." . $ext);
		$filename = strtoupper(preg_replace('/\s+/', '', $user->nik . "_" . $user->name . "_" . $filename . "_" . date("YmdHis")))  . "." . $ext;
		$upload = $request->file('file')->move(env('APP_UPLOAD') . '\project', $filename); 
		
		$uploadForm = new ProjectFormUpload;
		$uploadForm->project_form_item_id = $request->input('project_form_item_id');
		$uploadForm->user_id = $user->id;
		$uploadForm->upload = $filename;
		$uploadForm->touch();
		$uploadForm->save();
        
        $projectForm = ProjectFormUpload::with('users')->find($request->input('project_form_item_id'));
        return response()->json($projectForm);
	}
	
	public function validatingName($name, $id=false) {
		
		if ($id) {
            return Project::where('name', '=', $name)
                ->where('id', '<>', $id)
                ->get();
        } else {
            return GProjectroupJob::where('name', '=', $name)
                ->get();    
        }
	}


}
