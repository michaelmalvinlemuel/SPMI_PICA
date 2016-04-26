<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssignmentTemplate extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    public function creator() {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function recipients() {
        return $this->hasMany('App\AssignmentRecipient', 'assignment_template_id');
    }
    
    public function attachments() {
        return $this->hasMany('App\AssignmentAttachmentTemplate', 'assignment_template_id');
    }
    
    public function users() {
        return $this->belongsToMany('App\User', 'assignment_recipients');
    }
}
