<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectTemplate extends Model
{
    use SoftDeletes;
    
    protected $table = 'project_templates';
    protected $dates = ['deleted_at'];
    
    public function projects() {
        return $this->morphMany('App\ProjectNodeTemplate', 'project_template');
    }
}
