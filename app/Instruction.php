<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Instruction extends Model
{
	use SoftDeletes;

    protected $dates = ['deleted_at'];
    

    public function guide() {
    	return $this->belongsTo('App\Guide');
    }
    
    public function forms() {
    	return $this->hasMany('App\Form');
    }
}
