<?php

namespace App\Http\Controllers;

use App\Models\KategoriPengaduan;
use Illuminate\Http\Request;

class KategoriPengaduanController extends Controller
{
    public function index()
    {
        $kategori_pengaduan = KategoriPengaduan::all();

        $data = [
            'content' => 'admin.config.kategori_pengaduan',
            'kategori_pengaduan' => $kategori_pengaduan,
        ];
        return view('admin.layout.index', ['data' => $data]);
    }
    public function create()
    {
        $data = [
            'content'  => 'admin.config.createkategoripengaduan',
        ];
        return view('admin.layout.index', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
        ], [
            'nama_kategori.required' => 'Nama Kategori Tidak Boleh Kosong',
        ]);
        $add_perintah = KategoriPengaduan::create([
            'nama' => $request->nama_kategori
        ]);
        if($add_perintah)
        {
            return back()->with('success', 'Sukses membuat Kategori Pengaduan.');
        }
        else
        {
            return back()->with('error', 'Gagal membuat Kategori Pengaduan.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perintah  $perintah
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $perintah_show = KategoriPengaduan::find($request->id);

	    return response()->json($perintah_show);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perintah  $perintah
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $perintah_show = KategoriPengaduan::find($request->id);

	    return response()->json($perintah_show);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $arr = ['nama' => $request->kategori_nama];

        $update_perintah = KategoriPengaduan::findOrFail($request->id_edit)
            ->update($arr);

        if($update_perintah)
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
                'message' => 'Data gagal diproses. '.$update_perintah
            ];
        }
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perintah  $perintah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $perintah_show = KategoriPengaduan::find($request->id);

	    return response()->json($perintah_show);
    }

    public function softdeleted(Request $request)
    {
        $query = KategoriPengaduan::find($request->id)->delete();
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
