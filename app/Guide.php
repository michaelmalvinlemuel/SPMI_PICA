<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Guide extends Model
{
	use SoftDeletes;

    protected $dates = ['deleted_at'];
    

    public function StandardDocument() {
    	return $this->belongsTo('App\StandardDocument');
    }
    
    public function instructions() {
    	return $this->hasMany('App\Instruction');
    }
}
