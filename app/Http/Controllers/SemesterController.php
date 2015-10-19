<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Semester;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SemesterController extends Controller
{
    
    public function index()
    {
        return Semester::get();
    }

    public function store(Request $request)
    {
        $semester = new Semester;
        $semester->year_start = $request->input('year_start');
        $semester->year_ended = $request->input('year_ended');
        $semester->type = $request->input('type');
        $semester->date_start = $request->input('date_start');
        $semester->date_ended = $request->input('date_ended');
        $semester->touch();
        $semester->save();
    }

    public function show($id)
    {
        return Semester::find($id);
    }

    public function update(Request $request)
    {
        $semester = Semester::find($request->input('id'));
        $semester->year_start = $request->input('year_start');
        $semester->year_ended = $request->input('year_ended');
        $semester->type = $request->input('type');
        $semester->date_start = $request->input('date_start');
        $semester->date_ended = $request->input('date_ended');
        $semester->touch();
        $semester->save();
    }

    public function destroy(Request $request)
    {
        $semester = Semester::find($request->input('id'));
        $semester->delete();
    }

    public function intersect(Request $request) {
        if ($request->input('id')) {
            return Semester::where('date_start', '<', $request->input('date'))
            ->where('date_ended', '>', $request->input('date'))->where('id', '<>', $request->input('id'))->get();
        } else {
            return Semester::where('date_start', '<', $request->input('date'))
            ->where('date_ended', '>', $request->input('date'))->get();
        }
        
    }

    public function included(Request $request) {
        if ($request->input('id')) {
            return Semester::whereBetween('date_start', [$request->input('date_start'), $request->input('date_ended')])
            ->whereBetween('date_ended', [$request->input('date_start'), $request->input('date_ended')])
            ->where('id', '<>', $request->input('id'))->get();
        } else {
            return Semester::whereBetween('date_start', [$request->input('date_start'), $request->input('date_ended')])
            ->whereBetween('date_ended', [$request->input('date_start'), $request->input('date_ended')])->get();
        }
        
    }
}
