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
use Mail;

class UserController extends Controller
{

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
        //$user->delete();
    }

    public function validatingNik($nik , $id=false)
    {
        if ($id) {
            return User::where('nik', '=', $nik)
                ->where('id', '<>', $id)
                ->get();
        } else {
            return User::where('nik', '=', $nik)
                ->get();    
        }
    }

    public function validatingEmail($email, $id=false)
    {
        if ($id) {
            return User::where('email', '=', $email)
                ->where('id', '<>', $id)
                ->get();
        } else {
            return User::where('email', '=', $email)
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

    public function jobs ($userId) {
       //get jobs that current user held
       $user = User::with('jobs')->find($userId);
       $jobs = $user->jobs;
       
       $this->hierarchyGenerator($jobs);
       
        
       return Response::json($jobs, $status = 200, $header=[], JSON_PRETTY_PRINT);
    }

    public function subs ($id) {
        
    }

    public function register (Request $request) {
		
    	
    	
        $user = new User;
        $user->nik = $request->input('nik');
        $user->name = $request->input('name');
        $user->born = $request->input('born');
        $user->address = $request->input('address');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->type = $request->input('type');
        $user->status = '1';
        $user->touch();
       

        $token = new UserRegistration;
        $token->user_id = $user->id;
        $token->token = Hash::make('myrandom');
        $token->touch();
        
        if (Mail::send('emails.information', ['user' => $user, 'token' => $token->token], function ($m) use ($user) {
        	$m->to($user->email, $user->name)->subject('Authentication Required');
        })) {
        	$user->save();
        	$token->save();
        }
        
        

        

    }

    public function checkToken($token) {
        $userToken = UserRegistration::where('token', '=', $token)->get();

        if (count($userToken) > 0) {
            $user = User::find($userToken[0]->user_id);
            $user->status = '2';
            $user->touch();
            $user->save();
            return redirect()->route('main');
            //$userToken->delete();
        }
    }

}
