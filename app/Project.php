<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    
    protected $table ='projects';
    
    protected $dates = ['deleted_at'];
    
    //const UPDATED_AT = 'projects.updated_at';

    public function projects() {
        return $this->morphMany('App\ProjectNode', 'project');
    }

    public function users() {
    	return $this->belongsToMany('App\User', 'project_users')
            ->whereNull('project_users.deleted_at');
    }
    
    public function assessors() {
        return $this->belongsToMany('App\User', 'project_assessors')
            ->whereNull('project_assessors.deleted_at');
    }
    
    //used for deleting project member via table
    public function projectUsers() {
        return $this->hasMany('App\ProjectUser');
    }
    
    //used for deleting project assessor via table
    public function projectAssessors() {
        return $this->hasMany('App\ProjectAssessor');
    }

    public function leader() {
    	return $this->belongsTo('App\User', 'user_id');
    }
    
    public function scopeInitiation($query) {
        return $query->orWhere(function($query) {
           $currentDate = date("Y-m-d");
           $query->where('status', '=', '0')->whereNull('deleted_at'); 
        });
    }
    
    public function scopePreparation($query) {
        return $query->orWhere(function($query) {
            $currentDate = date("Y-m-d");
            $query->where('status', '=', '1')->where('date_start', '>', $currentDate)
            ->whereNull('deleted_at');
        });
    }
    
    public function scopeProgress($query) {
        return $query->orWhere(function($query) {
            $currentDate = date("Y-m-d");
            $query->where('status', '=', '1')->where('date_start', '<=', $currentDate)
            ->where('date_ended', '>=', $currentDate)->whereNull('deleted_at');
        });
    }
    
    public function scopeGrading($query) {
        return $query->orWhere(function($query) {
            $currentDate = date("Y-m-d");
            $query->where('status', '=', '1')->where('date_ended', '<', $currentDate)
            ->whereNull('deleted_at');
        });
    }
    
    public function scopeComplete($query) {
        return $query->orWhere(function($query) {
            $currentDate = date("Y-m-d");
            $query->where('status', '=', '2')->whereNull('deleted_at');
        });
    }
    
    public function scopeTerminated($query) {
        return $query->orWhere(function($query) {
           $currentDate = date("Y-m-d");
           $query->where('status', '=', '3')->whereNull('deleted_at'); 
        });
    }
    
    
    
    public function scopeUserInitiation($query, $user) {
        return $query->orWhere(function($query) use($user) {
           $currentDate = date("Y-m-d");
           $query->whereHas('projectUsers', function($query) use($user) {
                $query->where('user_id', '=', $user->id);
            })->where('status', '=', '0')->whereNull('deleted_at'); 
        })->orWhere(function($query) use ($user) {
            $currentDate = date("Y-m-d");
            $query->whereHas('projectAssessors', function($query) use($user) {
                $query->where('user_id', '=', $user->id);
            });
        });
    }
    
    public function scopeUserPreparation($query, $user) {
        return $query->orWhere(function($query) use($user) {
            $currentDate = date("Y-m-d");
            $query->whereHas('projectUsers', function($query) use($user) {
                $query->where('user_id', '=', $user->id);
            })->where('status', '=', '1')->where('date_start', '>', $currentDate)
                ->whereNull('deleted_at');
        })->orWhere(function($query) use($user) {
            $currentDate = date("Y-m-d");
            $query->whereHas('projectAssessors', function($query) use($user) {
                $query->where('user_id', '=', $user->id);
            })->where('status', '=', '1')->where('date_start', '>', $currentDate)
                ->whereNull('deleted_at');
        });
    }
    
    public function scopeUserProgress($query, $user) {
        return $query->orWhere(function($query) use($user) {
            $currentDate = date("Y-m-d");
            $query->whereHas('projectUsers', function($query) use($user) {
                $query->where('user_id', '=', $user->id);
            })->where('status', '=', '1')->where('date_start', '<=', $currentDate)
            ->where('date_ended', '>=', $currentDate)->whereNull('deleted_at');
        })->orWhere(function($query) use($user) {
            $currentDate = date("Y-m-d");
            $query->whereHas('projectAssessors', function($query) use($user) {
                $query->where('user_id', '=', $user->id);
            })->where('status', '=', '1')->where('date_start', '<=', $currentDate)
            ->where('date_ended', '>=', $currentDate)->whereNull('deleted_at');
        });
    }
    
    public function scopeUserGrading($query, $user) {
        return $query->orWhere(function($query) use($user) {
            $currentDate = date("Y-m-d");
            $query->whereHas('projectUsers', function($query) use($user) {
                $query->where('user_id', '=', $user->id);
            })->where('status', '=', '1')->where('date_ended', '<', $currentDate)
            ->whereNull('deleted_at');
        })->orWhere(function($query) use($user) {
            $currentDate = date("Y-m-d");
            $query->whereHas('projectAssessors', function($query) use($user) {
                $query->where('user_id', '=', $user->id);
            })->where('status', '=', '1')->where('date_ended', '<', $currentDate)
            ->whereNull('deleted_at');
        });
    }
    
    public function scopeUserComplete($query, $user) {
        return $query->orWhere(function($query) use($user) {
            $currentDate = date("Y-m-d");
            $query->whereHas('projectUsers', function($query) use($user) {
                $query->where('user_id', '=', $user->id);
            })->where('status', '=', '2')->whereNull('deleted_at');
        })->orWhere(function($query) use($user) {
            $currentDate = date("Y-m-d");
            $query->whereHas('projectAssessors', function($query) use($user) {
                $query->where('user_id', '=', $user->id);
            })->where('status', '=', '2')->whereNull('deleted_at');
        });
    }
    
    public function scopeUserTerminated($query, $user) {
        return $query->orWhere(function($query) use($user) {
           $currentDate = date("Y-m-d");
           $query->whereHas('projectUsers', function($query) use($user) {
                $query->where('user_id', '=', $user->id);
            })->where('status', '=', '3')->whereNull('deleted_at'); 
        })->orWhere(function($query) use($user) {
           $currentDate = date("Y-m-d");
           $query->whereHas('projectAssessors', function($query) use($user) {
                $query->where('user_id', '=', $user->id);
            })->where('status', '=', '3')->whereNull('deleted_at'); 
        });
    }

}
