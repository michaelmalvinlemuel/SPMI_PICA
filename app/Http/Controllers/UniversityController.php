<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\University;
use Response;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {   
        $university = University::get();
        return response()->json($university, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $university = new University;
        $university->name = $request->input('name');
        $university->address = $request->input('address');
        $university->phone = $request->input('phone');
        $university->fax = $request->input('fax');
        $university->touch();
        $university->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return University::find($id);
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
        $university = University::find($id);
        $university->name = $request->input('name');
        $university->address = $request->input('address');
        $university->phone = $request->input('phone');
        $university->fax = $request->input('fax');
        $university->touch();
        $university->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $university = University::find($id);
        $university->delete();
    }

    public function validating (Request $request)
    {
        if ($request->input('id')) {
            return University::where('name', '=', $request->input('name'))->where('id', '<>', $request->input('id'))->get();
        } else {
            return University::where('name', '=', $request->input('name'))->get();    
        }
        
    }
}
