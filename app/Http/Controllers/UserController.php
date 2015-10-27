<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\Authenticate;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Response;
use App\User;
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

    public function login (Request $request) {
        $username = /*'stevanadjie@gmail.com';    */$request->input('username');
        $password = /*'12345';                    */$request->input('password');
        if (Auth::attempt(['email' => $username, 'password' => $password])) {
            // Authentication passed...
            return Auth::user();
        } else {
            return Response::json(["header" => "False", "message" => "Kombinasi Username dan password salah. Silahkan coba lagi"], 500);
        }
    }

    public function logout(){
        Auth::logout();
        return Response::json(['header' => 'True', 'message' => 'logout berhasil']);
    }


    public function index()
    {
        return User::get();
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

        $job = $request->input('userJobs');
        foreach ($job as $k => $v) {
            $userjob = new UserJob;
            $userjob->user_id = $user->id;
            $userjob->job_id = $v['job']['id'];
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
        return User::with('userJob')->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        $user = User::find($request->input('id'));
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
    public function destroy(Request $request)
    {
        $user = User::find($request->input('id'));
        $user->delete();
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

    public function jobs ($id) {
        $jobs = User::with('jobs')->find($id);
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
