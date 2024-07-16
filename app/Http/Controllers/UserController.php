<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function ListUsers(Request $request){
        $users = DB::table('tuser')->get();
        return view('user.users', ['users' => $users]);
    }

    public function HakAkses(Request $request){
        $hak_akses = DB::table('m_hakakses')->get();
        return view('user.hak_akses',['hak_akses' => $hak_akses]);
    }
}