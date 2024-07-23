<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    public function ListUsers(Request $request){
        if(isset($_POST['tambah'])){
            $username = $request->input('username');
            $name = $request->input('nama');
            $tipe = $request->input('tipe_user');
            $password = $request->input('password');

            $now = Carbon::now();

            $data = [
                'login' => $username,
                'nama' => $name,
                'tipe' => $tipe,
                'password' => $password,
                'reg_date' => $now->format('Y-m-d H:i:s')
            ];

            $addUser = DB::table('tuser')->insert($data);

            if($addUser){
                session()->flash('success', 'Berhasil menambahkan user');
            }else{
                session()->flash('error', 'Gagal menambahkan user');
            }
            return redirect('/user/list');
        }else{
            $users = DB::table('tuser')->get();
            $list_hak_akses = DB::table('m_hakakses')->select('id', 'hakakses')->get();
            return view('user.users', ['users' => $users, 'hakakses' => $list_hak_akses]);
        }
    }

    public function HakAkses(Request $request){
        $hak_akses = DB::table('m_hakakses')->get();
        return view('user.hak_akses',['hak_akses' => $hak_akses]);
    }

    public function AddHakAkses(Request $request){
        if(isset($_POST['tambah'])){

        }else{
            return view('user.add_hak_akses');
        }
    }

    public function DeleteUser($id){
        $del = DB::table('tuser')->where('id', $id)->delete();
        if ($del){
            session()->flash('success', 'Berhasil menghapus user');
        }else{
            session()->flash('error', 'Gagal menghapus user');
        }
        return redirect('/user/list');
    }

    public function DeleteHakAkses($id){
        $del = DB::table('m_hakakses')->where('id', $id)->delete();
        if ($del){
            session()->flash('success', 'Berhasil menghapus user');
        }else{
            session()->flash('error', 'Gagal menghapus user');
        }
        return redirect('/user/list');
    }

    public function UpdateUser(Request $request, $id){
        $new_password = $request->input('update_password');
        $update = DB::table('tuser')->where('id', $id)->update(['password' => $new_password]);
        if ($update){
            session()->flash('success', 'Berhasil mengubah password user');
        }else{
            session()->flash('error', 'Gagal mengubah password user');
        }
        return redirect('/user/list');
    }

    public function UpdateHakAkses(Request $request, $id){
        if(isset($_POST['update'])){

        }else{
            return view('user.edit_hak_akeses');
        }
    }
}