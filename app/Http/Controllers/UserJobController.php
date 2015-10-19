<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
    public function store(Request $request)
    {
        $userjob = new UserJob;
        $userjob->user_id = $request->input('user_id');
        $userjob->job_id = $request->input('job_id');
        $userjob->touch();
        $userjob->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return UserJob::with('job.department.university')->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        $userjob = UserJob::find($request->input('id'));
        $userjob->user_id = $request->input('user_id');
        $userjob->job_id = $request->input('job_id');
        $userjob->touch();
        $userjob->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $userjob = UserJob::find($request->input('id'));
        $userjob->delete();
    }

    public function validatingJob(Request $request)
    {
        if ($request->input('id')) {
            return UserJob::where('job_id', '=', $request->input('job_id'))
                ->where('user_id', '=', $request->input('user_id'))
                ->where('id', '<>', $request->input('id'))
                ->get();
        } else {
            return UserJob::where('job_id', '=', $request->input('job_id'))
                ->where('user_id', '=', $request->input('user_id'))
                ->get();    
        }
    }
}
