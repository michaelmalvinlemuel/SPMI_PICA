<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AssignmentAttachmentTemplate;
use App\AssignmentDelegation;
use App\AssignmentRecipient;
use App\AssignmentTemplate;
use App\AssignmentUpload;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AssignmentUserAttachmentController extends Controller
{

    use UserTrait;

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
        
        $attachment = new AssignmentUpload;
        $attachment->assignment_recipient_id = $request->input('assignment_recipient_id');
        $attachment->assignment_attachment_template_id = $request->input('assignment_attachment_template_id');
        
        $attachment->user_id = $user->id;
        $attachment->document = $request->input('filename');
        $attachment->touch();
        $attachment->save();
        
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
    
    public function delegate(Request $request) 
    {
        
        
        $subordinate = $this->coordinate();

        

        $user = JWTAuth::parseToken()->authenticate();
        $temp_assignment_recipient_id = $request->input('assignment_recipient_id');
        $temp_assignment_attachment_template_id = $request->input('assignment_attachment_template_id');
        //get subordinate level only

        foreach ($subordinate as $key => $value) {

            AssignmentDelegation::where('assignment_recipient_id', '=', $temp_assignment_recipient_id)
                ->where('assignment_attachment_template_id', '=', $temp_assignment_attachment_template_id)
                ->where('user_id', '=', $value->id) 
                ->delete();
        }

        
            
        
        
        $delegations = json_decode(json_encode($request->input('delegations')), true);
        //$delegations = $request->input('delegations');
        
        //return $delegations;
        
        foreach($delegations as $key => $value) {
            $new = new AssignmentDelegation;
            $new->assignment_recipient_id = $request->input('assignment_recipient_id');
            $new->assignment_attachment_template_id = $request->input('assignment_attachment_template_id');
            $new->user_id = $value['id'];
            $new->touch();
            $new->save();
        }

        $response = AssignmentDelegation::where('assignment_recipient_id', '=', $request->input('assignment_recipient_id'))
            ->where('assignment_attachment_template_id', '=', $request->input('assignment_attachment_template_id'))
            ->with('user')->get();

        return response()->json($response);
        
        /*
        $delegation = AssignmentDelegation::where('assignment_attachment_id', '=', $request->input('assignment_attachment_id'))
            ->where('assignment_recipient_id', '=', $request->input('assignment_recipient_id'));
        $delegation->delete();
        
        $attachment = AssignmentAttachment::find($request->input('assignment_attachment_id'));
        
        $users = json_decode(json_encode($request->input('delegations'), false));
        foreach($users as $key => $value) {
            $delegate = new AssignmentRecipientDelegation;
            $delegate->user_id = $value->id;
            $delegate->assignment_attachment_id = $request->input('assignment_attachment_id');
            $delegate->assignment_recipient_id = $request->input('assignment_recipient_id');
            $delegate->touch();
            $attachment->delegate()->save($delegate);
        }
        
        */
        
    }
}
