<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProjectController;

use App\Project;
use App\ProjectNode;
use App\ProjectForm;
use App\ProjectFormScore;
use App\ProjectNodeDelegation;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ProjectNodeController extends ProjectController
{

    
    private function findRoot($node) {
        $projectNode = ProjectNode::find($node->project_id);
        
        if ($projectNode) {
            if ($projectNode->project_type == 'App\Project') {
                return Project::with('assessors')->with('leader')->find($projectNode->project_id);
            } else {
                //if (isset($this->findRoot)) {
                    return $this->findRoot($projectNode);
                //}
            }
        } else {
            return Project::with('assessors')->with('leader')->find($node->project_id);
        }
            
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
     
    
    private function transposeAssessor ($node, &$result, $user) {
        
        
            
            $projectNode = ProjectNode::where('project_id', '=', $node->id)->where('project_type', '<>', 'App\Project')
                ->with('assessors')->get(); 
            
            
            if (count($projectNode) > 0) {
                
                $counter = 0;
                foreach($projectNode as $key => $value) {
                    $counter++;
                    $value->numbering = $node->numbering . $counter . '.';
                    $this->transposeAssessor($value, $result, $user);
                }
                $node['children'] = $projectNode;
                
            } else {
                
                foreach($node->assessors as $key => $value) {
                    
                    if ($value->id == $user->id) {
                        $projectForm = ProjectForm::where('project_node_id', '=', $node->id)->with(['scores' => function($query) {
                            $query->orderBy('created_at', 'DESC')->first();
                        }])->where('lock', '<>', '0')->first();
                        if ($projectForm) {
                            $node['weight'] = $projectForm->weight;
                            $node['lock'] = $projectForm->lock;
                            $node['score'] = $projectForm->scores;
                            array_push($result, $node);
                            break;
                        }
                        
                    }
                    
                   
                    
                }
                
                
                    
                
            }
        
        

        
    } 
     
    /**
      * Show All Project Node form only within project
      */
    
    public function form($id) {
        
        $user = JWTAuth::parseToken()->authenticate();
        $project = Project::with('projects')->with('assessors')->with('users')->find($id);
        
        
        
        
        $result = [];
        //$assessors = [];
        
        $counter = 0;
        foreach($project->projects as $key => $value) {
            $counter++;
            $value->numbering = $counter . '.';
            $this->transposeAssessor($value, $result, $user);
        }
        
        $response = Project::with('assessors')->with('users')->find($id);
        foreach ($response->users as $key => $value) {
            if ($response->user_id == $value->id) {
                $response->users[$key]['leader'] = true;
            } else {
                $response->users[$key]['leader'] = false;
            }
        }
        $response->projects = $result;
        
        return response()->json($response);
        
    }
    
    
    /**
     * Delegate node for some user 
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


    public function lockChildren($node, $lockStatus) {

        foreach($node as $key => $value) {
            $projectForm = ProjectForm::where('project_node_id', '=', $value->id)->first();
            
            if ($projectForm) {
                $projectForm->lock = $lockStatus;
                $projectForm->touch();
                 $projectForm->save();

            } else {
                $projectNode = ProjectNode::with('projects')->where('project_id', '=', $value->id)->where('project_type', '=', 'App\ProjectNode')->get();
                $this->lockChildren($projectNode, $lockStatus);
            }
        }

    }

    /**
     * Uses for locking or unlocking node of project where used befor assessment
     *
     * @return \Illuminate\Http\Response
     */
    public function lock($id, $lockStatus) {
        

        $projectForm = ProjectForm::where('project_node_id', '=', $id)->first();

        if (isset($projectForm->lock)) {
            $projectForm->lock = $lockStatus;
            $projectForm->touch();
            $projectForm->save();
        } else {
            $projectNode = ProjectNode::with('projects')->find($id);
            $this->lockChildren($projectNode->projects, $lockStatus);
        }
        

    }

    /**
     * Selection for get assessment history
     *
     */

    public function assess($nodeId) {

        

        $projectNode = ProjectNode::with('delegations')
            ->with(['forms' => function($query) {
                $query->with(['forms' => function($query2) {
                    $query2->with('form')->with(['upload' => function($query3) {
                        $query3->with('users')->with('attachments');
                    }]);
                }])->with('scores.users');
            }])->find($nodeId);

        $projectNode->root = $this->findRoot($projectNode);

        //unset($projectNode->root->assessors);
        return response()->json($projectNode);

    }

    /**
     * Used for attempt score for end node of the project
     *
     */

    public function score(Request $request) {
        
        
        $user = JWTAuth::parseToken()->authenticate();

        $projectScore = new ProjectFormScore;
        $projectScore->project_form_id = $request->input('project_form_id');
        $projectScore->user_id = $user->id;
        $projectScore->score = $request->input('score');
        $projectScore->description = $request->input('description');
        $projectScore->touch();
        $projectScore->save();
        
        $projectScore->users = $user;
        return response()->json( $projectScore);
    }
}
