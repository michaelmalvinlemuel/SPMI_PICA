<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pica extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function picaDetail() {
      return $this->hasMany('App\PicaDetail');
    }

    public function department() {
      return $this->belongsTo('App\Department');
    }

    public function projectNode() {
      return $this->belongsTo('App\ProjectNode');
    }
}
