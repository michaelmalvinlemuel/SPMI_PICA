<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Standard extends Model
{
	use SoftDeletes;

    protected $dates = ['deleted_at'];
    

    public function standardDocuments() {
		return $this->hasMany('App\StandardDocument');
	}
}
