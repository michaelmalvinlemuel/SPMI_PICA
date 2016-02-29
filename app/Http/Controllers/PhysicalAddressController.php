<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\PhysicalAddressCategory;
use App\PhysicalAddress;

class PhysicalAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(PhysicalAddress::get());
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $hierarchy = [];
        
        function depth ($id, &$hierarchy) {
            
            $physical = PhysicalAddress::with('physicalAddressCategory')->find($id);
            array_push($hierarchy, $physical);
            
            if ($physical->physical_address_id !== null) {
                depth($physical->physical_address_id, $hierarchy);
            } 
        }
        
        $physical = PhysicalAddress::with('physicalAddressCategory')->find($id);
        array_push($hierarchy, $physical);
        
        if ($physical->physical_address_id !== null) {
            depth($physical->physical_address_id, $hierarchy);
        } 
        
        $response = [];
        $response  = array_reverse($hierarchy, false);
        return response()->json($response);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $physical = new PhysicalAddress;
        $physical->code = $request->input('code');
        $physical->description = $request->input('description');
        $physical->type = $request->input('type');
        $physical->physical_address_id = $request->input('physical_address_id');
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
        return response()->json(PhysicalAddress::find($id));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        
        $hierarchy = [];
        
        function depth ($id, &$hierarchy) {
            
            $physical = PhysicalAddress::with('physicalAddressCategory')->find($id);
            array_push($hierarchy, $physical);
            
            if ($physical->physical_address_id !== null) {
                depth($physical->physical_address_id, $hierarchy);
            } 
        }
        
        $physical = PhysicalAddress::with('physicalAddressCategory')->find($id);
        array_push($hierarchy, $physical);
        
        if ($physical->physical_address_id !== null) {
            depth($physical->physical_address_id, $hierarchy);
        } 
        
        $response = [];
        $response  = array_reverse($hierarchy, false);
        return response()->json($response);
        
        
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
        $physical = PhysicalAddress::find($id);
        $physical->code = $request->input('code');
        $physical->description = $request->input('description');
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
        $physical = PhysicalAddress::find($id);
        $physical->delete();
    }
    
    
    private function selectRecursivePhysical($nodes) {
        
        $physical = PhysicalAddress::with('physicalAddressCategory')->where('physical_address_id', '=', $nodes->id)->get();
       
        
        if (count($physical) > 0) {
            
            $nodes['children'] = $physical;
            foreach($physical as $key => $value) {
                
                $value['label'] = $value->description;
                $this->selectRecursivePhysical($value);
                
            }
        }
        
    }
    
    public function explore() {
        
        $storage = PhysicalAddress::with('physicalAddressCategory')->whereNull('physical_address_id')->get();
        
        foreach($storage as $key => $value) {
            
            $storage[$key]['label'] = $value->description;
            $this->selectRecursivePhysical($value);
            
        }
        
        return response()->json($storage);
    }
    
    public function sub($id) {
        
        $physical = PhysicalAddress::find($id);
        
        return response()->json($physical);
    }
}
