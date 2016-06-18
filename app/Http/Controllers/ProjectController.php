<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\ProjectNode;
use App\ProjectNodeDelegation;
use App\ProjectNodeAssessor;
use App\ProjectUser;
use App\ProjectAssessor;
use App\ProjectForm;
use App\ProjectFormItem;
use App\ProjectFormScore;
use App\ProjectFormUpload;
use App\ProjectFormUploadAttachment;
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
            
            
            if (isset($value['delegations'])) {
                $delegations = $value['delegations'];
                foreach($delegations as $key1 => $value1) {
                    
                    if (isset($value1['id'])) {
                        $projectDelegation = new ProjectNodeDelegation;
                        $projectDelegation->project_node_id = $projectNode->id;
                        $projectDelegation->user_id = $value1['id'];
                        $projectDelegation->touch();
                        $projectDelegation->save();
                    }
                    
                } 
            }
            
            if (isset($value['assessors'])) {
                $assessors = $value['assessors'];
                foreach($assessors as $key1 => $value1) {
                    
                    if (isset($value1['id'])) {
                        $projectAssessor = new ProjectNodeAssessor;
                        $projectAssessor->project_node_id = $projectNode->id;
                        $projectAssessor->user_id = $value1['id'];
                        $projectAssessor->touch();
                        $projectAssessor->save();
                    }
                    
                    
                } 
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
                                
                                if (isset($value2['attachments'])) {
                                    $attachments = $value2['attachments'];
                                    $attachments = json_decode(json_encode($attachments), true);
                                    
                                    foreach ($attachments as $key3 => $value3) {
                                        $projectAttachment = new ProjectFormUploadAttachment;
                                        $projectAttachment->project_form_upload_id = $upload->id;
                                        $projectAttachment->title = $value3['title'];
                                        $projectAttachment->description = $value3['description'];
                                        $projectAttachment->attachment = $value3['attachment'];
                                        $projectAttachment->touch();
                                        $projectAttachment->save();
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        
    }
	
    /**
     * Select with all uploaded form
     *
     * @return \Illuminate\Http\Response
     */
     
    public function selectNodeAll($nodes, $parent) {
    
    	foreach($nodes as $key => $value) {
    
    		$projectNode = ProjectNode::with('delegations')->with('assessors')->where('project_id', '=', $value->id)->where('project_type', '<>', 'App\Project')->get();
    
    		if (count($projectNode) > 0) {
    
    			foreach ($nodes as $key2 => $value2) {
    				$nodes[$key2]['header'] = $value2->name;
                    $nodes[$key2]['label'] = $value2->name;
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
        
                        $projectUpload = ProjectFormUpload::with('attachments')->where('project_form_item_id', '=', $value1->id)->get();
                        $form[$key1]['uploads'] = $projectUpload;
                    }
        
                    foreach ($nodes as $key2 => $value2) {
                        $nodes[$key2]['header'] = $value2->name;
                        $nodes[$key2]['label'] = $value2->name;
                    }
                    
                    
                   
                    $nodes[$key]['weight'] = $projectForm[0]->weight;
                    $nodes[$key]['forms'] = $form;
                    $nodes[$key]['lock'] = $projectForm[0]->lock;
                    
                } else {
                    
                    foreach ($nodes as $key2 => $value2) {
                        $nodes[$key2]['header'] = $value2->name;
                        $nodes[$key2]['label'] = $value2->name;
                    }
                    
                    $nodes[$key]['children'] = [];
                    $nodes[$key]['weight'] = 0;
                }

                $nodes[$key]['children'] = [];

    		}
    	}
    }
    
    /**
     * Select only last uploaded form
     *
     * @return \Illuminate\Http\Response
     */
     
    public function selectNode($nodes, $parent) {
        
        foreach($nodes as $key => $value) {

            $projectNode = ProjectNode::with('delegations')->with('assessors')->where('project_id', '=', $value->id)->where('project_type', '<>', 'App\Project')->get();
            
            $nodes[$key]['header'] = $value->name;
            $nodes[$key]['label'] = $value->name;
            
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
                            ->where('created_at', '=', $lastUpload)
                            ->with('users')->with('attachments')->first();
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
        
        if (isset($nodes->projects)) {
            
            foreach ($nodes->projects as $key => $value) {
                $projectNode = ProjectNode::find($value->id);

                $projectNodeDelegation = ProjectNodeDelegation::where('project_node_id', '=', $value->id);
                $projectNodeDelegation->delete();
                
                $projectNodeAssessor = ProjectNodeAssessor::where('project_node_id', '=', $value->id);
                $projectNodeDelegation->delete();

                $this->recursiveNodeDelete($projectNode);

                $projectNodeForm = ProjectForm::where('project_node_id', '=', $value->id)->get();

                foreach($projectNodeForm as $key1 => $value1) {
                    $formItem = $projectNodeForm[$key1]->forms()->get();
                    foreach($formItem as $key2 => $value2) {
                        
                        $attachments = $formItem[$key2]->uploads()->get();
                        foreach($attachments as $key3 => $value3) {
                            $attachments[$key3]->attachments()->delete();
                        }
                        
                        $formItem[$key2]->uploads()->delete();
                    }
                    $projectNodeForm[$key1]->forms()->delete();    
                }
                
            
                $projectNode->forms()->delete();
            }
            
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
        
        //return response()->json('test');
        
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
                
                if($this->totalWeight > 0) {
                    $value->score = $this->totalScore / $this->totalWeight;
                } else {
                    $value->score = 0;
                }
                
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

        $project = Project::with('users')->with('assessors')->with(['projects' => function($query) {
            $query->with('delegations')->with('assessors');
        }])->find($id);
        
        //return response()->json($project);

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
    
    private function recursiveJsonUnsecured() 
    {
        
    }
    
    public function showLastUnsecured($id) 
    {
        $project = Project::find($id);
        
        foreach ($project->projects as $key => $value) {
            
        }
        
        return response()->json($project);    
    }
    
    public function showLast($id)
    {
    	$project = Project::with('users')->with('assessors')->with(['projects' => function($query) {
            $query->with('delegations')->with('assessors');
        }])->find($id);

    	foreach ($project->projects as $key => $value) {
    		$project->projects[$key]['header'] = $value->name;
    	}
    
    	foreach ($project->users as $key => $value) {
    		if ($project->user_id == $value->id) {
    			$project->users[$key]['leader'] = true;
    		} else {
    			$project->users[$key]['leader'] = false;
    		}
            
            $completeness = $this->countUser($id, $value->id);
            $project->users[$key]['completeness'] = $completeness;
            
    	}
    
    	$this->selectNode($project['projects'], $project);
        

        $project->score = '0';

        $this->totalScore = 0;
        $this->totalWeight = 0;
        
        if ($project->status !== "0") {
            $this->calculateOveralScore($project);
            if ($this->totalWeight > 0) {
                $project->score = $this->totalScore / $this->totalWeight;
            } else {
                $project->score = 0;
            }
            
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
        $project = Project::with('projects')->find($id);
        
        if ($request->input('users')) {
            $leader = null;
            $users = $request->input('users');
            foreach ($users as $key => $value) {
                if ($value['leader'] == true) {
                    $leader = $value['id'];
                    break;
                }
            }
            //delete old project members
            $project->projectUsers()->delete();
            
            //add new project members
            foreach($users as $key => $value) {
                $projectUser = new ProjectUser;
                $projectUser->project_id = $project->id;
                $projectUser->user_id = $value['id'];
                $projectUser->touch();
                $projectUser->save();
            }
        }
        
        if ($request->input('assessors')) {
            $assessors = $request->input('assessors');
            
            //delete project user via table;
            $project->projectAssessors()->delete();
            
            //add project assessors
            foreach($assessors as $key => $value) {
                $projectAssessor = new ProjectAssessor;
                $projectAssessor->project_id = $project->id;
                $projectAssessor->user_id = $value['id'];
                $projectAssessor->touch();
                $projectAssessor->save();
            }
        }
        
        foreach($project->projects as $key => $value) {
            $this->recursiveNodeDelete($value);
        }

        //declare new project
        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->date_start = $request->input('start');
        $project->date_ended = $request->input('ended');
        $project->type = $request->input('type');
        $project->user_id = $leader;
        $project->status = $request->input('status');
        $project->touch();
        
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
                if ($this->totalWeight > 0) {
                    $value->score = $this->totalScore / $this->totalWeight;
                } else {
                    $value->score = 0;
                }
                
            } else {
                $value->score = null;
            }
            
            $this->totalScore = 0;
            $this->totalWeight = 0;
        }
        return response()->json($project, 200, []);
        
    }
    
    public function member($display, $initiation, $preparation, $progress, $grading, $complete, $terminated) {
    
        $user = JWTAuth::parseToken()->authenticate();
        
        $project = Project::with('leader')->where('deleted_at', 'IS', 'NULL');

        if ($initiation == 'true') {
            $project = $project->memberInitiation($user);
        }
        
        if ($preparation == 'true') {
            $project = $project->memberPreparation($user);
        }
        
        if ($progress == 'true') {
            $project = $project->memberProgress($user);
        }
        
        if ($grading == 'true') {
            $project = $project->memberGrading($user);
        }
        
        if ($complete == 'true') {
            $project = $project->memberComplete($user);
        }
        
        if ($terminated == 'true') {
            $project = $project->memberTerminated($user);
        }
        
        $project = $project->paginate($display);

        foreach($project as $key => $value) {
 
            $this->totalScore = 0;
            $this->totalWeight = 0;
            
            if ($value->status !== "0") {
                $this->calculateOveralScore($value);
                if ($this->totalWeight > 0) {
                    $value->score = $this->totalScore / $this->totalWeight;
                } else {
                    $value->score = 0;
                }
                
            } else {
                $value->score = null;
            }
            
            $this->totalScore = 0;
            $this->totalWeight = 0;
        }
        return response()->json($project, 200, []);
        
    }
    
    public function assessor($display, $initiation, $preparation, $progress, $grading, $complete, $terminated) {
        
        $user = JWTAuth::parseToken()->authenticate();
        
        $project = Project::with('leader')->where('deleted_at', 'IS', 'NULL');

        if ($initiation == 'true') {
            $project = $project->assessorInitiation($user);
        }
        
        if ($preparation == 'true') {
            $project = $project->assessorPreparation($user);
        }
        
        if ($progress == 'true') {
            $project = $project->assessorProgress($user);
        }
        
        if ($grading == 'true') {
            $project = $project->assessorGrading($user);
        }
        
        if ($complete == 'true') {
            $project = $project->assessorComplete($user);
        }
        
        if ($terminated == 'true') {
            $project = $project->assessorTerminated($user);
        }
        
        $project = $project->paginate($display);

        foreach($project as $key => $value) {
 
            $this->totalScore = 0;
            $this->totalWeight = 0;
            
            if ($value->status !== "0") {
                $this->calculateOveralScore($value);
                if ($this->totalWeight > 0) {
                    $value->score = $this->totalScore / $this->totalWeight;
                } else {
                    $value->score = 0;
                }
                
            } else {
                $value->score = null;
            }
            
            $this->totalScore = 0;
            $this->totalWeight = 0;
        }
        return response()->json($project, 200, []);
    }
    
    
    /**
     * Method for showing upload history with its attachment
     */
    
    public function form($id) {
    	$delegation = ProjectFormItem::with('projectForm.projectNode.delegations')
            ->with('form')->with(['uploads' => function($query) {
                $query->with('users')->with('attachments')->orderBy('created_at','desc');
            }])->find($id);
    	return response()->json($delegation);
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
	
	public function validatingName(Request $request) {
		
		if ($request->input('id')) {
            return Project::where('name', '=', $request->input('name'))
                ->where('id', '<>', $request->input('id'))
                ->get();
        } else {
            return Project::where('name', '=', $request->input('name'))
                ->get();    
        }
	}
    
    /**
     *  For mark project as complete or terminate
     */
     
    public function mark(Request $request, $id) 
    {
        $project = Project::find($id);
        $project->status = $request->input('status');
        $project->touch();
        $project->save();    
    }
    
    /**
     *  For locking project from its root
     */
     
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
    
    private function adjustAssessors($assessors) {
         
    }
    
    public function adjust (Request $request, $id) {
        
        $project = Project::with('users')->with('assessors')->with(['projects' => function($query) {
            $query->with('delegations')->with('assessors');
        }])->find($id);
        
        
        if ($request->input('users')) {
            $leader = null;
            $users = $request->input('users');
            foreach ($users as $key => $value) {
                if ($value['leader'] == true) {
                    $leader = $value['id'];
                    break;
                }
            }
            //delete old project members
            $project->projectUsers()->delete();
            
            //add new project members
            foreach($users as $key => $value) {
                $projectUser = new ProjectUser;
                $projectUser->project_id = $project->id;
                $projectUser->user_id = $value['id'];
                $projectUser->touch();
                $projectUser->save();
            }
        }
        
        if ($request->input('assessors')) {
            $assessors = $request->input('assessors');
            
            //delete project user via table;
            $project->projectAssessors()->delete();
            
            //add project assessors
            foreach($assessors as $key => $value) {
                $projectAssessor = new ProjectAssessor;
                $projectAssessor->project_id = $project->id;
                $projectAssessor->user_id = $value['id'];
                $projectAssessor->touch();
                $projectAssessor->save();
            }
        }
        
        //declare new project
        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->date_start = $request->input('start');
        $project->date_ended = $request->input('ended');
        $project->type = $request->input('type');
        $project->user_id = $leader;
        $project->status = $request->input('status');
        $project->touch();
        
        foreach($project->projects as $key => $value) {
            $this->adjustAssessors($value);
        }
    }
    
    private function countNode(&$nodes, &$total, &$uploaded) {
       
      // $total++;
       
       foreach($nodes as $key => $value) {
            
            //$total++;
            
            $projectNode = ProjectNode::where('project_id', '=', $value->id)->where('project_type', '<>', 'App\Project')->get();
            
            if(count($projectNode) > 0) {
                
                $this->countNode($projectNode, $total, $uploaded);
                
            } else {
                
                $projectForm = ProjectForm::where('project_node_id', '=', $value->id)->get();
                foreach($projectForm as $key1 => $value1) {
                    
                    $projectFormItem = ProjectFormItem::where('project_form_id', '=', $value1->id)->get();
                    foreach ($projectFormItem as $key2 => $value2) {
                        
                        $projectFormItemUpload = ProjectFormUpload::where('project_form_item_id', '=', $value2->id)
                            ->max('created_at') ;
                        
                        if ($projectFormItemUpload) {
                            $total++;
                            $uploaded++;
                        } else {
                            $total++;
                        }
                        
                    }
                }
                
            }
       }
       
    }
    
    public function count($id) {
        $totalForm = 0;
        $uploadedForm = 0;
        
        $project = Project::with('projects')->find($id);
        
        $this->countNode($project->projects, $totalForm, $uploadedForm);
        
        return response()->json(['total' => $totalForm, 'upload' => $uploadedForm]);
    }
    
    
    private function countUserNode($nodes, &$total, &$uploaded, $userId) {
       
       //$total++;
       
       foreach($nodes as $key => $value) {
            
            //$total++;
            
            $projectNode = ProjectNode::where('project_id', '=', $value->id)
                ->where('project_type', '<>', 'App\Project')->with('delegations')->get();
            
            $users = $value->delegations;
            
            if(count($projectNode) > 0) {
                
                $this->countUserNode($projectNode, $total, $uploaded, $userId);
                
            } else {
                
                $counter = 0;
                foreach($users as $key0 => $value0) {
                   if ($value0->id == $userId) {
                       break;
                   }
                   $counter++;
                }
                
                //check if user checked
                if ($counter < count($users)) {
                    $projectForm = ProjectForm::where('project_node_id', '=', $value->id)->get();
                    foreach($projectForm as $key1 => $value1) {
                        
                        $projectFormItem = ProjectFormItem::where('project_form_id', '=', $value1->id)->get();
                        foreach ($projectFormItem as $key2 => $value2) {
                            
                            $maxUpload = ProjectFormUpload::where('project_form_item_id', '=', $value2->id)
                                ->max('created_at');
                                
                            $projectFormItemUpload = ProjectFormUpload::where('project_form_item_id', '=', $value2->id)
                                ->where('created_at', '=', $maxUpload)->first();
                            
                            if ($projectFormItemUpload) {
                                //if has uploaded form item
                                $uploaded++;
                                $total++;
                            } else {
                                //if has uploaded form item
                                $total++;
                            }
                        }
                    }
                } 
                
            }
       }
       
    }
    
    public function countUser($id, $userId)
    {
        $totalForm = 0;
        $uploadedForm = 0;
        
        $project = Project::with('projects.delegations')->with('users')->find($id);
        $users = $project->users;
        
        $counter = 0;
        foreach($users as $key => $value) {
            
            if ($value->id == $userId) {
                break;
            }
            $counter++;
        }
        
        if ($counter == count($users)) {
            return response()->json(['response' => 'member not found']);
        }
        
        $this->countUserNode($project->projects, $totalForm, $uploadedForm, $userId);
        
        //return response()->json(['total' => $totalForm, 'upload' => $uploadedForm]);
        return ['total' => $totalForm, 'upload' => $uploadedForm];
        //return response()->json($project);
    }
    
    
    /**
     *
     */
     
    private function delegateLeader($oldId, $newId, $nodes)
    {
        
        
        foreach($nodes as $key => $value) {
            
            $projectNodeDelegationOld = ProjectNodeDelegation::where('project_node_id', '=', $value->id)->where('user_id', '=', $oldId)->first();
            $projectNodeDelegationNew = ProjectNodeDelegation::where('project_node_id', '=', $value->id)->where('user_id', '=', $newId)->first();
            
            //return $projectNodeDelegationOld;
            
            if (isset($projectNodeDelegationOld) && isset($projectNodeDelegationNew)) {
                //delete old
                $projectNodeDelegationOld->delete();
            }
            
            if (!isset($projectNodeDelegationOld) && isset($projectNodeDelegationNew)) {
                //do nothing
            }
            
            if (isset($projectNodeDelegationOld) && !isset($projectNodeDelegationNew)) {
                //replace
                $newDelegation = ProjectNodeDelegation::where('project_node_id', '=', $value->id)->where('user_id', '=', $oldId)->first();
                $newDelegation->user_id = $newId;
                $newDelegation->touch();
                $newDelegation->save();
            }
            
            if (!isset($projectNodeDelegationOld) && !isset($projectNodeDelegationNew)) {
                //insert new delegation
                $newDelegation = new ProjectNodeDelegation;
                $newDelegation->project_node_id = $value->id;
                $newDelegation->user_id = $newId;
                $newDelegation->touch();
                $newDelegation->save();
            }          
            
            $projectNode = ProjectNode::where('project_id', '=', $value->id)->where('project_type', '=', 'App\ProjectNode')->get();
            if (count($projectNode) > 0) {
                $this->delegateLeader($oldId, $newId, $projectNode);
            }
        }
        
        
    }
    
    
    /**
     *
     */
     
    public function enrollLeader(Request $request, $id) 
    {
        $project = Project::with('projects')->find($id);
        
        //$project = Project::with('projects')->first();
        //return response()->json($project);
        
        $oldLeader = $project->user_id;
        
        $project->user_id = $request->input('id');
        $project->touch();
        $project->save();
        
        $projectNode = ProjectNode::where('project_id', '=', $id)->where('project_type', '=', 'App\Project')->get();
        $this->delegateLeader($oldLeader, $request->input('id'), $projectNode);
    }
    
    /*
    *
    */
    
    public function enrollMember(Request $request, $id) {
        $member = ProjectUser::where('project_id', '=', $id);
        $member->delete();
        
        $newMember = json_decode(json_encode($request->input('users'), true));
        
        foreach($newMember as $key => $value) {
            $newMember = new ProjectUser;
            $newMember->project_id = $id;
            $newMember->user_id = $value->id;
            $newMember->touch();
            $newMember->save();
        }
        
    }
    
    public function enrollAssessor(Request $request, $id) {
        
        $assessor = ProjectAssessor::where('project_id', '=', $id);
        $assessor->delete();
        
        $newAssessor = json_decode(json_encode($request->input('assessors'), true));
        
        //return response()->json($newAssessor);
        
        foreach($newAssessor as $key => $value) {
            $projectAssessor = new ProjectAssessor;
            $projectAssessor->project_id = $id;
            $projectAssessor->user_id = $value->id;
            $projectAssessor->touch();
            $projectAssessor->save();
        }
        
    }
    


}
