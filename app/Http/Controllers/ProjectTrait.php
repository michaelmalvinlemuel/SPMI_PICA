<?php

namespace App\Http\Controllers;

use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\Project;
use App\ProjectNode;

trait ProjectTrait {

    public function findRoot($node) {
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
}