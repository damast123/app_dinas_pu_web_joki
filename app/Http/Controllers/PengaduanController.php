<?php

namespace App\Http\Controllers;

use App\Models\KategoriPengaduan;
use App\Models\Pengaduan;
use App\Models\Dinas;
use App\Models\Rakyat;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengaduan = Pengaduan::cursorPaginate(5);

        $rakyat = [];
        foreach ($pengaduan as $value) {
            $rakyat[] = $value->rakyat;
        }
        $data = [
            'content'   => 'rakyat.pengaduan.index',
            'pengaduan'  => $pengaduan,
            'rakyat'    => $rakyat
        ];
        return view('rakyat.layout.index', ['data' => $data]);
    }

    public function indexadmin()
    {
        $pengaduan = Pengaduan::all();
        $rakyat = [];

        foreach ($pengaduan as $value) {
            $rakyat[] = $value->rakyat;
        }
        $data = [
            'content' => 'admin.pengaduan.index',
            'pengaduan' => $pengaduan,
            'rakyat'    => $rakyat
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
        $katPengaduan = KategoriPengaduan::all();
        $data = [
            'content' => 'rakyat.pengaduan.created',
            'katpengaduan' => $katPengaduan,
        ];
        return view('rakyat.layout.index', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Auth::guard('masyarakat')->user()->id;
        $request->validate([
            'jenis_pengaduan' => 'required',
            'judul_pengaduan' => 'required',
            'isi_pengaduan' => 'required',
            'tanggal_kejadian' => 'required',
            'lokasi_pengaduan' => 'required',
            'katpengaduan' => 'required',
            'gambar' => 'required|max:2048|mimes:jpeg,png,jpg,gif,svg',
        ], [
            'jenis_pengaduan.required' => 'Jenis Pengaduan Tidak Boleh Kosong',
            'judul_pengaduan.required' => 'Judul Laporan Tidak Boleh Kosong',
            'isi_pengaduan.required' => 'Isi Laporan Tidak Boleh Kosong',
            'tanggal_kejadian.required' => 'Tanggal Kejadian Tidak Boleh Kosong',
            'lokasi_pengaduan.required' => 'Lokasi Pengaduan Tidak Boleh Kosong',
            'katpengaduan.required' => 'Kategori Pengaduan Tidak Boleh Kosong',
            'gambar.required' => 'File Tidak Boleh Kosong',
            'gambar.max' => 'File harus max 2048mb',
            'gambar.mimes' => 'File Harus Berupa Gambar Seperti jpeg,png,jpg,gif,svg',
        ]);
        $file = $request->file('file');
        $gambar = $request->file('gambar');

		if($file==null)
        {
            $nama_file = "";
        }
        else
        {
            $nama_file = time()."_".$file->getClientOriginalName();
        }
        if($gambar==null)
        {
            $nama_gambar = "";
        }
        else
        {
            $nama_gambar = time()."_".$gambar->getClientOriginalName();
        }
        $date = Carbon::now();
        $add_pengaduan = Pengaduan::create([
            'jenis_pengaduan'        => $request->jenis_pengaduan,
            'judul_pengaduan'        => $request->judul_pengaduan,
            'isi_pengaduan'          => $request->isi_pengaduan,
            'tanggal_kejadian'       => $request->tanggal_kejadian,
            'tanggal_pengaduan'      => $date->toDateTimeString(),
            'lokasi_pengaduan'       => $request->lokasi_pengaduan,
            'kategori_pengaduan_id'  => $request->katpengaduan,
            'gambar'                 => $nama_gambar,
            'file'                   => $nama_file,
            'status_pengaduan'       => '0',
            'rakyat_id'              => $id,
        ]);
        $emailDinasTujuan = Dinas::where('jabatan_id','8')->first();

        if($add_pengaduan)
        {

            $details = [
                'title' => $request->jenis_pengaduan.' Baru',
                'body' => 'Ada '. $request->jenis_pengaduan . ' Dengan judul ' . $request->judul_pengaduan . '. Mohon di cek di admin dashboard'
            ];

            try {
                Mail::to($emailDinasTujuan->email)->send(new \App\Mail\RakyatMail($details));
                echo "sukses";
            } catch(\Exception $e){
                echo "Email gagal dikirim karena $e.";
            }

            if($gambar!=null)
            {
                $tujuan_upload = 'gambarpengaduan';
		        $gambar->move($tujuan_upload,$nama_gambar);
            }
            if($file!=null)
            {
                $tujuan_upload_doc = 'docpengaduan';
		        $file->move($tujuan_upload_doc,$nama_file);
            }
            return back()->with('success', 'Sukses membuat Pengaduan.');
        }
        else
        {
            return back()->with('error', 'Gagal membuat Pengaduan.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $pengaduan_show = Pengaduan::find($request->id);

	    return response()->json($pengaduan_show);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $pengaduan_show = Pengaduan::find($request->id);

	    return response()->json($pengaduan_show);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $update_pengaduan = Pengaduan::where('id',$request->id)
        ->update([
            'status_pengaduan'      => $request->status_pengaduan,
        ]);

        $get_id_rakyat = Pengaduan::find($request->id);

        $get_email = Rakyat::find($get_id_rakyat->rakyat_id);

        if($update_pengaduan) {
            $stat = "";
            if($request->status_pengaduan==2)
            {
                $stat = "Selesai";
            }
            else
            {
                $stat = "Tidak di acc";
            }
            $details = [
                'title' => 'Update status pengaduan ',
                'body' => 'Status pengaduan dengan judul '.$get_id_rakyat->judul_pengaduan.' sudah di update. Sekarang status pengaduan sudah: '. $stat . '.'
            ];

            try {
                Mail::to($get_email->email)->send(new \App\Mail\UpdatePengaduan($details));
            } catch(\Exception $e){
                echo "Email gagal dikirim karena $e.";
            }

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

    public function getDownload($filename){

        $path = public_path('docpengaduan/'.$filename);

        if(file_exists($path))
        {
            return response()->download($path);
        }
        else
        {
            return back()->with('error', 'File tidak ada.');;
        }

    }
}
