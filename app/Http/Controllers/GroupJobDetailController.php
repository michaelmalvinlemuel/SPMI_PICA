<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\GroupJobDetail;

class GroupJobDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id)
    {
        return GroupJobDetail::where('group_job_id', '=', $id)->with('job.department.university')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $groupjobdetail = new GroupJobDetail;
        $groupjobdetail->group_job_id = $request->input('group_job_id');
        $groupjobdetail->job_id = $request->input('job_id');
        $groupjobdetail->touch();
        $groupjobdetail->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return GroupJobDetail::find($id);
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
        $groupJobDetail = GroupJobDetail::find($request->input('id'));
        $groupJobDetail->group_job_id = $request->input('group_job_id');
        $groupJobDetail->job_id = $request->input('job_id');
        $groupJobDetail->touch();
        $groupJobDetail->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $groupjobdetail = GroupJobDetail::find($request->input('id'));
        $groupjobdetail->delete();
    }

    public function university ($group_job_id, $university_id) 
    {
        return GroupJobDetail::with('job.department')->where('group_job_id', '=', $group_job_id)
            ->whereHas('job.department', function ($query) use ($university_id) {
                $query->where('university_id', '=', $university_id);
            })->get();

        /*
        ->whereHas('job.department', function($query) use ($id) {
            $query->where('university_id', '=', $id);
        })->with('job')->get();
        */
    }
}
