<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Department::with('university')->with('department')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $department = new Department;
        $department->university_id = $request->input('university_id');
        $department->name = $request->input('name');
        $department->department_id = $request->input('department_id');
        $department->touch();
        $department->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Department::with('university')->find($id);
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
        $department = Department::find($request->input('id'));
        $department->university_id = $request->input('university_id');
        $department->name = $request->input('name');
        $department->department_id = $request->input('department_id');
        $department->touch();
        $department->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $department = Department::find($request->input('id'));
        $department->delete();
    }

    public function university($id) {
        return Department::where('university_id', '=', $id)->with('university')->get();
    }

    public function validating (Request $request)
    {
        if ($request->input('id')) {
            return Department::where('name', '=', $request->input('name'))
                ->where('id', '<>', $request->input('id'))
                ->where('university_id', '=', $request->input('university_id'))
                ->get();
        } else {
            return Department::where('name', '=', $request->input('name'))
            ->where('university_id', '=', $request->input('university_id'))
            ->get();    
        }
        
    }
}
