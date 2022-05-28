<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dinas;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

use App\Models\Jabatan;
use App\Models\Role;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:admin');
    }
    public function showAdminRegisterForm()
    {
        $role = Role::all();
        $jabatan = Jabatan::all();

        return view('admin.register')->with('role',$role)->with('jabatan',$jabatan);
    }

    protected function createAdmin(Request $request)
    {
        $rules = [
            'name'                  => 'required|min:3|max:35',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|confirmed'
        ];

        $messages = [
            'name.required'         => 'Nama Lengkap wajib diisi',
            'name.min'              => 'Nama lengkap minimal 3 karakter',
            'name.max'              => 'Nama lengkap maksimal 35 karakter',
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
            'email.unique'          => 'Email sudah terdaftar',
            'password.required'     => 'Password wajib diisi',
            'password.confirmed'    => 'Password tidak sama dengan konfirmasi password'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $cekData = Dinas::select('*')->orWhere('email','=',$request->email)->first();
        if($cekData)
        {
            return redirect()->back()->withErrors('Email sudah terpakai, silahkan input email yang lain');
        }

        $user = new Dinas;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->email_verified_at = \Carbon\Carbon::now();
        $user->alamat = $request->alamat;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->tempat_lahir = $request->tempat_lahir;
        $user->jabatan_id = $request->jabatan;
        $user->role_id = $request->role;
        $simpan = $user->save();

        if($simpan){
            return redirect()->route('login_admin');
        } else {
            return redirect()->back()->withErrors('Register gagal! Silahkan ulangi beberapa saat lagi');
        }
    }

}
