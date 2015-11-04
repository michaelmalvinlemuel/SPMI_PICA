<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    
    public static $snakeAttributes = false;
    
    use Authenticatable, Authorizable, CanResetPassword, SoftDeletes;
    
    //const updated_at = 'users.updated_at';
    public $timestamps = true;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */

    protected $dates = ['deleted_at'];

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function userJobs() {
        return $this->hasMany('App\UserJob');
        //return $this->hasManyThrough('App\UserJob', 'App\Job');
    }

    public function task ()
    {
        return $this->hasMany('App\Task');
    }

    public function jobs() {
        return $this->belongsToMany('App\Job', 'user_jobs', 'user_id', 'job_id')->withTimestamps()->whereNull('user_jobs.deleted_at');
    }
}
