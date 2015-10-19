<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectForm extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function project() {
    	return $this->morphTo();
    }
}
