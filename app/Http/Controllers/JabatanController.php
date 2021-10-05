<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jabatan = Jabatan::all();

        $data = [
            'content' => 'admin.config.jabatan',
            'jabatan' => $jabatan,
        ];
        return view('admin.layout.index', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'nama'   => 'required',

        ], [
            'nama.required'   => 'Mohon mengisi nama jabatan.',
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'message'  => $validation->errors()
            ];
        } else {
            $query = Jabatan::create([
                'nama_jabatan'  => $request->nama,
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
        $jabatan = Jabatan::find($request->id);

	    return response()->json($jabatan);
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'nama'   => 'required',

        ], [
            'nama.required'   => 'Mohon mengisi nama jabatan.',
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'message'  => $validation->errors()
            ];
        } else {
            $query = Jabatan::where('id', $request->id)->update([
                'nama_jabatan'  => $request->nama,

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

    public function destroy(Request $request)
    {
        $destroy_show = Jabatan::find($request->id);

	    return response()->json($destroy_show);
    }

    public function softdeleted(Request $request)
    {
        $query = Jabatan::find($request->id)->delete();
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

    public function harddeleted(Request $request)
    {
        $query = Jabatan::find($request->id)->forceDelete();
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
        return response()->json($response);
    }
}
