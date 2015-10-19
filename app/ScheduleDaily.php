<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ScheduleDaily extends Model
{
	use SoftDeletes;

    protected $dates = ['deleted_at'];
    

    public function works() {
    	return $this->morphMany('App\Work', 'schedule');
    }

    public function days() {
    	return $this->hasMany('App\ScheduleDailyDay');
    }
}
