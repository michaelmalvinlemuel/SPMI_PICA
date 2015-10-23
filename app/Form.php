<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Form extends Model
{
	use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    public function instruction() {
    	return $this->belongsTo('App\Instruction');

    }

    public function works() {
    	return $this->belongsToMany('App\Work')->whereNull('work_forms.deleted_at');
    }
}
