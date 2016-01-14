<?php

use Illuminate\Database\Seeder;

use App\Foundation;
use App\University;
use App\Department;
use App\Job;
use App\GroupJob;
use App\GroupJobDetail;

class HierarchyDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        include('spmilaravel (7).php');

        DB::table('foundations')->delete();
        Foundation::insert($foundations);

        DB::table('universities')->delete();
        University::insert($universities);

        DB::table('departments')->delete();
        Department::insert($departments);

        DB::table('jobs')->delete();
        Job::insert($jobs);
    }
}
