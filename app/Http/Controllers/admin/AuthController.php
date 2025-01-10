<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Throwable;

class AuthController extends Controller
{
    public function index(){
        return view('admin.login');
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        if(Auth::attempt(['email' => $request->email,'password' => $request->password]) && Auth::user()->role_id === 1){
            return to_route('dashboard');
        }else{
            return back()->with('error','Wrong Credentials');
        }
    }

    public function logout(){
        try {
            Auth::logout();
            Session::flash('success', "Logout Successful");
            return to_route('admin.login');
        } catch (Throwable $e) {
            Log::info("Logout -> " . $e->getMessage());
            return back()->with('error', "Something went wrong!");
        }
    }
}
