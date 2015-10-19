<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Instruction;

class InstructionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Instruction::with('guide.StandardDocument.standard')->get();
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
        $upload = $request->file('document')->move(env('APP_UPLOAD') . '\instruction', $filename);

        $instruction = new Instruction;
        $instruction->guide_id = $request->input('guide_id');
        $instruction->no = $request->input('no');
        $instruction->date = $request->input('date');
        $instruction->description = $request->input('description');
        $instruction->document = $filename;

        $instruction->touch();
        $instruction->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Instruction::with('guide.StandardDocument.standard')->find($id);
        
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
        $instruction = Instruction::find($request->input('id'));
        $instruction->guide_id = $request->input('guide_id');
        $instruction->no = $request->input('no');
        $instruction->date = $request->input('date');
        $instruction->description = $request->input('description');

        if ($request->file('document')) {
            $filename = $request->file('document')->getClientOriginalName();
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $filename = basename($request->input('description'), "." . $ext);
            $filename = strtoupper(preg_replace('/\s+/', '', $filename . "_" . date("YmdHis")))  . "." . $ext;
            $upload = $request->file('document')->move(env('APP_UPLOAD') . '\instruction', $filename);
            $instruction->document = $filename;
        }

        $instruction->touch();
        $instruction->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $instruction = Instruction::find($request->input('id'));
        $instruction->delete();
    }

    public function guide ($id) {
        return Instruction::with('guide')->where('guide_id', '=', $id)->get();
    }

    public function validatingNo(Request $request)
    {
        if ($request->input('id')) {
            return Instruction::where('no', '=', $request->input('no'))
                ->where('id', '<>', $request->input('id'))
                ->get();
        } else {
            return Instruction::where('no', '=', $request->input('no'))
                ->get();    
        }
    } 

    public function validatingDescription(Request $request)
    {
        if ($request->input('id')) {
            return Instruction::where('description', '=', $request->input('description'))
                ->where('id', '<>', $request->input('id'))
                ->get();
        } else {
            return Instruction::where('description', '=', $request->input('description'))
                ->get();    
        }
    }
}
