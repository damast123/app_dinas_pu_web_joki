<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rakyat;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class RegisterRakyatController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:masyarakat');
    }

    public function showRakyatRegisterForm()
    {
        return view('rakyat.register');
    }

    protected function createRakyat(Request $request)
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

        $cekData = Rakyat::select('*')->orWhere('email','=',$request->email)->orWhere('no_telp','=',$request->no_telp)->first();

        if($cekData !== null)
        {
            return redirect()->back()->withErrors('Email atau no telp sudah terpakai. Silahkan isi email atau no telp yang berbeda');

        }

        $user = new Rakyat;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->email_verified_at = \Carbon\Carbon::now();
        $user->alamat = $request->alamat;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->no_telp = $request->no_telp;
        $simpan = $user->save();

        if($simpan){
            return redirect()->route('login_rakyat');
        } else {
            return redirect()->back()->withErrors('Register gagal! Silahkan ulangi beberapa saat lagi');
        }
    }
}
