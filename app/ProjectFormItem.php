<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectFormItem extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
	
    public function projectForm() {
    	return $this->belongsTo('App\ProjectForm');
    }
    
    public function uploads() {
    	return $this->hasMany('App\ProjectFormUpload');
    }

    public function upload() {
        return $this->hasOne('App\ProjectFormUpload')->latest();
    }
    
    public function form() {
    	return $this->belongsTo('App\Form');
    }
}
