<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRegistration extends Model
{
	use SoftDeletes;
	
    protected $dates = ['expired_at', 'created_at', 'updated_at', 'deleted_at'];
}
