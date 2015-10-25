<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectNodeDelegation extends Model
{
    use SoftDeletes;

    //const UPDATED_AT = 'project_node_delegations.updated_at';

    protected $dates = ['deleted_at'];

    protected $touches = ['projects'];

    public function projects() {
    	return $this->belongsTo('App\ProjectNode');
    }
}
