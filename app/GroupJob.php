<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class GroupJob extends Model
{
	use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    public function groupJobDetail () {
    	return $this->hasMany('App\GroupJobDetail');
    }

    public function jobs() {
    	return $this->belongsToMany('App\Job', 'group_job_details');
    }

    public function works() {
    	return $this->hasMany('App\Work');
    }


}
