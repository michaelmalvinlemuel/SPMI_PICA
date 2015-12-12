<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Job;
use Response;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Job::with('department.university')->with('job')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $job = new Job;
        $job->department_id = $request->input('department_id');
        $job->name = $request->input('name');
        $job->job_id = $request->input('job_id');
        $job->multiple = $request->input('multiple') ? $request->input('multiple') : false;
        $job->touch();
        $job->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Job::with('department.university')->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $job = Job::find($request->input('id'));
        $job->department_id = $request->input('department_id');
        $job->name = $request->input('name');
        $job->job_id = $request->input('job_id');
        $job->multiple = $request->input('multiple');
        $job->touch();
        $job->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $job = Job::find($id);
        $job->delete();
    }

    public function university($id) 
    {
        //return Job::with(array('department' => function ($q) {
        //    $q->where('id', '=', 2);
        //}))->get();

        return Job::with('department')->whereHas('department', function($query) use ($id) {
            $query->where('university_id', '=', $id);
        })->with('job')->get();
    }

    public function department($id) {
        return Job::where('department_id', '=', $id)->with('department.university')->get();
    }

    public function validating(Request $request)
    {
        if ($request->input('id')) {
            return Job::where('name', '=', $request->input('name'))
                ->where('id', '<>', $request->input('id'))
                ->where('department_id', '=', $request->input('department_id'))
                ->get();
        } else {
            return Job::where('name', '=', $request->input('name')
                ->where('department_id', '=', $request->input('department_id')
                ->get();    
        }
    }

    public function users ($id)
    {
        $user = Job::with('users')->find($id);
        return Response::json($user, 200, [], JSON_PRETTY_PRINT);
    }

    public function subs ($id) {
        $jobs = Job::where('job_id', '=', $id)->with('users')->get();
        return Response::json($jobs, 200, [], JSON_PRETTY_PRINT);
    }

}
