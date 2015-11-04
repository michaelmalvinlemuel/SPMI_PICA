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

    public function update(Request $request, $id)
    {
        $semester = Semester::find($id);
        $semester->year_start = $request->input('year_start');
        $semester->year_ended = $request->input('year_ended');
        $semester->type = $request->input('type');
        $semester->date_start = $request->input('date_start');
        $semester->date_ended = $request->input('date_ended');
        $semester->touch();
        $semester->save();
    }

    public function destroy($id)
    {
        $semester = Semester::find($id);
        $semester->delete();
    }

    public function intersect($date, $id=false) {
       
        //return $date;
        if ($id) {
            return Semester::where('date_start', '<', $date)
            ->where('date_ended', '>', $date)->where('id', '<>', $id)->get();
        } else {
            return Semester::where('date_start', '<', $date)
            ->where('date_ended', '>', $date)->get();
        }
        
    }

    public function included($dateStart, $dateEnded, $id=false) {
   
        
        if ($id) {
            return Semester::whereBetween('date_start', [$dateStart, $dateEnded])
            ->whereBetween('date_ended', [$dateStart, $dateEnded])
            ->where('id', '<>', $id)->get();
        } else {
            return Semester::whereBetween('date_start', [$dateStart, $dateEnded])
            ->whereBetween('date_ended', [$dateStart, $dateEnded])->get();
        }
        
    }
}
