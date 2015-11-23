<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectNode extends Model
{

	use SoftDeletes;

    //const UPDATED_AT = 'project_nodes.updated_at';

    protected $dates = ['deleted_at'];

    public function project() {
    	return $this->morphTo();
    }

    public function projects() {
        return $this->morphMany('App\ProjectNode', 'project');
    }

    public function delegations() {
    	return $this->belongsToMany('App\User', 'project_node_delegations')
            ->whereNull('project_node_delegations.deleted_at');
    }

    public function forms() {
        return $this->hasOne('App\ProjectForm');
    }
}
