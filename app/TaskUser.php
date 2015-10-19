<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskUser extends Model
{
	protected $table = 'task_users';

	public function jobs() {
		return $this->hasMany('App\TaskJob', 'user_id', 'user_id');
	}
}
