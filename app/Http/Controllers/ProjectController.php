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
use App\ProjectAssessor;
use App\ProjectForm;
use App\ProjectFormItem;
use App\ProjectFormScore;
use App\ProjectFormUpload;
use Response;
use App\Form;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use Exception;

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
                    $projectForm->lock = false;

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
               
                $projectForm = ProjectForm::where('project_node_id', '=', $value->id)->with('scores')->get();
                
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
                    
                    
                   
                    $nodes[$key]['weight'] = $projectForm[0]->weight;
                    //$nodes[$key]['score'] = $projectForm[0]->score;
                    $nodes[$key]['forms'] = $form;
                    $nodes[$key]['lock'] = $projectForm[0]->lock;
                    
                } else {
                    
                    foreach ($nodes as $key2 => $value2) {
                        $nodes[$key2]['header'] = $value2->name;
                    }
                    
                    $nodes[$key]['children'] = [];
                    $nodes[$key]['weight'] = 0;
                    ///$nodes[$key]['score'] = 0;
                }

                $nodes[$key]['children'] = [];

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

                $projectForm = ProjectForm::where('project_node_id', '=', $value->id)->with('score.users')->get();
                
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


                    //$nodes[$key]['score'] = $projectFormScore['score'];
                
                    $nodes[$key]['children'] = [];
                    $nodes[$key]['forms'] = $form;
                    $nodes[$key]['weight'] = $value0->weight;
                    $nodes[$key]['score'] = $value0->score;
                    $nodes[$key]['lock'] = $value0->lock;
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
    
    
    private $totalScore = 0; //private variable for calculation project performance in recursive method of $this->recursivePerformanceScoring
    private $totalWeight = 0;

    private function calculateOveralScore($project) {
        
        $projectNode = ProjectNode::where('project_id', '=', $project->id)->get();
        
        if (count($projectNode) > 0) {
            
            foreach($projectNode as $key => $value) {
                $this->calculateOveralScore($projectNode[$key]);
            } 

        } else {
            
            $projectForm = ProjectForm::where('project_node_id', '=', $project->id)->first();
            if ($projectForm) {
                $weight = $projectForm->weight;
                

                $nodeScore = 0;
                $projectFormScore = ProjectFormScore::where('project_form_id', '=', $projectForm->id)->orderBy('created_at', 'desc')->first();
                if ($projectFormScore) {
                    $nodeScore = $projectFormScore->score;
                } else {
                    $nodeScore = 0;
                }
               


                if (isset($weight) && isset($nodeScore)) {

                    $this->totalWeight += $weight;
                    $this->totalScore += $weight * $nodeScore; 

                }
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
 
            $this->totalScore = 0;
            $this->totalWeight = 0;
            
            if ($value->status !== "0") {
                $this->calculateOveralScore($value);
                $value->score = $this->totalScore / $this->totalWeight;
            } else {
                $value->score = null;
            }
            
            $this->totalScore = 0;
            $this->totalWeight = 0;
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
        $assessors = $request->input('assessors');
        
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
        $project->type = $request->input('type');
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
        
        foreach($assessors as $key => $value) {
            $projectAssessor = new ProjectAssessor;
            $projectAssessor->project_id = $project->id;
            $projectAssessor->user_id = $value['id'];
            $projectAssessor->touch();
            $projectAssessor->save();
        }

        $projectNode = [];
        $projectNode = $request->input('projects');

        $temp = $this->recursiveNode($projectNode, $project);


        return $temp;

    }
    
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function show($id)
    {

        $project = Project::with('users')->with('assessors')->with('projects.delegations')->find($id);

        //add header attribute for frontend;
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
        
        $this->totalScore = 0;
        $this->totalWeight = 0;
        
        if ($project->status !== "0") {
            $this->calculateOveralScore($project);
            $project->score = $this->totalScore / $this->totalWeight;
        } else {
            $project->score = null;
        }
        
        $this->totalScore = 0;
        $this->totalWeight = 0;


        return response()->json($project, 200, [], JSON_PRETTY_PRINT);
        //return $project;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function showLast($id)
    {
    	$project = Project::with('users')->with('assessors')->with('projects.delegations')->find($id);

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
        

        $project->score = 'perkontol';

        $this->totalScore = 0;
        $this->totalWeight = 0;
        
        if ($project->status !== "0") {
            $this->calculateOveralScore($project);
            $project->score = $this->totalScore / $this->totalWeight;
        } else {
            $project->score = null;
        }
        
        $this->totalScore = 0;
        $this->totalWeight = 0;


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
        $assessors = $request->input('assessors');
        
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
        
        //delete project user via table;
        $project->projectUsers()->delete();
        $project->projectAssessors()->delete();

        //declare new project
        //$project = new Project;
        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->date_start = $request->input('start');
        $project->date_ended = $request->input('ended');
        $project->type = $request->input('type');
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
        
        //add project assessors
        foreach($assessors as $key => $value) {
            $projectAssessor = new ProjectAssessor;
            $projectAssessor->project_id = $project->id;
            $projectAssessor->user_id = $value['id'];
            $projectAssessor->touch();
            $projectAssessor->save();
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
 
            $this->totalScore = 0;
            $this->totalWeight = 0;
            
            if ($value->status !== "0") {
                $this->calculateOveralScore($value);
                $value->score = $this->totalScore / $this->totalWeight;
            } else {
                $value->score = null;
            }
            
            $this->totalScore = 0;
            $this->totalWeight = 0;
        }

        
        return response()->json($project, 200, []);
        
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
        
		$uploadForm = new ProjectFormUpload;
		$uploadForm->project_form_item_id = $request->input('project_form_item_id');
		$uploadForm->user_id = $user->id;
		$uploadForm->upload = $request->input('filename');
		$uploadForm->touch();
		$uploadForm->save();
        
        $response = ProjectFormUpload::with('users')->find($uploadForm->id);
        return response()->json($response);
	}
	
	public function validatingName($name, $id = false) {
		
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
    
    public function lock($id, $lockStatus)
    {
        $project = Project::with('projects')->find($id);
        
        function lockingSystem($nodes, $lockStatus) {
            
            foreach($nodes as $key => $value) {
                
                $projectNode = ProjectNode::where('project_id', '=', $value->id)->where('project_type', '<>', 'App\Project')->get();
                
                if (count($projectNode) > 0) {
                    
                    lockingSystem($projectNode, $lockStatus);
                    
                } else {
                    
                    $projectForm = ProjectForm::where('project_node_id', '=', $value->id)->first();
                    $projectForm->lock = $lockStatus;
                    $projectForm->touch();
                    $projectForm->save();
                               
                }
            }
            
        };
        
        lockingSystem($project->projects, $lockStatus);
    }


}
