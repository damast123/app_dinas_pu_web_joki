<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Dinas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = Carbon::now();
        $berita = Berita::cursorPaginate(10);
        $beritarecent = Berita::where('tanggal_muat','!=',$date->toDateTimeString())->orderBy('tanggal_muat', 'desc')->take(5)->get();
        $dinas = [];
        foreach($berita as $value)
        {
            $dinas[] = Dinas::select('*')
            ->where('id',$value->pegawai_dinas_id)
            ->get();
        }
        $data = [
            'content'       => 'rakyat.berita.index',
            'berita'        => $berita,
            'beritarecent'  => $beritarecent,
            'dinas'         => $dinas
        ];
        return view('rakyat.layout.index', ['data' => $data]);
    }

    public function indexadmin()
    {
        $berita = Berita::all();
        $dinas = [];

        foreach($berita as $value)
        {
            $dinas[] = Dinas::select('*')
            ->where('id',$value->pegawai_dinas_id)
            ->get();
        }
        $data = [
            'content' => 'admin.berita.index',
            'berita' => $berita,
            'dinas' => $dinas
        ];
        return view('admin.layout.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'content' => 'admin.berita.create'
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
        $id = Auth::guard('admin')->user()->id;
        $request->validate([
            'tanggal_berita' => 'required',
            'tanggal_muat' => 'required',
            'judul_berita' => 'required',
            'isi_berita' => 'required'
        ], [
            'tanggal_berita.required' => 'Tanggal Berita Tidak Boleh Kosong',
            'tanggal_muat.required' => 'Tanggal Muat Tidak Boleh Kosong',
            'judul_berita.required' => 'Judul Tidak Boleh Kosong',
            'isi_berita.required' => 'Isi Berita Tidak Boleh Kosong',
        ]);
        $file = $request->file('gambar');

		if($file==null)
        {
            $nama_file = "";
        }
        else
        {
            $nama_file = time()."_".$file->getClientOriginalName();
        }
        $add_berita = Berita::create([
            'tanggal_berita'      => $request->tanggal_berita,
            'tanggal_muat'  => $request->tanggal_muat,
            'judul_berita'      => $request->judul_berita,
            'isi_berita'  => $request->isi_berita,
            'gambar_berita' => $nama_file,
            'pegawai_dinas_id' => $id,
        ]);
        if($add_berita)
        {
            if($file!=null)
            {
                $tujuan_upload = 'file_berita';
		        $file->move($tujuan_upload,$nama_file);
            }

            return back()->with('success', 'Sukses membuat berita.');
        }
        else
        {
            return back()->with('error', 'Gagal membuat berita.');
        }
    }

    public function show($id)
    {
        $berita = Berita::find($id);
        $dinas = Dinas::select('*')
        ->where('id',$berita->pegawai_dinas_id)
        ->first();
        $data = [
            'content'   => 'rakyat.berita.show_berita',
            'berita'    => $berita,
            'dinas'     => $dinas
        ];
        return view('rakyat.layout.index', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function showadmin(Request $request)
    {
        $berita = Berita::find($request->id);

        return response()->json($berita);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $berita = Berita::find($request->id);

        $data = [
            'content' => 'admin.berita.edit',
            'berita' => $berita
        ];
        return view('admin.layout.index', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'tanggal_berita' => 'required',
            'tanggal_muat' => 'required',
            'judul_berita' => 'required',
            'isi_berita' => 'required'
        ], [
            'tanggal_berita.required' => 'Tanggal Berita Tidak Boleh Kosong',
            'tanggal_muat.required' => 'Tanggal Muat Tidak Boleh Kosong',
            'judul_berita.required' => 'Judul Tidak Boleh Kosong',
            'isi_berita.required' => 'Isi Berita Tidak Boleh Kosong',
        ]);
        $berita = Berita::find($request->id);
        if($berita['gambar_berita']==$request->gambar)
        {
            $update_berita = Berita::where('id',$request->id)
            ->update([
                'tanggal_berita'      => $request->tanggal_berita,
                'tanggal_muat'  => $request->tanggal_muat,
                'judul_berita'      => $request->judul_berita,
                'isi_berita'  => $request->isi_berita,
            ]);
            if($update_berita)
            {
                return back()->with('success', 'Sukses edit berita.');
            }
            else
            {
                return back()->with('error', 'Gagal edit berita.');
            }
        }
        else
        {
            $file = $request->file('gambar');
            $nama_file = time()."_".$file->getClientOriginalName();
            $update_berita = Berita::where('id',$request->id)
            ->update([
                'tanggal_berita'      => $request->tanggal_berita,
                'tanggal_muat'  => $request->tanggal_muat,
                'judul_berita'      => $request->judul_berita,
                'isi_berita'  => $request->isi_berita,
                'gambar_berita'  => $nama_file,
            ]);
            if($update_berita)
            {
                if($file!=null)
                {
                    $tujuan_upload = 'file_berita';
                    $file->move($tujuan_upload,$nama_file);
                }

                return back()->with('success', 'Sukses edit berita.');
            }
            else
            {
                return back()->with('error', 'Gagal edit berita.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delete_show = Berita::find($request->id);

	    return response()->json($delete_show);
    }

    public function softdeleted(Request $request)
    {
        $query = Berita::find($request->id)->delete();
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
        $query = Berita::find($request->id)->forceDelete();
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
