<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use App\User;

use Mail;
use App\UserRegistration;
use Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use DateTime;
use DateInterval;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

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
        $user->save();
        
        $token = new UserRegistration;
        $token->user_id = $user->id;
        $token->token = Hash::make('myrandom');
        $token->status = '0';
         
        $datetime = new DateTime();
        $datetime->add(new DateInterval('P1D'));
        $token->expired_at = $datetime;
        
        if (Mail::send('emails.information', ['user' => $user, 'token' => $token->token], function ($m) use ($user) {
        	$m->to($user->email, $user->name)->subject('Authentication Required');
        })) {
            
            
            $token->touch();
        	$token->save();
        } else {
            return response()->json([], 500);
        }
        
    }
    
     public function confirm($token) {
        $userToken = UserRegistration::where('token', '=', $token)->first();
        
        //if token exists
        if (count($userToken) > 0) {
            
            
            if ($userToken->expired_at > new DateTime()) {
                
                if ($userToken->status == '0') {
                    
                    $user = User::find($userToken->user_id);
                    $user->status = '2';
                    $user->touch();
                    $user->save();
                    
                    $userToken->status = '1';
                    $userToken->touch();
                    $userToken->save();
                    
                    return redirect()->route('main');
            
                } else {
                    return response()->json(['header' => 'Token already used', 'message' => 'Mohon maaf, 
                        token yang diberikan telah digunakan. Apabila Anda yakin belum melakukan 
                        konfirmasi melalui email, harap segera hubungi administrator'], 503);
                    //token already used
                }
            } else {
                return response()->json(['header' => 'Token already used', 'message' => 'Mohon maaf, 
                    registrasi yang Anda lakukan sebelumnya sudah kadarluasa, harap lakukan pengiriman ulang untuk 
                    konfirmasi email'], 503);
            }
            
        } else {
            //token do not exists;
            return response()->json(['header' => 'Token already used', 'message' => 'Mohon maaf, 
                token registrasi yang Anda kirimkan tidak ditemukan dalam database, harap lakukan pengiriman ulang untuk 
                konfirmasi email'], 503);
        }
    }
    
    public function resend() {
        $user = JWTAuth::parseToken()->authenticate();
        
        $token = UserRegistration::where('user_id', '=', $user->id);
        $token->delete();
        
        $token = new UserRegistration;
        $token->user_id = $user->id;
        $token->token = Hash::make('myrandom');
        $token->status = '0';
        
        $datetime = new DateTime();
        $datetime->add(new DateInterval('P1D'));
        $token->expired_at = $datetime;
        
        if (Mail::send('emails.information', ['user' => $user, 'token' => $token->token], function ($m) use ($user) {
            $m->to($user->email, $user->name)->subject('Authentication Required');
        })) {
            $user->touch();
            $user->save();
            
            $token->touch();
            $token->save();
        } else {
            return response()->json([], 500);
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
