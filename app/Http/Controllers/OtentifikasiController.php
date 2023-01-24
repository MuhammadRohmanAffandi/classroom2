<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class OtentifikasiController extends Controller
{
    //
    public function index(){
        return view('login');
    }

    public function login(Request $request){
        // dd($request->all());
        //dd($_POST['username']);
        if(Auth::attempt(['name' => $request->username, 'password' => $request->password])) {
            return redirect('beranda');
        }
        return redirect('/')->with('message', 'Email atau Password salah!');
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('/');
    }
}
