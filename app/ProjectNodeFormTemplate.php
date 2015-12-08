<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectNodeFormTemplate extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    
    public function projects() {
        return $this->morphMany('App\ProjectNodeTemplate', 'project_template');
    }
    
    public function forms() {
        return $this->hasMany('App\ProjectNodeFormItemTemplate');
    }
    
    public function projectNode() {
        return $this->belongsTo('App\ProjectNodeTemplate', 'project_node_template_id');
    }
}
