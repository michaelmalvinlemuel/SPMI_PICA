<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskJob extends Model
{
	protected $table = 'task_jobs';

    public function works () {
    	return $this->hasMany('App\TaskWork', 'job_id', 'job_id');
    }
}
