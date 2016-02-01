<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistoryDownload extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    
    public function document() {
        return $this->morphTo();
    }
}
