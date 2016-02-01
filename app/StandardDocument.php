<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class StandardDocument extends Model
{
	use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    public function download() {
        return $this->morphMany('App\HistoryDownload', 'document');
    }
    
    public function standard() {
    	return $this->belongsTo('App\Standard');
    }
    
    public function guides() {
    	return $this->hasMany('App\Guide');
    }
}
