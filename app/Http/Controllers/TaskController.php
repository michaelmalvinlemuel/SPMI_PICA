<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Work;
use App\Job;
use App\Task;
use App\TaskUser;
use App\TaskJob;
use App\TaskWork;
use App\TaskForm;
use DB;
use Response;

use Illuminate\Database\Eloquent\Model;


use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
    }
    
    public function show($id){
        $temp = 0;
        $currentDate = date("Y-m-d H:i:s");

        $user = JWTAuth::parseToken()->authenticate();
        $id = $user->id;
        
        $taskUser['ongoing'] = TaskUser::where('user_id', '=', $id)->with(['jobs' => function($query1) use ($currentDate, $id) {
            $query1->with(['works' => function($query2) use ($currentDate, $id) {
                $query2->where('status', '=', 1)->where('expired_at','>=', $currentDate)
                    ->where('user_id', '=', $id)->with(['tasks' => function($query3) use ($currentDate, $id) {
                    $query3->where('user_id', '=', $id);
                }]);
            }]);
        }])->get();

        //return Response::json($taskUser, $status=200, $headers=[], $options=JSON_PRETTY_PRINT); 


        $taskUser['overdue'] = TaskUser::where('user_id', '=', $id)->with(['jobs' => function($query1) use ($currentDate, $id) {
            $query1->with(['works' => function($query2) use ($currentDate, $id) {
                $query2->where('status', '=', 1)->where('expired_at','<', $currentDate)
                    ->where('user_id', '=', $id)->with(['tasks' => function($query3) use ($currentDate, $id) {
                    $query3->where('user_id', '=', $id);
                }]);
            }]);
        }])->get();
        
        $taskUser['complete'] = TaskUser::where('user_id', '=', $id)->with(['jobs' => function($query1) use ($currentDate, $id) {
            $query1->with(['works' => function($query2) use ($currentDate, $id) {
                $query2->where('status', '=', 2)
                    ->where('user_id', '=', $id)->with(['tasks' => function($query3) use ($currentDate, $id) {
                    $query3->where('user_id', '=', $id);
                }]);
            }]);
        }])->get();

        //$temp = TaskUser::where('user_id', '=', $id)->with('jobs.works.tasks')->get();
        return Response::json($taskUser, $status=200, $headers=[], $options=JSON_PRETTY_PRINT); 
    }

    public function retrive($userId, $jobId, $display, $progress, $complete, $overdue) 
    {
        /*
        $tasks = TaskUser::where('user_id', '=', $userId)->with(['jobs' => function($query1) use ($userId, $jobId) {
            $query1->where('job_id', '=', $jobId)->with(['works' => function($query2) use ($userId) {
                $query2->where('user_id', '=', $userId)->with(['tasks' => function($query3) use ($userId) {
                    $query3->where('user_id', '=', $userId);
                }]);
            }]);
        }])->paginate(1);
        
        
        $temp = $tasks->toArray();
        $temp['data'] = $temp['data'][0]['jobs'][0]['works'];
        return Response::json($temp, $status=200); 
        */
        
        
        
        $currentDate = date("Y-m-d H:i:s");
        
        $tasks = TaskWork::with(['tasks' => function($query) use ($userId) {
            $query->where('user_id', '=', $userId);
        }])->where('status', '=', 1000);
        
        
            
        if ( $progress == 'true' )
        $tasks = $tasks->progress($userId, $jobId);
        
        if ( $complete == 'true' )
        $tasks = $tasks->complete($userId, $jobId);
        
        if ( $overdue == 'true' )
        $tasks = $tasks->overdue($userId, $jobId);
       
        
            
        $tasks = $tasks->paginate($display);
       
        
        return response()->json($tasks); 
    }

    public function showBatch($userId, $batchId)
    {   
        
        $workTask = Task::where('user_id', '=', $userId)->where('batch_id', '=', $batchId)->first();
        $workId = $workTask->work_id;
        $jobId = $workTask->job_id;
        $work = Work::find($workId);
        $job = Job::find($jobId);

        $task = TaskWork::where('user_id', '=', $userId)
            ->where('batch_id', '=', $batchId)->with(['tasks' => function ($query) use ($userId, $batchId) {
                $query->where('user_id', '=', $userId)->where('batch_id', '=', $batchId);
        }])->first();

        $task['work'] = $work;
        $task['job'] = $job;

        return Response::json($task, $status=200, $headers=[], $options=JSON_PRETTY_PRINT); 
    }

    public function update(Request $request, $id)
    {
        

        $task = $request->input('tasks');
        
        
        $user = User::find($request->input('user_id'));
        
        
        $files = $request->file('files');
        
        
        if (is_array($files) || is_object($files))
        foreach ($files as $key => $file) {
           
                $filename = $file->getClientOriginalName();
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $workName = basename($request->input('name'), "." . $ext);
                $filename = strtoupper(preg_replace('/\s+/', '', $user->nik . "_" . $workName . '_' . $filename . "_" . date("YmdHis")))  . "." . $ext;
                $file->move(env('APP_UPLOAD') . '\task', $filename); 
                
                $taskForm = Task::find($key);
                $taskForm->upload = $filename;
                $taskForm->status = 2;
                $taskForm->touch();
                $taskForm->save();

        }
        
    

        

        /*
        foreach($workTask as $key => $value) {
            
            $doc = 'document_' . $value->id;

            if ($request->file($doc)) {

                $filename = $request->file($doc)->getClientOriginalName();
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $filename = basename($request->input('description'), "." . $ext);
                $filename = strtoupper(preg_replace('/\s+/', '', $filename . "_" . date("YmdHis")))  . "." . $ext;
                $upload = $request->file($doc)->move(env('APP_UPLOAD') . '\task', $filename);

                $document->document = $filename;
            }

            $document->touch();
            $document->save();

        }*/

        
       
    }

    public function destroy($id)
    {
        //
    }

    public function users($id)
    {
        $taskUser = TaskUser::where('user_id', '=', $id)->with('jobs.works.tasks')->get();
        return Response::json($taskUser, $status=200, $headers=[], $options=JSON_PRETTY_PRINT); 
    }
}
