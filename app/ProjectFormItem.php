<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectFormItem extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function uploads() {
    	return $this->hasMany('App\ProjectFormUpload');
    }
}
