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
    
    public function scopeProgress($query, $userId, $jobId) {
        
        return $query->orWhere(function($query) use ($userId, $jobId) {
            $currentDate = date("Y-m-d H:i:s");
            $query->where('user_id', '=', $userId)->where('job_id', '=', $jobId)
            ->where('status', '=', 1)->where('expired_at', '>=', $currentDate);
        });
    }
    
    public function scopeOverdue($query, $userId, $jobId) {
        return $query->orWhere(function($query) use ($userId, $jobId) {
            $currentDate = date("Y-m-d H:i:s");
            $query->where('user_id', '=', $userId)->where('job_id', '=', $jobId)
            ->where('status', '=', 1)->where('expired_at', '<', $currentDate);
        });
    }
    
    public function scopeComplete($query, $userId, $jobId) {
        return $query->orWhere(function($query) use ($userId, $jobId) {
            $query->where('user_id', '=', $userId)->where('job_id', '=', $jobId)
            ->where('status', '=', 2);
        });
    }
}
