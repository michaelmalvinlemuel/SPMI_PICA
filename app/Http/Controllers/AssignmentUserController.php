<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AssignmentTemplate;
use App\AssignmentAttachmentTemplate;
use App\AssignmentRecipient;
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

        //for get whole form and the receipient of it
        $recipientDelegation = AssignmentTemplate::

        /*
            with(['attachments.delegations' => function($query) use ($user) {
                $query->where('user_id', '=', $user->id)->with('user');
            }])
            
            ->whereHas('attachments', function($query) use ($user) {
                $query->whereHas('delegations', function($query1) use ($user) {
                    $query1->where('user_id', '=', $user->id);
                });
            })

            */

            with(['attachments' => function($query) use ($user) {
                $query->with(['delegations' => function($query3) use ($user) {
                    $query3->where('user_id', '=', $user->id)->with('user');
                }])
                ->whereHas('delegations', function($query2) use ($user) {
                    $query2->where('user_id', '=', $user->id)->with('user');
                });
            }])

        ->find($id);
        
        //assign uploaded file array
        foreach($recipientDelegation->attachments as $key => $value) {
            
            //better save it for later
            /*
            $testing = AssignmentUpload::where('assignment_recipient_id', '=', $value->delegations[0]->assignment_recipient_id)
                ->where('assignment_attachment_template_id', '=', $value->id)
                ->with('user')
                ->orderBy('created_at', 'desc')->limit(5)->get();
                
            $value->uploads = $testing;
            */

            $testing = AssignmentUpload::where('assignment_attachment_template_id', '=', $value->id)
                ->with('user')
                ->orderBy('created_at', 'desc')->limit(5)->get();
                
            $value->uploads = $testing;


        }

        $recipientDelegation = json_decode(json_encode($recipientDelegation), false);

        foreach($recipientDelegation->attachments as $key => $value) {

            $temp_delegation = $value->delegations;
            $temp_assignment_recipient_id = 0;
            $temp_assignment_attachment_template_id = 0;

            $d = $value->delegations;
            foreach($d as $key1 => $value1) {
                $temp_assignment_recipient_id = $value1->assignment_recipient_id;
                $temp_assignment_attachment_template_id = $value1->assignment_attachment_template_id;
                break;
            }

            $main_recipient = AssignmentRecipient::with('user')->find($temp_assignment_recipient_id);
            $recipientDelegation->user = $main_recipient->user;

            $delegation_all = AssignmentDelegation::where('assignment_recipient_id', '=', $temp_assignment_recipient_id)
                ->where('assignment_attachment_template_id', '=', $temp_assignment_attachment_template_id)
                ->with('user')->get();
            
            $value->delegations = $delegation_all;
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
