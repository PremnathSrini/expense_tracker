<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        // $data['user'] = Auth::user();
        $data = [
            'labels' =>  ['Food','Petrol','Entertainment','Shopping','Internet'],
            'prices' => [1000,800,400,1200,3000],
            'incomes' => [100,200,0,0,800],
            'user' => Auth::user(),
        ];
        return view('user.dashboard',$data);
    }
}
