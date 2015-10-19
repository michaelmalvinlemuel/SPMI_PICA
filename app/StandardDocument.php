<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class StandardDocument extends Model
{
	use SoftDeletes;

    protected $dates = ['deleted_at'];
    

    public function standard() {
    	return $this->belongsTo('App\Standard');
    }
}
