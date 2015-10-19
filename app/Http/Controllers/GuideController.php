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
        
        $filename = $request->file('document')->getClientOriginalName();
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $filename = basename($request->input('description'), "." . $ext);
        $filename = strtoupper(preg_replace('/\s+/', '', $filename . "_" . date("YmdHis")))  . "." . $ext;
        $upload = $request->file('document')->move(env('APP_UPLOAD') . '\guide', $filename);

        $guide = new Guide;
        $guide->standard_document_id = $request->input('standard_document_id');
        $guide->no = $request->input('no');
        $guide->date = $request->input('date');
        $guide->description = $request->input('description');
        $guide->document = $filename;

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
    public function update(Request $request)
    {
        $guide = Guide::find($request->input('id'));
        $guide->standard_document_id = $request->input('standard_document_id');
        $guide->no = $request->input('no');
        $guide->date = $request->input('date');
        $guide->description = $request->input('description');

        if ($request->file('document')) {
            $filename = $request->file('document')->getClientOriginalName();
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $filename = basename($request->input('description'), "." . $ext);
            $filename = strtoupper(preg_replace('/\s+/', '', $filename . "_" . date("YmdHis")))  . "." . $ext;
            $upload = $request->file('document')->move(env('APP_UPLOAD') . '\guide', $filename);
            $guide->document = $filename;
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
    public function destroy(Request $request)
    {
        $guide = Guide::find($request->input('id'));
        $guide->delete();
    }

    public function standarddocument ($id) {
        return Guide::with('StandardDocument')->where('standard_document_id', '=', $id)->get();
    }

    public function validatingNo(Request $request)
    {
        if ($request->input('id')) {
            return Guide::where('no', '=', $request->input('no'))
                ->where('id', '<>', $request->input('id'))
                ->get();
        } else {
            return Guide::where('no', '=', $request->input('no'))
                ->get();    
        }
    } 

    public function validatingDescription(Request $request)
    {
        if ($request->input('id')) {
            return Guide::where('description', '=', $request->input('description'))
                ->where('id', '<>', $request->input('id'))
                ->get();
        } else {
            return Guide::where('description', '=', $request->input('description'))
                ->get();    
        }
    }
}
