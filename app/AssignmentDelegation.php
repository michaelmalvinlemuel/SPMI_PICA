<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssignmentDelegation extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = ['*'];
    
    public function attachment() {
        return $this->belongsTo('App\AssignmentAttachmentTemplate');
    }
    
    public function user() {
        return $this->belongsTo('App\User');
    }
    
   
}
