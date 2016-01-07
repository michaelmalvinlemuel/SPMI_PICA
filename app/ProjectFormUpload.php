<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectFormUpload extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    public function users() {
    	return $this->belongsTo('App\User', 'user_id');
    }
	
	public function attachments() {
		return $this->hasMany('App\ProjectFormUploadAttachment');
	}
}
