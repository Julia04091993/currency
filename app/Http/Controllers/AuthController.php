<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Validator;
use App\Models\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function submit(Request $request) {
        $validator = Validator::make($request->all(), [
            'login'    => 'required|string',
            'password' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return view('auth', ['message' => true]);
        } else {
           if ($this->check($request)) { 
               $request->session()->put('key', 'authorized'); 
               return redirect('/currency');
           }
           else {
               return view('auth', ['message' => true]);
           }
        }
    }
    public function check(Request $request) {
        $user = DB::table('auths')
                    ->where('login', $request->input('login'))
                    ->where('password', $request->input('password'))
                    ->exists(); 
        return $user;
    }
}
