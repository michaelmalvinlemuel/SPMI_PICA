<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ScheduleSemesterly extends Model
{
	use SoftDeletes;

    protected $dates = ['deleted_at'];
    

    public function works() {
    	return $this->morphMany('App\Work', 'schedule');
    }
}
