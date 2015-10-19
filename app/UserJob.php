<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class UserJob extends Model
{
	use SoftDeletes;

    protected $dates = ['deleted_at'];
    

    public function job() {
    	return $this->belongsTo('App\Job');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
