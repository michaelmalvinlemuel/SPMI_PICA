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

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class ProjectController extends Controller
{

    private $leader = [];
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
         
    public function recursiveNode($nodes, $parent) 
    {

        foreach ($nodes as $key => $value) {

            $projectNode = new ProjectNode;
            $projectNode->name = $value['header'];
            $projectNode->description = $value['description'];
            $projectNode->touch();
            $parent->projects()->save($projectNode);
            //$parent->save();
            
            
            $delegations = $value['delegations'];
            //return $delegations;
            //this is the funck that we should get ridd off
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
                
                //check if node has form.
                if (isset($value['forms'])) {
                    $projectForm = new ProjectForm;
                    $projectForm->project_node_id = $projectNode->id;
                    
                    if (isset($value['weight'])) {
                        $projectForm->weight = $value['weight'];
                    } else {
                        $projectForm->weight = 0;
                    }
                    $projectForm->touch();
                    $projectForm->save();
                    
                    //re-inserting project form item
                    $forms = $value['forms'];
                    foreach($forms as $key1 => $value1) {
                        $projectFormItem = new ProjectFormItem;
                        $projectFormItem->project_form_id = $projectForm['id'];
                        $projectFormItem->form_id = $value1['id'];
                        $projectFormItem->document = $value1['document'];
                        $projectFormItem->touch();
                        $projectFormItem->save();
                        
                        //check if each item already had upload file
                        if (isset($value1['uploads'])) {
                            $projectUpload = $value1['uploads'];
                            $projectUpload = json_decode(json_encode($projectUpload), true);
                            
                            //re-inserting uploaded form for each project form item;
                            foreach($projectUpload as $key2 => $value2) {
                                $upload = new ProjectFormUpload;
                                $upload->project_form_item_id = $projectFormItem->id;
                                $upload->upload = $value2['upload'];
                                $upload->user_id = $value2['user_id'];
                                $upload->touch();
                                $upload->save();
                            }
                        }
                    }
                }
            }
        }
        
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
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
                
                //checkpoint handler if node doesnt had froms yet
               
                $projectForm = ProjectForm::where('project_node_id', '=', $value->id)->get();
                
                if (count($projectForm) > 0) {
                    
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
                    $nodes[$key]['score'] = $projectForm[0]->score;
                    
                } else {
                    
                    foreach ($nodes as $key2 => $value2) {
                        $nodes[$key2]['header'] = $value2->name;
                    }
                    
                    $nodes[$key]['children'] = [];
                    $nodes[$key]['weight'] = 0;
                    $nodes[$key]['score'] = 0;
                }
    		}
    	}
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function selectNode($nodes, $parent) {
        
        foreach($nodes as $key => $value) {

            $projectNode = ProjectNode::with('delegations')->where('project_id', '=', $value->id)->where('project_type', '<>', 'App\Project')->get();
            
            $nodes[$key]['header'] = $value->name;

            if (count($projectNode) > 0) {

                

                $nodes[$key]['children'] = $projectNode;
                $this->selectNode($projectNode, $nodes[$key]);

            } else {

                $projectForm = ProjectForm::where('project_node_id', '=', $value->id)->get();
                
                foreach($projectForm as $key0 => $value0) {
                    
                    $projectFormItem = ProjectFormItem::where('project_form_id', '=', $value0->id)->get();
                    $form = [];
    
                    foreach ($projectFormItem as $key1 => $value1) {
                        $form[$key1] = Form::find($value1->form_id);
                        $form[$key1]['project_form_item_id'] = $value1->id; 
                        
                        $lastUpload = ProjectFormUpload::where('project_form_item_id', '=', $value1->id)->max('created_at');
                        $projectUpload = ProjectFormUpload::where('project_form_item_id', '=', $value1->id)
                            ->where('created_at', '=', $lastUpload)->with('users')->first();
                        $form[$key1]['uploads'] = $projectUpload;
                    }
    
                    $nodes[$key]['children'] = [];
                    $nodes[$key]['forms'] = $form;
                    $nodes[$key]['weight'] = $value0->weight;
                    $nodes[$key]['score'] = $value0->score;
                }
            }
        }
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
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
    
    
    private $score = 0; //private variable for calculation project performance in recursive method of $this->recursivePerformanceScoring
    
    private function recursivePerformanceScoring ($project) {
        
        $projectNode = ProjectNode::where('project_id', '=', $project->id)->get();
        
        if (count($projectNode) > 0) {
            
            foreach($projectNode as $key => $value) {
                $this->recursivePerformanceScoring($projectNode[$key]);
            } 

        } else {
            
            $projectForm = ProjectForm::where('project_node_id', '=', $project->id)->first();
            if (isset($projectForm->weight) && isset($projectForm->score)) {
                $this->score += $projectForm->weight * $projectForm->score; 
            }
            
        }    
    }
                
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index($display, $initiation, $preparation, $progress, $grading, $complete, $terminated)
    {
        
        $project = Project::with('leader')->where('deleted_at', 'IS', 'NULL');
        
        if ($initiation == 'true') {
            $project = $project->initiation();
        }
        
        if ($preparation == 'true') {
            $project = $project->preparation();
        }
        
        if ($progress == 'true') {
            $project = $project->progress();
        }
        
        if ($grading == 'true') {
            $project = $project->grading();
        }
        
        if ($complete == 'true') {
            $project = $project->complete();
        }
        
        if ($terminated == 'true') {
            $project = $project->terminated();
        }
        
        $project = $project->paginate($display);
        
        foreach($project as $key => $value) {
            if ($value->status !== '0') {
                $this->score = 0;
                $this->recursivePerformanceScoring($project[$key]);
                $value->score = round($this->score/100, 2);
                $this->score = 0;
            }    
        }
        
        return response()->json($project);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function store(Request $request)
    {
        //capture users list
        $users = $request->input('users');
        $leader = null;
        
        //determine leader from list
        foreach ($users as $key => $value) {
            //return $value['leader'];
            if ($value['leader'] == true) {
                $leader = $value['id'];
                break;
            }
        }
        
        //create new project model
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

        $temp = $this->recursiveNode($projectNode, $project);


        return $temp;

    }
    
    private function recursiveScore($nodes) {
        
        foreach ($nodes as $key => $value) {
            
            if (count($value['children']) > 0) {
                
                $this->recursiveScore($value['children']);
                
            } else {

                $projectForm = ProjectForm::where('project_node_id', '=', $value['id'])->first();
                if (isset($value['score'])) {
                    $projectForm->score = $value['score'];
                } else {
                    $projectForm->score = 0;
                }
               
                $projectForm->touch();
                $projectForm->save();
                
            }
        }
    }
    
    public function score(Request $request) {
        $projectNode = $request->input('projects');
        
        $this->recursiveScore($projectNode);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
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
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
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
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     

    public function update(Request $request, $id)
    {
        $users = $request->input('users');
        $leader = null;
        
        foreach ($users as $key => $value) {
            if ($value['leader'] == true) {
                $leader = $value['id'];
                break;
            }
        }

        $project = Project::with('projects')->find($id);
        
        foreach($project->projects as $key => $value) {
            $this->recursiveNodeDelete($value);
        }
        //destroy this current project
        
        $project->projectUsers()->delete();

        //declare new project
        //$project = new Project;
        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->date_start = $request->input('start');
        $project->date_ended = $request->input('ended');
        $project->user_id = $leader;
        $project->status = $request->input('status');
        $project->touch();
        
        //add new project members
        foreach($users as $key => $value) {
            $projectUser = new ProjectUser;
            $projectUser->project_id = $project->id;
            $projectUser->user_id = $value['id'];
            $projectUser->touch();
            $projectUser->save();
        }

        $projectNode = [];
        $projectNode = $request->input('projects');
        
        //return $projectNode;
        return $this->recursiveNode($projectNode, $project);

     


    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) 
    {
        $project = Project::with('projects')->find($id);
        //return $project;
        $this->recursiveNodeDelete($project);

        $project->projectUsers()->delete();
        $project->delete();

        $this->leader = [];
    }
    
    /**
     * Display project with current user presented and user is member of that project;
     *
     * @return \Illuminate\Http\Response
     */
    public function user($display, $initiation, $preparation, $progress, $grading, $complete, $terminated) {
        
        $user = JWTAuth::parseToken()->authenticate();
        
        $project = Project::with('leader')->where('deleted_at', 'IS', 'NULL');
        
        if ($initiation == 'true') {
            $project = $project->userInitiation($user);
        }
        
        if ($preparation == 'true') {
            $project = $project->userPreparation($user);
        }
        
        if ($progress == 'true') {
            $project = $project->userProgress($user);
        }
        
        if ($grading == 'true') {
            $project = $project->userGrading($user);
        }
        
        if ($complete == 'true') {
            $project = $project->userComplete($user);
        }
        
        if ($terminated == 'true') {
            $project = $project->userTerminated($user);
        }
        
        $project = $project->paginate($display);
        
        
        foreach($project as $key => $value) {
            
            if ($value->status !== '0') {
                
                $this->score = 0;
                $this->recursivePerformanceScoring($project[$key]);
                $value->score = round($this->score/100, 2);
                $this->score = 0;
            }    
        }
        
        return response()->json($project, 200, [], JSON_PRETTY_PRINT);
        
    }
    
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
     
     private function inheritDelegation($nodes, $delegations) {
         
         foreach($nodes as $key => $value) {
             $nodeDelegation = ProjectNodeDelegation::where('project_node_id', '=', $value->id);
             $nodeDelegation->delete();
             
             foreach($delegations as $key2 => $value2) {
                 $newNodeDelegation = new ProjectNodeDelegation;
                 $newNodeDelegation->project_node_id = $value->id;
                 $newNodeDelegation->user_id = $value2['id'];
                 $newNodeDelegation->touch();
                 $newNodeDelegation->save();
             }
             $nodes = ProjectNode::where('project_id', '=', $value->id)->where('project_type', '<>', 'App\Project')->get();
             $this->inheritDelegation($nodes, $delegations);
         }
     }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    Public function delegate(Request $request) {

        $projectId = $request->input('project_id');
        
        $projectDelegation = ProjectNodeDelegation::where('project_node_id', '=', $projectId);
        $projectDelegation->delete();    
        
        $delegations = $request->input('delegations');

        foreach ($delegations as $key => $value) {
            $newProjectDelegation = new ProjectNodeDelegation;
            $newProjectDelegation->project_node_id = $projectId;
            $newProjectDelegation->user_id = $value['id'];
            $newProjectDelegation->touch();
            $newProjectDelegation->save();
        }
                
        if ($request->input('inherit') == true) {
            //get child node for project by project_id
            $nodes = ProjectNode::where('project_id', '=', $request->input('project_id'))->where('project_type', '<>', 'App\Project')->get();
            $this->inheritDelegation($nodes, $delegations);
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
		$user = JWTAuth::parseToken()->authenticate();
		
        /*
		$filename = $request->file('file')->getClientOriginalName();
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		$filename = basename($request->input('description'), "." . $ext);
		$filename = strtoupper(preg_replace('/\s+/', '', $user->nik . "_" . $user->name . "_" . $filename . "_" . date("YmdHis")))  . "." . $ext;
		$upload = $request->file('file')->move(env('APP_UPLOAD') . '\project', $filename); 
		*/
        
		$uploadForm = new ProjectFormUpload;
		$uploadForm->project_form_item_id = $request->input('project_form_item_id');
		$uploadForm->user_id = $user->id;
		$uploadForm->upload = $request->input('filename');
		$uploadForm->touch();
		$uploadForm->save();
        
        $response = ProjectFormUpload::with('users')->find($uploadForm->id);
        return response()->json($response);
	}
	
	public function validatingName($name, $id=false) {
		
		if ($id) {
            return Project::where('name', '=', $name)
                ->where('id', '<>', $id)
                ->get();
        } else {
            return Project::where('name', '=', $name)
                ->get();    
        }
	}
    
    public function mark(Request $request, $id) 
    {
        $project = Project::find($id);
        $project->status = $request->input('status');
        $project->touch();
        $project->save();    
    }


}
