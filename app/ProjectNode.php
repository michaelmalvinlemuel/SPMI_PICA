<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectNode extends Model
{

	use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function project() {
    	return $this->morphTo();
    }

    public function projects() {
        return $this->morphMany('App\ProjectNode', 'project');
    }

    public function delegations() {
    	return $this->hasMany('App\ProjectNodeDelegation');
    }

    public function forms() {
        return $this->hasOne('App\ProjectForm');
    }
}
