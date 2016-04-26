<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\GroupJob;
use App\GroupJobDetail;
use Response;
class GroupJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return  Response::json(GroupJob::get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $groupJob = new GroupJob;
        $groupJob->name = $request->input('name');
        $groupJob->description = $request->input('description');
        $groupJob->touch();
        $groupJob->save();

        foreach ($request->input('jobs') as $key => $value) {
            $groupJobDetail = new GroupJobDetail;
            $groupJobDetail->group_job_id = $groupJob->id;
            $groupJobDetail->job_id = $value['id'];
            $groupJobDetail->touch();
            $groupJobDetail->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return GroupJob::with('jobs.department.university')->find($id);

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
        $groupjob = GroupJob::find($id);
        $groupjob->name = $request->input('name');
        $groupjob->description = $request->input('description');
        $groupjob->touch();
        $groupjob->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $groupjob = GroupJob::find($id);
        $groupjob->delete();
    }

    public function validatingName(Request $request)
    {
        if ($request->input('id')) {
            return GroupJob::where('name', '=', $request->input('name'))
                ->where('id', '<>', $request->input('id'))
                ->get();
        } else {
            return GroupJob::where('name', '=', $request->input('name'))
                ->get();    
        }
    }

    public function jobs ($id) 
    {
        $job = GroupJob::with('jobs')->find($id);
        return Response::json($job, $status=200, $header=[], $option=JSON_PRETTY_PRINT);
    }
    
    
    public function users () {
        
         $groupJob = GroupJob::with('jobs.users')->get();
         
         $groupJobUsers = [];
         foreach($groupJob as $key => $value) {
             $value->search_type = 'Group Jobs';
             
             foreach($value->jobs as $key1 => $value1) {
                 
                 foreach($value1->users as $key2 => $value2) {
                     unset($value2->pivot);
                     array_push($groupJobUsers, $value2);
                 }
                 //array_push($groupJobUsers, $value1->users);
             }
             $value->users = $groupJobUsers;
             
             unset($value->jobs);
         }
         
         $groupJob = json_decode(json_encode($groupJob), true);
         
         return response()->json($groupJob);
    }
    
}
