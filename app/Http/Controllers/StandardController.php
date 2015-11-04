<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Standard;
use Response;
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

	public function all() {
		$standard = Standard::with('standardDocuments.guides.instructions.forms')->get();
		return Response::json($standard, 200, [], JSON_PRETTY_PRINT);
		
	}
	
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
    public function update(Request $request, $id)
    {
        $standard = Standard::find($id);
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
    public function destroy($id)
    {
        $standard = Standard::find($id);
        $standard->delete();
    }

    public function validating($description, $id=false)
    {
        if ($id) {
            return Standard::where('description', '=', $description)
                ->where('id', '<>', $id)
                ->get();
        } else {
            return Standard::where('description', '=', $description)
                ->get();    
        }
    }
}
