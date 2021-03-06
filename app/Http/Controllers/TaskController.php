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
use Response;

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
    
    public function show($batchId) {
        
        $user = JWTAuth::parseToken()->authenticate();
        $userId = $user->id;
        
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

    public function retrive($userId, $jobId, $display, $progress, $complete, $overdue) 
    {

        
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

    public function update(Request $request, $id)
    {
       
       
        
        $taskForm = Task::find($request->id);
        $taskForm->upload = $request->upload;
        $taskForm->status = 2;
        $taskForm->touch();
        $taskForm->save();

        return $request->all();
       /*
        $task = $request->input('tasks');
        
        
        $user = JWTAuth::parseToken()->authenticate();
        
        $files = $request->input('files');
        
        if (is_array($files) || is_object($files))
        foreach ($files as $key => $value) {
            
            $taskForm = Task::find($task[$key]['id']);
            $taskForm->upload = $value;
            $taskForm->status = 2;
            $taskForm->touch();
            $taskForm->save();
        }
        */
        
        /*
        
        $files = $request->file('files');
        
        
        if (is_array($files) || is_object($files))
        foreach ($files as $key => $file) {
           
                $filename = $file->getClientOriginalName();
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $workName = basename($request->input('name'), "." . $ext);
                $filename = strtoupper(preg_replace('/\s+/', '', $user->nik . "_" . $workName . '_' . $filename . "_" . date("YmdHis")))  . "." . $ext;
                $file->move(env('APP_UPLOAD') . '/task', $filename); 
                
                $taskForm = Task::find($key);
                $taskForm->upload = $filename;
                $taskForm->status = 2;
                $taskForm->touch();
                $taskForm->save();

        }
        */
        
        
       
    }

    public function destroy($id)
    {
        //
    }

}
