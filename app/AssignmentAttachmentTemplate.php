<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssignmentAttachmentTemplate extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    public function delegations() {
        return $this->hasMany('App\AssignmentDelegation');
    }
    
}
