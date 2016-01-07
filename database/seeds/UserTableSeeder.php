<?php



use Illuminate\Database\Seeder;

use App\User;
use App\UserJob;
use App\Job;
use App\GroupJob;
use App\GroupJobDetail;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        include('spmilaravel (4).php');
        
        DB::table('users')->delete();
        User::insert($users);

        DB::table('user_jobs')->delete();
        UserJob::insert($user_jobs);


        DB::table('group_jobs')->delete();
        GroupJob::insert($group_jobs);

        DB::table('group_job_details')->delete();
        GroupJobDetail::insert($group_job_details);
    }
}
