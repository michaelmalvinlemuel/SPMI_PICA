<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class GroupJobDetail extends Model
{
	use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    public function groupJob() {
    	return $this->belongsTo('App\GroupJob');
    }

    public function job() {
    	return $this->belongsTo('App\Job');
    }
    
    public function users() {
        return $this->hasManyThrough('App\Job', 'App\User', '', '');
    }

}
