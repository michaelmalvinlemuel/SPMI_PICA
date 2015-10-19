<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function forms()
    {
    	return $this->morphMany('App\ProjectForm', 'project');
    }

    public function roots()
    {
    	return $this->morphMany('App\ProjectRoot', 'project');
    }
}
