<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use App\User;

use Mail;
use App\UserRegistration;
use Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    
     public function confirm($token) {
        $userToken = UserRegistration::where('token', '=', $token)->get();

        if (count($userToken) > 0) {
            $user = User::find($userToken[0]->user_id);
            $user->status = '2';
            $user->touch();
            $user->save();
            return redirect()->to('http://spmi.umn.ac.id');
        }
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
        //
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
}
