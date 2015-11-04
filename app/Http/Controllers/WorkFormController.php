<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\WorkForm;
use App\Form;

class WorkFormController extends Controller
{
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request, $workId)
    {
        $id = WorkForm::where('work_id', '=', $workId)->where('form_id', '=', $request->input('id'))->get(['id']);
        if(count($id) > 0) 
        return response()->json(
            [
                'title' => 'Unik Work Form Exception',
                'body' => 'Pekerjaan harus memiliki formulir yang unik'
            ], 500);
            
        $workForm = new WorkForm;
        $workForm->work_id = $workId;
        $workForm->form_id = $request->input('id');
        $workForm->touch();
        $workForm->save();
        
        $form = Form::with('instruction.guide.standardDocument.standard')->find($request->input('id'));
        return response()->json($form);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $workId, $formId)
    {
        $id = WorkForm::where('work_id', '=', $workId)->where('form_id', '=', $request->input('id'))->get(['id']);
        if(count($id) > 0) 
        return Response::json(
            [
                'title' => 'Unique Work Form Exception',
                'body' => 'Pekerjaan harus memiliki formulir yang unik'
            ], 500);
            
        $workForm = WorkForm::where('work_id', '=', $workId)->where('form_id', '=', $formId)->first();
        $workForm->form_id = $request->input('id');
        $workForm->touch();
        $workForm->save();
        
        $form = Form::with('instruction.guide.standardDocument.standard')->find($request->input('id'));
        return response()->json($form);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($workId, $formId)
    {
        $workForm = WorkForm::where('work_id', '=', $workId)->where('form_id', '=', $formId);
        $workForm->delete();
    }
}
