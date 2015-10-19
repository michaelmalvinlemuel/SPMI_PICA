<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Department extends Model
{
	use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    public function university() {
    	return $this->belongsTo('App\University');
    }

    public function department() {
    	return $this->belongsTo('App\Department');
    }

    public function job() {
    	return $this->hasMany('App\Job');
    }
}
