<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\PhysicalAddressCategory;
use App\PhysicalAddress;

class PhysicalAddressCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(PhysicalAddressCategory::get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $physical = new PhysicalAddressCategory;
        $physical->physical = $request->input('physical');
        $physical->physical_address_category_id = $request->input('physical_address_category_id');
        $physical->touch();
        $physical->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(PhysicalAddressCategory::find($id));
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
        $physical = PhysicalAddressCategory::find($id);
        $physical->physical = $request->input('physical');
        $physical->physical_address_category_id = $request->input('physical_address_category_id');
        
        $physical->touch();
        $physical->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $physical = PhysicalAddressCategory::find($id);
        $physical->touch();
        $physical->delete();
    }
    
    
    public function validatePhysical (Request $request) {
        
        if ($request->input('id')) {
            return PhysicalAddressCategory::where('physical', '=', $request->input('physical'))
                ->where('id', '<>', $request->input('id'))->get();
        } else {
            return PhysicalAddressCategory::where('physical', '=', $request->input('physical'))
                ->get();
        }
    }
    
    public function sub($id) {
        
        $physicalCategory = PhysicalAddressCategory::where('physical_address_category_id','=', $id)->first();
        
        return response()->json($physicalCategory);
        
    }
    
    
    
}
