<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class University extends Model
{
	use SoftDeletes;

    protected $dates = ['deleted_at'];
    

    public function department() {
    	return $this->hasMany('App\Department');
    }

    public function job() {
    	return $this->hasManyThrough('App\Job', 'App\Department');
    }
}
