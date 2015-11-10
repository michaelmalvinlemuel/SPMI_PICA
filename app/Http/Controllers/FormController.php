<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Form;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Form::with('instruction.guide.StandardDocument.standard')->get();
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
        $filename = $request->file('file')->getClientOriginalName();
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $filename = basename($request->input('description'), "." . $ext);
        $filename = strtoupper(preg_replace('/\s+/', '', $filename . "_" . date("YmdHis")))  . "." . $ext;
        $upload = $request->file('file')->move(env('APP_UPLOAD') . '/form', $filename);

        $form = new Form;
        $form->instruction_id = $request->input('instruction_id');
        $form->no = $request->input('no');
        $form->date = $request->input('date');
        $form->description = $request->input('description');
        $form->document = $filename;
        $form->touch();
        $form->save();
        
        //return response()->json($request, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Form::with('instruction.guide.StandardDocument.standard')->find($id);
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
        $form = Form::find($id);
        $form->instruction_id = $request->input('instruction_id');
        $form->no = $request->input('no');
        $form->date = $request->input('date');
        $form->description = $request->input('description');
        if ($request->file('file')) {
            $filename = $request->file('file')->getClientOriginalName();
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $filename = basename($request->input('description'), "." . $ext);
            $filename = strtoupper(preg_replace('/\s+/', '', $filename . "_" . date("YmdHis")))  . "." . $ext;
            $upload = $request->file('file')->move(env('APP_UPLOAD') . '/form', $filename);
            $form->document = $filename;
        }
        $form->touch();
        $form->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $form = Form::find($id);
        $form->delete();
    }

    public function instruction($id) {
        return Form::where('instruction_id', '=', $id)->with('instruction.guide.standardDocument.standard')->get();
    }

    public function validatingNo($no, $id = false)
    {
        if ($id) {
            return Form::where('no', '=', $no)
                ->where('id', '<>', $id)
                ->get();
        } else {
            return Form::where('no', '=', $no)
                ->get();    
        }
    } 

    public function validatingDescription($description, $id = false)
    {
        if ($id) {
            return Form::where('description', '=', $description)
                ->where('id', '<>', $id)
                ->get();
        } else {
            return Form::where('description', '=', $description)
                ->get();    
        }
    }


}
