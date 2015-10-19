<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskWork extends Model
{
	protected $table ='task_works';

	/*
    public function tasks() {
    	// $this->hasMany('App\WorkForm', 'work_id', 'work_id');
    	return $this->hasManyThrough('App\Task', 'App\WorkForm', 'work_id', 'work_form_id');

    }*/

    public function tasks() {
    	return $this->hasMany('App\TaskForm', 'batch_id', 'batch_id');
    }
}
