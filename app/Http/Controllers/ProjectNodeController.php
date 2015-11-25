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

        if($projectNode) {
            if ($projectNode->project_type == 'App\Project') {
                return Project::with('assessors')->with('leader')->find($projectNode->project_id);
            } else {
                if (isset($this->findRoot)) {
                    $this->findRoot($projectNode);
                }
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

    /**
     * Uses for locking or unlocking node of project where used befor assessment
     *
     * @return \Illuminate\Http\Response
     */
    public function lock($id) {
        

        $lockingStatus = 0;
        $projectNode = ProjectNode::find($id);
        if ($projectNode->status == '0') {
            $projectNode->status = '1';
            $lockingStatus = 1;
        } else {
            $projectNode->status = '0';
            $lockingStatus = 0;
            $this->bubblingUnlock($projectNode);
        }
        $projectNode->touch();
        $projectNode->save();
        
        //inherit locking system,
        $this->recursiveLocking($projectNode->projects, $lockingStatus);
        
    }

    /**
     * Selection for get assessment history
     *
     */

    public function assess($nodeId) {

        

        $projectNode = ProjectNode::with('delegations')
            ->with(['forms' => function($query) {
                $query->with(['forms' => function($query2) {
                    $query2->with('form')->with('upload.users');
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
