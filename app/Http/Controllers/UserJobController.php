<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Response;

use App\UserJob;
use App\Job;
use App\Department;
use App\university;

class UserJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id)
    {
        return UserJob::where('user_id', '=', $id)
            ->with('job.department.university')
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request, $userId)
    {
        $userJob = UserJob::where('user_id', '=', $userId)->where('job_id', '=', $request->input('id'))->get();
        if(count($userJob) > 0) 
        return Response::json(
            [
                'title' => 'Unique User Job Exception',
                'body' => 'Setiap job yang dimiliki oleh user harus unik'
            ], 500);
        
        $userJob = new UserJob;
        $userJob->user_id = $userId;
        $userJob->job_id = $request->input('id');
        $userJob->touch();
        $userJob->save();
        
        $job = Job::with('department.university')->find($userJob->job_id);
        return Response::json($job);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $userId, $jobId)
    {
        $id = UserJob::where('user_id', '=', $userId)->where('job_id', '=', $request->input('id'))->get(['id']);
        if(count($id) > 0) 
        return Response::json(
            [
                'title' => 'Unique User Job Exception',
                'body' => 'Setiap job yang dimiliki oleh user harus unik'
            ], 500);
        
        $userJob = UserJob::where('user_id', '=', $userId)->where('job_id', '=', $jobId)->first();
        $userJob->job_id = $request->input('id');
        $userJob->touch();
        $userJob->save();
        
        $job = Job::with('department.university')->find($request->input('id'));
        return Response::json($job);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($userId, $jobId)
    {
        $userJob = UserJob::where('user_id', '=', $userId)->where('job_id', '=', $jobId);
        $userJob->delete();
    }
}
