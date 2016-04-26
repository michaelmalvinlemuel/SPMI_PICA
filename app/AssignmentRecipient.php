<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssignmentRecipient extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    public function delegations() {
        return $this->hasMany('App\AssignmentDelegation');
    }
    
     public function user() {
        return $this->belongsTo('App\User');
    }
    
    
    public function assignment() {
        return $this->belongsTo('App\AssignmentTemplate', 'assignment_template_id');
    }
    
    
  
}
