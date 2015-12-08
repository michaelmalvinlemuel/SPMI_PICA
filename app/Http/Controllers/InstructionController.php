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

        $instruction = new Instruction;
        $instruction->guide_id = $request->input('guide_id');
        $instruction->no = $request->input('no');
        $instruction->date = $request->input('date');
        $instruction->description = $request->input('description');
        $instruction->document = $request->input('filename');

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
    public function update(Request $request, $id)
    {
        $instruction = Instruction::find($id);
        $instruction->guide_id = $request->input('guide_id');
        $instruction->no = $request->input('no');
        $instruction->date = $request->input('date');
        $instruction->description = $request->input('description');

        if ($request->input('filename')) {
            $instruction->document = $request->input('filename');
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
    public function destroy($id)
    {
        $instruction = Instruction::find($id);
        $instruction->delete();
    }

    public function guide ($id) {
        return Instruction::with('guide.standardDocument.standard')->where('guide_id', '=', $id)->get();
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
