<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Throwable;

class UserAuthController extends Controller
{
    public function showRegisterForm(){
        return view('user.register');
    }

    public function showLoginForm(){
        return view('user.login');
    }

    public function register(Request $request){
        // dd($request->all());
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        DB::beginTransaction();
        try{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role_id' => 2,
            ]);
            Mail::to($user->email)->send(new VerifyEmail($user));
            Auth::logout();
            DB::commit();
            return to_route('login.form')->with('message','Registration successful. Please check your email to verify your account.');
        }catch(Throwable $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],[
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
        ]);

        $credentials = $request->only('email','password');
        $remember = $request->has('remember_me');

        if((Auth::attempt($credentials,$remember)) && Auth::user()->role_id != 1)
        {
            return to_route('user.index');
        }
        else{
            Auth::logout();
            return back()->with('error','Wrong Credentials');
        }
    }

    public function logout(){
        try{
            Auth::logout();
            return to_route('user.login')->with('success','Logged out successfully');
        }catch(Throwable $e){
            Log::error('logout error'.$e->getMessage());
            return back()->with('error','Something went wrong');
        }
    }
}
