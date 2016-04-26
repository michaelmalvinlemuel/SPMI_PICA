<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AssignmentTemplate;
use App\AssignmentAttachmentTemplate;
use App\AssignmentRecepient;
use App\AssignmentRecipientAttachment;
use App\AssignmentDelegation;

use App\AssignmentUpload;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AssignmentUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = JWTAuth::parseToken()->authenticate();
        $id = $user->id;
        
        
        $assignment = AssignmentTemplate::
            whereHas('recipients', function($query) use ($id) {
                $query->whereHas('delegations', function($query1) use ($id) {
                    $query1->where('user_id', '=', $id);
                });
            })
        ->paginate(10);
        
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
        
    }
    
    private function recursiveRecipientDisqualifier($userId, $assignmentTemplateId) {
        $delegation = AssignmentDelegation::where('user_id', '=', $userId)->get();
        
        if (count($delegation) > 0) {
            return $delegation[0]->assignment_recipient_id;;
        } 
        
        //$attachment = AssignmentAttachmentTemplate::with('attachment')->find($assignmentTemplateId);
        
        return $delegation;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = JWTAuth::parseToken()->authenticate();
        
        $recipientDelegation = AssignmentTemplate::
            with(['attachments.delegations' => function($query) use ($user) {
                $query->where('user_id', '=', $user->id)->with('user');
            }])
            
            ->whereHas('attachments', function($query) use ($user) {
                $query->whereHas('delegations', function($query1) use ($user) {
                    $query1->where('user_id', '=', $user->id);
                });
            })
            
        ->find($id);
        
        $delegation = AssignmentDelegation::where('user_id', '=', $user->id)->first();
        
        foreach($recipientDelegation->attachments as $key => $value) {
            $testing = AssignmentUpload::where('assignment_recipient_id', '=', $value->delegations[0]->assignment_recipient_id)
                ->where('assignment_attachment_template_id', '=', $value->delegations[0]->assignment_attachment_template_id)
                ->with('user')
                ->orderBy('created_at', 'desc')->limit(5)->get();
                
            $value->uploads = $testing;
        }
        
        
        return response()->json($recipientDelegation);
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
