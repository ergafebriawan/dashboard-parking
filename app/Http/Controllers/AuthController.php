<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        if(isset($_POST['login'])){

        }else{
            return view('auth.login');
        }
    }

    public function logout(){

    }

    public function profile(){
        return view('auth.profile');
    }
}
