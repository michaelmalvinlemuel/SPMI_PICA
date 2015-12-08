<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectNodeTemplate extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    
    public function project_template() {
        return $this->morphTo();
    }
    
    public function projects() {
        return $this->morphMany('App\ProjectNodeTemplate', 'project_template');
    }
    
    public function forms() {
        return $this->hasOne('App\ProjectNodeFormTemplate');
    }
}
