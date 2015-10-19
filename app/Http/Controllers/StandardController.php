<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Standard;

use Auth;

class StandardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */


    public function index()
    {
        return Standard::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {   
        if (Auth::check()) {
            $standard = new Standard;
            $standard->description = $request->input('description');
            $standard->date = $request->input('date');
            $standard->touch();
            $standard->save(); 
        } else {
            return Response::json(['title' => 'Error', 'message' => 'Authentication failed'], 403);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        return Standard::find($id);
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
        $standard = Standard::find($request->input('id'));
        $standard->description = $request->input('description');
        $standard->date = $request->input('date');
        $standard->touch();
        $standard->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $standard = Standard::find($request->input('id'));
        $standard->delete();
    }

    public function validating(Request $request)
    {
        if ($request->input('id')) {
            return Standard::where('description', '=', $request->input('description'))
                ->where('id', '<>', $request->input('id'))
                ->get();
        } else {
            return Standard::where('description', '=', $request->input('description'))
                ->get();    
        }
    }
}
