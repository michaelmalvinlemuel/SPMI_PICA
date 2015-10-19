<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\WorkForm;

class WorkFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id)
    {
        return WorkForm::where('work_id', '=', $id)->with('form.instruction.guide.standardDocument.standard')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $workdetail = new WorkForm;
        $workdetail->work_id = $request->input('work_id');
        $workdetail->form_id = $request->input('form_id');
        $workdetail->touch();
        $workdetail->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return WorkForm::find($id);    
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
        $workdetail = WorkForm::find($request->input('id'));
        $workdetail->work_id = $request->input('work_id');
        $workdetail->form_id = $request->input('form_id');
        $workdetail->touch();
        $workdetail->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $workdetail = WorkForm::find($request->input('id'));
        $workdetail->delete();
    }
}
