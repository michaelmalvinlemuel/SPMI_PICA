<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Job extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    

    public function department() {
    	return $this->belongsTo('App\Department');
    }

    public function job() {
    	return $this->belongsTo('App\Job');
    }

    public function userJobs() {
    	return $this->hasMany('App\UserJob');
    }

    public function groupJobDetail() {
    	return $this->hasMany('App\GroupJobDetail');
    }

    public function task ()
    {
        return $this->hasMany('App\Task');
    }

    public function users() {
        return $this->belongsToMany('App\User', 'user_jobs')->whereNull('user_jobs.deleted_at');
    }

    public function groupJobs () {
        return $this->belongsToMany('App\GroupJob', 'group_job_details')->whereNull('group_job_details');
    }
}
