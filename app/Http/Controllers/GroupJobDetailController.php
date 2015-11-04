<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\GroupJobDetail;
use App\Job;
class GroupJobDetailController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request, $groupJobId)
    {
        $groupJobDetail = GroupJobDetail::where('group_job_id', $groupJobId)->where('job_id', $request->input('id'))->get();
        if(count($groupJobDetail) > 0)
        return response()->json(
            [
                'title' => 'Unique User Job Exception',
                'body' => 'Setiap job yang dimiliki oleh group harus unik'
            ], 500);
        
        
        
        $groupJobDetail = new GroupJobDetail;
        $groupJobDetail->group_job_id = $groupJobId;
        $groupJobDetail->job_id = $request->input('id');
        $groupJobDetail->touch();
        $groupJobDetail->save();
        
        $job = Job::with('department.university')->find($groupJobDetail->job_id);
        return response()->json($job);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $groupJobId, $jobId)
    {

        $id = GroupJobDetail::where('group_job_id', $groupJobId)->where('job_id', $request->input('id'))->get(['id']);
        if(count($id) > 0) 
        return response()->json(
            [
                'title' => 'Unique User Job Exception',
                'body' => 'Setiap job yang dimiliki oleh user harus unik'
            ], 500);
            
        $groupJobDetail = GroupJobDetail::where('group_job_id', '=', $groupJobId)->where('job_id', '=', $jobId)->first();
        $groupJobDetail->job_id = $request->input('id');
        $groupJobDetail->touch();
        $groupJobDetail->save();
        
        $job = Job::with('department.university')->find($request->input('id'));
        return response()->json($job);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($groupJobId, $jobId)
    {
        $groupJobDetail = GroupJobDetail::where('group_job_id', $groupJobId)->where('job_id', $jobId);
        $groupJobDetail->delete();
    }
}
