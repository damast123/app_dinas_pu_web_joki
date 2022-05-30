<?php

namespace App\Http\Controllers;

use App\Models\Dinas;
use App\Models\Role;
use App\Models\Jabatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DinasController extends Controller
{
    public function index()
    {
        $id = Auth::guard('admin')->user()->id;
        $rolesaatini = Dinas::join('jabatans','pegawai_dinas.jabatan_id','=','jabatans.id')->where('pegawai_dinas.id',$id)->where('jabatans.nama_jabatan','Admin')->first();
        $input_role = Role::all();
        $input_jabatan = Jabatan::all();
        $dinas = Dinas::all();
        $role = [];
        $jabatan = [];
        foreach($dinas as $val)
        {
            $role[] = $val->role;
            $jabatan[] = $val->jabatan;
        }
        $data = [
            'content' => 'admin.config.dinas',
            'dinas' => $dinas,
            'role' => $role,
            'input_role' => $input_role,
            'input_jabatan' => $input_jabatan,
            'jabatan' => $jabatan,
            'rolesaatini' => $rolesaatini,
        ];
        return view('admin.layout.index', ['data' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dinas  $dinas
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $dinas_show = Dinas::find($request->id);

	    return response()->json($dinas_show);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dinas  $dinas
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $dinas_show[] = Dinas::find($request->id);
        $role = Role::find($dinas_show[0]->role_id);
        $jabatan = Jabatan::find($dinas_show[0]->jabatan_id);
        $dinas_show[] = $role->nama_role;
        $dinas_show[] = $jabatan->nama_jabatan;
	    return response()->json($dinas_show);
    }

    public function update(Request $request)
    {
        $rules = [
            'name'                  => 'required|min:3|max:35',
            'email'                 => 'required|email',
            'no_telp'               => 'required',
        ];

        $messages = [
            'name.required'         => 'Nama Lengkap wajib diisi',
            'name.min'              => 'Nama lengkap minimal 3 karakter',
            'name.max'              => 'Nama lengkap maksimal 35 karakter',
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
            'no_telp'               => 'Nomor telephone wajib diisi'
        ];
        $validation = Validator::make($request->all(), $rules, $messages);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'message'  => $validation->errors()
            ];
        } else {
            $arr = ['name'      => $request->name,
            'alamat'      => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tempat_lahir' => $request->tempat_lahir,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            ];
            $getJabatan = [];
            $getRole = [];
            $role = $request->role;

            $jabatan = $request->jabatan;

            if($jabatan!=null)
            {
                $getJabatan = ['jabatan_id'=>$jabatan];
            }
            if($role!=null)
            {
                $getRole = ['role_id'=>$role];
            }

            $arr_merge = array_merge($arr,$getJabatan,$getRole);

            $query = Dinas::where('id',$request->id)
                ->update($arr_merge);

            if($query) {
                $response = [
                    'status'  => 200,
                    'message' => 'Data telah diproses.'
                ];
            } else {
                $response = [
                    'status'  => 500,
                    'message' => 'Data gagal diproses. '.$query
                ];
            }
        }

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dinas  $dinas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $dinas_show = Dinas::find($request->id);

	    return response()->json($dinas_show);
    }

    public function deleted(Request $request)
    {
        $query = Dinas::find($request->id)->delete();
        if($query)
        {
            $response = [
                'status'  => 200,
                'message' => 'Data telah diproses.'
            ];

        }
        else
        {
            $response = [
                'status'  => 500,
                'message' => 'Data gagal diproses.'
            ];

        }

        return response()->json($response);
    }
}
