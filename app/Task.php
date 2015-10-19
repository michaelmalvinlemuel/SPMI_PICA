<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Task extends Model
{
	use SoftDeletes;

    protected $dates = ['deleted_at'];
    

    public function workDetail() {
    	return $this->belongsTo('App\WorkDetail');
    }

    public function job() {
    	return $this->belongsTo('App\Job');
    }
}
