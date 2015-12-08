<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectNodeFormItemTemplate extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    
    public function projectForm() {
        return $this->belongsTo('App\ProjectNodeFormTemplate');
    }
    
    public function form() {
        return $this->belongsTo('App\Form');
    }
}
