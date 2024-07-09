<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(Request $request){
        if(isset($_POST['login'])){
            $request->validate([
                'username' => 'required|max:255',
                'password' => 'required|max:255'
            ]);

            $username = $request->input('username');
            $password = $request->input('password');

            $valid = DB::table('tuser')->where('login', $username)->first();
            if($valid != null && $password == $valid->password){
                session([
                    'login' => $valid->login, 
                    'tipe' => $valid->tipe
                ]);
                return redirect(route('home'));
            }else{
                session()->flash('error', 'Username atau Password salah!');
                return redirect()->back();
            }
        }else{
            return view('auth.login');
        }
    }

    public function logout(){
        session()->flush();
        return redirect(route('login'));
    }

    public function profile(){
        $login = session()->get('login');
        $profile = DB::table('tuser')->where('login', $login)->first();
        dd($profile);  
        return view('auth.profile');
    }
}
