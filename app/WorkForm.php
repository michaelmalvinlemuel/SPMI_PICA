<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkForm extends Model
{
	use SoftDeletes;

    protected $dates = ['deleted_at'];
    

    public function work() {
    	return $this->belongsTo('App\Work');
    }

    public function form() {
    	return $this->belongsTo('App\Form');
    }

    public function task() {
    	return $this->hasOne('App\Task');
    }

    public function forms() {
        return $this->belongsToMany('App\Form', 'work_forms', 'id');
    }
}
