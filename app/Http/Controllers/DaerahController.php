<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Daerah;

class DaerahController extends Controller
{
    public function index()
    {
        $daerah = Daerah::all();

        $data = [
            'content' => 'admin.config.daerah',
            'daerah' => $daerah,
        ];
        return view('admin.layout.index', ['data' => $data]);
    }


    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'nama_daerah'   => 'required',

        ], [
            'nama_daerah.required'   => 'Mohon mengisi nama daerah.',
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'message'  => $validation->errors()
            ];
        } else {
            $nama_daerah = strtoupper($request->nama_daerah);
            $cek_daerah = Daerah::where('nama_daerah',$nama_daerah)->first();
            if($cek_daerah !== null)
            {
                $response = [
                    'status'  => 500,
                    'message' => 'Data daerah sudah ada, silahkan input data daerah lain.'
                ];
                return response()->json($response);
            }
            $query = Daerah::create([
                'nama_daerah'  => $nama_daerah,
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
        $daerah = Daerah::find($request->id);

	    return response()->json($daerah);
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'nama_daerah'   => 'required',

        ], [
            'nama_daerah.required'   => 'Mohon mengisi nama daerah.',
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'message'  => $validation->errors()
            ];
        } else {
            $nama_daerah = strtoupper($request->nama_daerah);
            $cek_daerah = Daerah::where('nama_daerah',$nama_daerah)->first();
            if($cek_daerah!==null)
            {
                $response = [
                    'status'  => 500,
                    'message' => 'Data daerah sudah ada, silahkan input data daerah lain.'
                ];
                return response()->json($response);
            }
            $query = Daerah::where('id', $request->id)->update([
                'nama_daerah'  => $request->nama_daerah,
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
