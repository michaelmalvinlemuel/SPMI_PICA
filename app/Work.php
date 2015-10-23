<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Work extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    


    protected $fillable = ['name', 'description', 'start', 'ended', 'created_at', 'updated_at', 'schedule_id', 'schedule_type'];

    public function period() {
    	return $this->belongsTo('App\Period');
    }

    public function groupJob() {
    	return $this->belongsTo('App\GroupJob');
    }

    public function workForms() {
    	return $this->hasMany('App\WorkForm');
    }

    public function forms() {
        return $this->belongsToMany('App\Form', 'work_forms')->whereNull('work_forms.deleted_at');
    }

    public static function boot()
    {
        parent::boot();

        // Setup event bindings...
    }

    public function schedule() {
    	return $this->morphTo();
    }


}
