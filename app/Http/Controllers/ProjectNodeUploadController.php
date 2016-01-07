<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ProjectFormUpload;
use App\ProjectFormUploadAttachment;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ProjectNodeUploadController extends Controller
{
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     
    public function store(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        
        //return $request;
        
        $upload = new ProjectFormUpload;
        $upload->project_form_item_id = $request->input('project_form_item_id');
        $upload->upload = $request->input('file');
        $upload->user_id = $user->id;
        
        if ($request->input('description')) 
        $upload->description = $request->input('description');
        
        $upload->touch();
        $upload->save();
        
        $attachments = $request->input('attachments');
        if (is_array($attachments) || is_object($attachments)) {
            foreach($attachments as $key => $value) {
                $uploadAttachments = new ProjectFormUploadAttachment;
                $uploadAttachments->project_form_upload_id = $upload->id;
                
                if (isset($attachments[$key]['title']))
                $uploadAttachments->title = $attachments[$key]['title'];
                
                if(isset($attachments[$key]['description']))
                $uploadAttachments->description = $attachments[$key]['description'];
                
                $uploadAttachments->attachment = $attachments[$key]['attachment'];
                $uploadAttachments->touch();
                $uploadAttachments->save();
            }
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ProjectFormUpload::with('attachments')->find($id);
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
