<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\Authenticate;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Response;
use App\User;
use App\Job;
use App\UserJob;
use App\UserRegistration;
use Auth;
use Hash;
use DB;
use App\Task;

use App\Department;
use App\GroupJob;
use App\GroupJobDetail;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{

    use UserTrait;

    public function check()
    {
        if (Auth::check()) {
            return Auth::user();
        } else {
            return Response::json(['header' => 'Error', 'message' => 'session not found'], 401);
        }
    }
    public function fakeLogin($username, $password, $token){
        if (Auth::attempt(['email' => $username, 'password' => $password])) {
            return response(Auth::user(), 200);
        } else {
            return Response::json(["header" => "False", "message" => "Kombinasi Username dan password salah. Silahkan coba lagi"], 401);
        }
    }
    
    public function login(Request $request) {
        
        //return Session::token();
        $username = $request->input('email');
        $password = $request->input('password');
        
        if (Auth::attempt(['email' => $username, 'password' => $password])) {
            return response(Auth::user(), 200);
        } else {
            return Response::json(["header" => "False", "message" => "Kombinasi Username dan password salah. Silahkan coba lagi"], 401);
        }
    }

    public function logout(){
        Auth::logout();
        return Response::json(['header' => 'True', 'message' => 'logout berhasil']);
    }


    public function index()
    {
        $user = User::get();
        return $user;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->nik = $request->input('nik');
        $user->name = $request->input('name');
        $user->born = $request->input('born');
        $user->address = $request->input('address');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->type = $request->input('type');
        $user->status = '3';
        
        $user->touch();
        $user->save();

        $job = $request->input('jobs');
        foreach ($job as $k => $v) {
            $userjob = new UserJob;
            $userjob->user_id = $user->id;
            $userjob->job_id = $v['id'];
            $userjob->touch();
            $userjob->save();
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user =  User::with('jobs.department.university')->find($id);
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->nik = $request->input('nik');
        $user->name = $request->input('name');
        $user->born = $request->input('born');
        $user->address = $request->input('address');
        $user->email = $request->input('email');
        $user->type = $request->input('type');
        $user->phone = $request->input('phone');
        $user->extension = $request->input('extension');
        $user->touch();
        $user->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->userJobs()->delete();
        $user->delete();
    }

    public function validatingNik(Request $request)
    {
        if ($request->input('id')) {
            return User::where('nik', '=', $request->input('nik'))
                ->where('id', '<>', $request->input('id'))
                ->get();
        } else {
            return User::where('nik', '=', $request->input('nik'))
                ->get();    
        }
    }

    public function validatingEmail(Request $request)
    {
        if ($request->input('id')) {
            return User::where('email', '=', $request->input('email'))
                ->where('id', '<>', $request->input('id'))
                ->get();
        } else {
            return User::where('email', '=', $request->input('email'))
                ->get();    
        }
    }
    
    private function subHierarchyGenerator($users, $jobId) {
        foreach($users as $key3 => $value3) {
            $subs = Job::with('users')->where('job_id', '=', $jobId)->get();
            
            foreach($subs as $key4 => $value4) {
                
                $subs[$key4]['node'] = 'job';
                $this->subHierarchyGenerator($value4->users, $value4->id);
                
            }
            $users[$key3]['node'] = 'user';
            $value3['subs'] = $subs;
        }
    }
    
    private function hierarchyGenerator($jobs) {
        foreach($jobs as $key => $value) {
           
            $subordinate  = Job::with('users')->where('job_id', '=', $value->id)->get();
            
            foreach($subordinate as $key2 => $value2) {
                $subordinate[$key2]['node'] = 'job';
                $this->subHierarchyGenerator($value2->users, $value2->id);
                
            }
            
            $jobs[$key]['jobs'] = $subordinate;
        }
    }

    public function jobs() {
       
        $userId = JWTAuth::parseToken()->authenticate();
        $userId = $userId->id;
        
        $user = User::with('jobs')->find($userId);
        $jobs = $user->jobs;
       
        $this->hierarchyGenerator($jobs);
       
        
        return response()->json($jobs, $status = 200, $header=[], JSON_PRETTY_PRINT);
    }
    
    public function subordinate() {
        
        $result = $this->coordinate();
        
       
        return response()->json($result);
    }
    
    /*
    public function subordinate() {
        $result = [];
        $temp = [];
        
        $user = JWTAuth::parseToken()->authenticate();
        
        $subordinate = User::with('jobs.users')->find($user->id);
        $jobs = $subordinate->jobs;
        
        
        
        
        function pushIfUnique(&$result, $node) {
            
            foreach($result as $key => $value) {
                if ($node == $value) {
                    return 0;
                }
            }
            
            array_push($result, $node);
        }
        
        function metamorph(&$result, $nodes) {
            
            foreach($nodes as $key => $value) {
                unset($value->pivot);
                pushIfUnique($result, $value);
            }
            
        }
        
      
        
        
        $jobs = json_decode(json_encode($jobs), false);
        foreach($jobs as $key => $value) {
            
            if(count($value->users) > 0) {
                metamorph($result, $value->users);    
            }
            
        }
        
        $result = json_decode(json_encode($result));
        
        foreach($result as $key => $value) {
            $a = User::with('jobs')->find($value->id);
            $a = json_decode(json_encode($a), false);
            
            array_push($temp, $a);
        }
        
        
        
        return response()->json($temp);
        
        
    }
    */

    /**
     * Dummy route for checking if users are administrator
     */
    public function administrator() {
        $user = JWTAuth::parseToken()->authenticate();
    }
    
    /**
     * Method for reset user password 
     */
     public function reset(Request $request)
     {
         $author = JWTAuth::parseToken()->authenticate();
         
         if (Auth::attempt(['email' => $author->email, 'password' => $request->input('old')])) {
            
            $user = User::find($author->id);
            $user->password = Hash::make($request->input('new'));
            $user->touch();
            $user->save();
            
            return response()->json([
                'header'    =>  true,
                'message'   =>  'password_success',
            ]);
            
        } else {
            
            return response()->json([
                "header" => false, 
                "message" => "password_error",
            ]);
            
        }
     }
     
     public function adminReset($id) {
         $user = User::find($id);
         $user->password = Hash::make('12345');
         $user->touch();
         $user->save();
     }  
     
     
     public function search(Request $request) {
         
         $user = User::where('name', 'LIKE', '%' . $request->input('keyword') . '%')->get();
         foreach($user as $key => $value) {
             $value->search_type = 'Users';
         }
         
         $department = Department::where('name', 'LIKE', '%' . $request->input('keyword') . '%')->get();
         foreach($department as $key => $value) {
             $value->search_type = 'Departments';
         }
         
         $job = Job::with('users')->where('name', 'LIKE', '%' . $request->input('keyword') . '%')->get();
         foreach($job as $key => $value) {
             $value->search_type ='Jobs';
         }
         
         
         
         
         
         $groupJob = GroupJob::with('jobs.users')->where('name', 'LIKE', '%' . $request->input('keyword') . '%')->get();
         
         $groupJobUsers = [];
         foreach($groupJob as $key => $value) {
             $value->search_type = 'Group Jobs';
             
             foreach($value->jobs as $key1 => $value1) {
                 
                 foreach($value1->users as $key2 => $value2) {
                     array_push($groupJobUsers, $value2);
                 }
                 //array_push($groupJobUsers, $value1->users);
             }
             $value->users = $groupJobUsers;
             
             unset($value->jobs);
         }
         
         
         
         $user = json_decode(json_encode($user), true);
         $department = json_decode(json_encode($department), true);
         $job = json_decode(json_encode($job), true);
         $groupJob = json_decode(json_encode($groupJob), true);
         
         $response = array_merge($user, $department, $job, $groupJob);
         
         
         return response()->json($response);
         
     }
     
     

}
