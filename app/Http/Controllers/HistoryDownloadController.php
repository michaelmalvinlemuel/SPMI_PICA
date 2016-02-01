<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HistoryDownload;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\StandardDocument;
use App\Guide;
use App\Instruction;
use App\Form;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
class HistoryDownloadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        switch ($request->type) {
            case 's': $type = StandardDocument::find($request->id); break;
            case 'g': $type = Guide::find($request->id); break;
            case 'i': $type = Instruction::find($request->id); break;
            case 'f': $type = Form::find($request->id); break;
        }
        $history = new HistoryDownload;
        $history->user_id = $user->id;
        $history->touch();
        
        $type->download()->save($history);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
