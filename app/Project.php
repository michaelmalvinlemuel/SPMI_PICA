<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    //const UPDATED_AT = 'projects.updated_at';

    public function projects() {
        return $this->morphMany('App\ProjectNode', 'project');
    }

    public function users() {
    	return $this->belongsToMany('App\User', 'project_users')->whereNull('project_users.deleted_at');
    }

    public function projectUsers() {
        return $this->hasMany('App\ProjectUser');
    }

    public function leader() {
    	return $this->belongsTo('App\User', 'user_id');
    }

}
