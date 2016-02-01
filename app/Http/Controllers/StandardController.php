<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Standard;
use App\StandardDocument;
use App\Guide;
use App\Instruction;
use App\Form;

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
    
    public function combination(Request $request, $display, $withStandardDocument
        , $withGuide, $withInstruction, $withForm) 
    {
        $response = [];
        
        if ($withStandardDocument == 'true') {
            $standardDocument = StandardDocument::where('description', 'LIKE', '%' . $request->input('keyword') . '%')->get();
            foreach ($standardDocument as $key => $value) {
                
                $value->type = "s";
                array_push($response, $value);
            }
            
        }
        
        if ($withGuide == 'true') {
            $guide = Guide::where('description', 'LIKE', '%' . $request->input('keyword') . '%')->get();
            foreach($guide as $key => $value) {
                
                $value->type = "g";
                array_push($response, $value);
                
            }
        }
        
        if ($withInstruction == 'true') {
            $instruction = Instruction::where('description', 'LIKE', '%' . $request->input('keyword') . '%')->get();
            foreach($instruction as $key => $value) {
                
                $value->type = "i";
                array_push($response, $value);
                
            }
        }
        
        if ($withForm == 'true') {
            $form = Form::where('description', 'LIKE', '%' . $request->input('keyword') . '%')->get();
            foreach($form as $key => $value) {
                
                $value->type = "f";
                array_push($response, $value);
                
            }
        } 
        
        //return $request->query()['page'];
        $page = $request->query()['page'];
        
        $slice = array_slice($response, $display * ($page - 1), $display);
        
        $paginator = new Paginator($slice, count($response), $display, $page, [
            'path'  => $request->url(),
            'query' => $request->query(),
        ]);
        
        return $paginator;
        
        //return response()->json($response);
        
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
