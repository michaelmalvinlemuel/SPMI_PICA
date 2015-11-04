<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class UserJob extends Model
{
	use SoftDeletes;
    
    //const updated_at = 'user_jobs.updated_at';
    
    protected $table = 'user_jobs';
    
    protected $hidden = ['pivot'];
    
    protected $dates = ['deleted_at'];
    

    public function job() {
    	return $this->belongsTo('App\Job');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
