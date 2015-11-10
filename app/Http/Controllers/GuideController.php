<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Guide;
use DB;

class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Guide::with('StandardDocument.standard')->get();
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        

        $guide = new Guide;
        $guide->standard_document_id = $request->input('standard_document_id');
        $guide->no = $request->input('no');
        $guide->date = $request->input('date');
        $guide->description = $request->input('description');
        $guide->document = $request->input('filename');

        $guide->touch();
        $guide->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Guide::with('StandardDocument.standard')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
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
        $guide = Guide::find($id);
        $guide->standard_document_id = $request->input('standard_document_id');
        $guide->no = $request->input('no');
        $guide->date = $request->input('date');
        $guide->description = $request->input('description');

        if ($request->input('filename')) {
            $guide->document = $request->input('filename');
        }

        $guide->touch();
        $guide->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $guide = Guide::find($id);
        $guide->delete();
    }

    public function standarddocument ($id) {
        return Guide::with('StandardDocument.standard')->where('standard_document_id', '=', $id)->get();
    }

    public function validatingNo($no, $id=false)
    {
        if ($id) {
            return Guide::where('no', '=', $no)
                ->where('id', '<>', $id)
                ->get();
        } else {
            return Guide::where('no', '=', $no)
                ->get();    
        }
    } 

    public function validatingDescription($description, $id=false)
    {
        if ($id) {
            return Guide::where('description', '=', $description)
                ->where('id', '<>', $id)
                ->get();
        } else {
            return Guide::where('description', '=', $description)
                ->get();    
        }
    }
}
