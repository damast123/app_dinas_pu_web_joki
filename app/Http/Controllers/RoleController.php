<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index()
    {
        $role = Role::all();

        $data = [
            'content' => 'admin.config.role',
            'role' => $role,
        ];
        return view('admin.layout.index', ['data' => $data]);
    }


    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'nama'   => 'required',

        ], [
            'nama.required'   => 'Mohon mengisi nama role.',
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'message'  => $validation->errors()
            ];
        } else {
            $query = Role::create([
                'nama_role'  => $request->nama,
            ]);

            if($query) {
                $response = [
                    'status'  => 200,
                    'message' => 'Data telah diproses.'
                ];
            } else {
                $response = [
                    'status'  => 500,
                    'message' => 'Data gagal diproses.'
                ];
            }
        }

        return response()->json($response);
    }

    public function edit(Request $request)
    {
        $role = Role::find($request->id);

	    return response()->json($role);
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'nama'   => 'required',

        ], [
            'nama.required'   => 'Mohon mengisi nama role.',
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'message'  => $validation->errors()
            ];
        } else {
            $query = Role::where('id', $request->id)->update([
                'nama_role'  => $request->nama,
            ]);

            if($query) {
                $response = [
                    'status'  => 200,
                    'message' => 'Data telah diproses.'
                ];
            } else {
                $response = [
                    'status'  => 500,
                    'message' => 'Data gagal diproses.'
                ];
            }
        }

        return response()->json($response);
    }
}
