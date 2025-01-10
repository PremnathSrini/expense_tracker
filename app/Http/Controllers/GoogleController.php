<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class GoogleController extends Controller
{
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(){
        DB::beginTransaction();
        try{
            $user = Socialite::driver('google')->user();
            // dd($user);
            $findUser = User::where('google_id',$user->id)->first();

            if($findUser){
                if(Auth::attempt(['email' => $user->email, 'password' => 'password@123'])){
                    DB::commit();
                    return to_route('dashboard');
                }
            }else{
                $newUser = User::updateOrCreate(
                    ['email' => $user->email],
                [
                    'name' => $user->name,
                    'google_id' => $user->id,
                    'password' => bcrypt('password@123'),
                    'role_id' => 1,
                ]);
                DB::commit();
                Auth::login($newUser);
                return to_route('dashboard');
            }
        }catch (Throwable $e) {
            DB::rollBack();
            Auth::logout();
            Log::error('Google callback error' .$e->getMessage());
            return redirect()->route('admin.login')->with('error','Failed to log in with Google. Please try again.');
        }
    }
}
