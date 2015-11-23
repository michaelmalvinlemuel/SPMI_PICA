<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectFormScore extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function users(){
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
