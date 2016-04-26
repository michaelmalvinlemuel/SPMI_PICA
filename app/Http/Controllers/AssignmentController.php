<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AssignmentTemplate;
use App\AssignmentAttachmentTemplate;

use App\AssignmentRecipient;
use App\AssignmentDelegation;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assignment = AssignmentTemplate::get();
        return response()->json($assignment);
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
        
        $assignment = new AssignmentTemplate;
        $assignment->name = $request->input('name');
        $assignment->description = $request->input('description');
        $assignment->user_id = $user->id;
        $assignment->touch();
        
        $users = $request->input('users');
        $attachment = $request->input('assignments');
        
        foreach($attachment as $key => $value) {
            $attach = new AssignmentAttachmentTemplate;
            $attach->assignment_template_id = $assignment->id;
            $attach->name = $value['name'];
            $attach->description = $value['description'];
            $attach->touch();
            $assignment->attachments()->save($attach);
        }
        
        foreach($users as $key => $value) {
            $recipient = new AssignmentRecipient;
            $recipient->assignment_template_id = $assignment->id;
            $recipient->user_id = $value['id'];
            $recipient->touch();
            $recipient->save();//$assignment->recipients()->save($recipient);
            
            $attachment = AssignmentAttachmentTemplate::where('assignment_template_id', '=', $assignment->id)->get();
            
            foreach($attachment as $key1 => $value1) {
                $delegation = new AssignmentDelegation;
                $delegation->assignment_recipient_id = $recipient->id;
                $delegation->assignment_attachment_template_id = $value1->id;
                $delegation->user_id = $value['id'];
                $delegation->touch();
                $delegation->save();    
            }
            
        }
        
        
        
        
        
        
        //return response()->json($users);
        
        
        
        //$assignment->assignmentRecipient()->save($recipient);
        
        
        
        
        
        
        
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
    
    
    public function detail($id) {
        $assignment = AssignmentTemplate::with('creator')->with(['recipients' => function($query) {
            $query->with('user');
        }])->find($id);
        
        
        $assignment = json_decode(json_encode($assignment), false);
        
        $attachment = AssignmentAttachmentTemplate::where('assignment_template_id', '=', $id)->get();
        foreach($assignment->recipients as $key => $value) {
            $value->user->attachment = $attachment;
        }
        
        return response()->json($assignment); 
    }
}
