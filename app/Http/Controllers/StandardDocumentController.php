<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\StandardDocument;
use Response;
use Storage;

class StandardDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return StandardDocument::with('standard')->get();
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
        
        $file =  $request->file('file');
        $filename = $file->getClientOriginalName();
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $filename = basename($request->input('description'), "." . $ext);
        $filename = strtoupper(preg_replace('/\s+/', '', $filename . "_" . date("YmdHis")))  . "." . $ext;
        $upload = $file->move(env('APP_UPLOAD') . '/standardDocument', $filename);
        
        $document = new StandardDocument;
        $document->standard_id = $request->input('standard_id');
        $document->no = $request->input('no');
        $document->date = $request->input('date');
        $document->description = $request->input('description');
        $document->document = $filename;
        $document->touch();
        $document->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return StandardDocument::find($id);
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
        
       
        $document = StandardDocument::find($id);
        $document->standard_id = $request->input('standard_id');
        $document->no = $request->input('no');
        $document->date = $request->input('date');
        $document->description = $request->input('description');

        if ($request->file('file')) {
            $filename = $request->file('file')->getClientOriginalName();
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $filename = basename($request->input('description'), "." . $ext);
            $filename = strtoupper(preg_replace('/\s+/', '', $filename . "_" . date("YmdHis")))  . "." . $ext;
            $upload = $request->file('file')->move(env('APP_UPLOAD') . '/standardDocument', $filename);
            $document->document = $filename;
        }
        
        $document->touch();
        $document->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $document = StandardDocument::find($id);
        $document->delete();
    }

    public function standard ($id) {
        return StandardDocument::with('standard')->where('standard_id', '=', $id)->get();
    }

    public function validatingNo($no, $id=false) 
    {
        if ($id) {
            return StandardDocument::where('no', '=', $no)
                ->where('id', '<>', $id)
                ->get();
        } else {
            return StandardDocument::where('no', '=', $no)
                ->get();    
        }
    }

    public function validatingDescription($description, $id=false) 
    {
        if ($id) {
            return StandardDocument::where('description', '=', $description)
                ->where('id', '<>', $id)
                ->get();
        } else {
            return StandardDocument::where('description', '=', $description)
                ->get();    
        }
    }
}
