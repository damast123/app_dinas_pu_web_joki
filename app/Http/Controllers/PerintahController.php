<?php

namespace App\Http\Controllers;

use App\Models\Dinas;
use App\Models\Pengaduan;
use App\Models\Perintah;
use App\Models\Rakyat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PerintahController extends Controller
{
    public function index()
    {
        $id = Auth::guard('admin')->user()->id;
        $surat_perintah = Perintah::select('*')
        ->where('pegawai_dinas_pembuat',$id)
        ->orWhere('pegawai_dinas_tujuan',$id)
        ->get();
        $dinas_pembuat=[];
        $dinas_tujuan=[];
        foreach($surat_perintah as $val)
        {
            $dinas_pembuat[] = Dinas::select('*')
            ->where('id',$val->pegawai_dinas_pembuat)
            ->get();
            $dinas_tujuan[] = Dinas::select('*')
            ->where('id',$val->pegawai_dinas_tujuan)
            ->get();
        }


        $data = [
            'content'  => 'admin.surat_perintah.index',
            'surat_perintah' => $surat_perintah,
            'pegawai_dinas_pembuat' => $dinas_pembuat,
            'pegawai_dinas_tujuan' => $dinas_tujuan
        ];
        return view('admin.layout.index', ['data' => $data]);
    }

    public function create()
    {
        $id = Auth::guard('admin')->user()->id;
        $dinas = Dinas::where('id','!=',$id)->get();

        $pengaduan = Pengaduan::where('perintah_id',null)->where('jenis_pengaduan','pengaduan')->get();

        $data = [
            'content'  => 'admin.surat_perintah.create',
            'dinas'    => $dinas,
            'pengaduan'=> $pengaduan,
        ];
        return view('admin.layout.index', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $id = Auth::guard('admin')->user()->id;
        $request->validate([
            'no_surat_perintah' => 'required',
            'tanggal_surat_perintah' => 'required',
            'pesan' => 'required',
            'lokasi' => 'required',
            'status_laporan' => 'required',
            'pengaduan_assign' => 'required',
            'dinas_tujuan' => 'required',
        ], [
            'no_surat_perintah.required' => 'No Surat Perintah Tidak Boleh Kosong',
            'tanggal_surat_perintah.required' => 'Tanggal Tidak Boleh Kosong',
            'pesan.required' => 'Pesan Tidak Boleh Kosong',
            'lokasi.required' => 'Lokasi Tidak Boleh Kosong',
            'status_laporan.required' => 'Status Laporan Tidak Boleh Kosong',
            'pengaduan_assign.required' => 'Pengaduan Tidak Boleh Kosong',
            'dinas_tujuan.required' => 'Dinas Tujuan Tidak Boleh Kosong',

        ]);

        $cekData = Perintah::select('*')->where('no_surat_perintah','=',$request->no_surat_perintah)->first();

        if($cekData !== null)
        {
            return back()->with('error', 'Surat perintah sudah ada, silahkan input no surat yang lain.');
        }

        // $cek_no_surat = Perintah::where('no_surat_perintah',$request->no_surat_perintah)->firstOrFail();

        // dd($cek_no_surat);

        // if($cek_no_surat)
        // {
        //     return back()->with('error', 'Surat perintah sudah ada, silahkan input no surat yang lain.');
        // }

        $file = $request->file('file_doc');
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
        $add_perintah = Perintah::create([
            'no_surat_perintah' => $request->no_surat_perintah,
            'tanggal'           => $request->tanggal_surat_perintah,
            'pesan'             => $request->pesan,
            'laporan'           => $request->laporan,
            'lokasi'            => $request->lokasi,
            'status'            => $request->status_laporan,
            'gambar'            => $nama_gambar,
            'file'              => $nama_file,
            'pegawai_dinas_pembuat'     => $id,
            'pegawai_dinas_tujuan'      => $request->dinas_tujuan,
        ]);
        if($add_perintah)
        {
            Pengaduan::where('id',$request->pengaduan_assign)
            ->update([
                'status_pengaduan'      => '1',
                'pegawai_dinas_id'      => $request->dinas_tujuan,
                'perintah_id'           => $add_perintah->id
            ]);
            $emailDinasTujuan = Dinas::where('id',$request->pegawai_dinas_tujuan)->get();
            $details = [
                'title' => 'Ada surat perintah',
                'body' => 'Ini ada surat perintah dengan no: '.$request->no_surat_perintah.'. Silahkan cek di web'
            ];

            try {
                Mail::to($emailDinasTujuan[0]['email'])->send(new \App\Mail\MyMail($details));
            } catch(\Exception $e){
            }

            $get_id_rakyat = Pengaduan::find($request->pengaduan_assign);

            $get_email = Rakyat::find($get_id_rakyat->rakyat_id);

            $detailsPengaduan = [
                'title' => 'Update status pengaduan ',
                'body' => 'Status pengaduan anda dengan judul '.$get_id_rakyat->judul_pengaduan.' sudah di update. Sekarang status pengaduan sedang di proses.'
            ];

            try {
                Mail::to($get_email->email)->send(new \App\Mail\UpdatePengaduan($detailsPengaduan));
            } catch(\Exception $e){
            }


            if($file!=null)
            {
                $tujuan_upload = 'doc_surat_perintah';
		        $file->move($tujuan_upload,$nama_file);
            }
            if($gambar!=null)
            {
                $tujuan_gambar = 'gambar_surat_perintah';
		        $gambar->move($tujuan_gambar,$nama_gambar);
            }

            return back()->with('success', 'Sukses membuat Surat Perintah.');
        }
        else
        {
            return back()->with('error', 'Gagal membuat Surat Perintah.');
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
        $perintah_show = Perintah::find($request->id);

        $pengaduan_show = Pengaduan::where('perintah_id',$perintah_show->id)->firstOrFail();

        $rakyat_show = Rakyat::find($pengaduan_show->rakyat_id);

        $output[] = [
            'no_surat_perintah'     => $perintah_show->no_surat_perintah,
            'tanggal'               => $perintah_show->tanggal,
            'lokasi'                => $perintah_show->lokasi,
            'pesan'                 => $perintah_show->pesan,
            'laporan'               => $perintah_show->laporan,
            'status'                => $perintah_show->status,
            'tanggal_pengaduan'     => $pengaduan_show->tanggal_pengaduan,
            'tanggal_kejadian'      => $pengaduan_show->tanggal_kejadian,
            'judul_pengaduan'       => $pengaduan_show->judul_pengaduan,
            'isi_pesan'             => $pengaduan_show->isi_pengaduan,
            'jenis_pengaduan'       => $pengaduan_show->jenis_pengaduan,
            'status_pengaduan'      => $pengaduan_show->status_pengaduan,
            'nama_rakyat'           => $rakyat_show->name,
        ];

        // $data = DB::table('perintahs')
        //  ->join('pengaduans', 'perintahs.id', '=', 'pengaduans.perintah_id')
        //  ->join('rakyats', 'pengaduans.rakyat_id', '=', 'rakyats.id')
        //  ->select('perintahs.*', 'pengaduans.tanggal_pengaduan', 'pengaduans.tanggal_kejadian', 'pengaduans.judul_pengaduan', 'pengaduans.isi_pengaduan', 'pengaduans.jenis_pengaduan','pengaduans.status_pengaduan','rakyats.name')
        //  ->where('id',$request->id)
        //  ->paginate(3);


	    return response()->json($output);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perintah  $perintah
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $perintah_show = Perintah::find($request->id);

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

        $id = Auth::guard('admin')->user()->id;
        $arr = ['pesan'      => $request->pesan,
        'laporan'      => $request->laporan,
        'status' => $request->status_laporan_edit];
        $getNamaFile = [];
        $getNamaGambar = [];
        $file = $request->file('file_doc_edit');
        $gambar = $request->file('gambar_edit');

        if($file!=null)
        {
            $nama_file = time()."_".$file->getClientOriginalName();
            $getNamaFile = ['file'=>$nama_file];
        }
        if($gambar!=null)
        {
            $nama_gambar = time()."_".$gambar->getClientOriginalName();
            $getNamaGambar = ['gambar'=>$nama_gambar];
        }

        $arr_merge = array_merge($arr,$getNamaFile,$getNamaGambar);

        $update_perintah = Perintah::findOrFail($request->id)
            ->update($arr_merge);

        $get_email_pembuat = Dinas::find($request->dinas_pembuat);

        $get_email_tujuan = Dinas::find($request->dinas_tujuan);

        if($update_perintah)
        {
            $get_id_rakyat = Pengaduan::where('perintah_id','=',$request->id)->get();

            $get_email = Rakyat::find($get_id_rakyat[0]->rakyat_id);

            $details = [
                'title' => 'Update perintah ',
                'body' => 'Perintah dengan no surat: '.$request->no_surat_perintah.' sudah di update. Silahkan cek di web.'
            ];

            if($request->status_laporan_edit=="0")
            {
                if($id==$get_email_pembuat->id)
                {
                    try {
                        Mail::to($get_email_tujuan->email)->send(new \App\Mail\MyMailUpdate($details));
                    } catch(\Exception $e){

                    }
                }
                else
                {
                    try {
                        Mail::to($get_email_pembuat->email)->send(new \App\Mail\MyMailUpdate($details));
                    } catch(\Exception $e){
                    }
                }
            }
            elseif($request->status_laporan_edit=="1"){
                Pengaduan::where('perintah_id','=',$request->id)
                ->update([
                    'status_pengaduan'      => '2',
                ]);

                $detailsPengaduan = [
                    'title' => 'Update status pengaduan ',
                    'body' => 'Status pengaduan anda sudah di update. Pengaduan anda sudah selesai diproses.'
                ];

                try {
                    Mail::to($get_email->email)->send(new \App\Mail\UpdatePengaduan($detailsPengaduan));
                } catch(\Exception $e){
                }
            }
            else
            {
                Pengaduan::where('perintah_id','=',$request->id)
                ->update([
                    'status_pengaduan'      => '3',
                ]);

                $detailsPengaduan = [
                    'title' => 'Update status pengaduan ',
                    'body' => 'Status pengaduan anda sudah di update. Namun mohon maaf tapi pengaduan anda dibatalkan.'
                ];
                try {
                    Mail::to($get_email->email)->send(new \App\Mail\UpdatePengaduan($detailsPengaduan));
                } catch(\Exception $e){
                }
            }

            if($file!=null)
            {
                $tujuan_upload = 'doc_surat_perintah';
		        $file->move($tujuan_upload,$nama_file);
            }
            if($gambar!=null)
            {
                $tujuan_gambar = 'gambar_surat_perintah';
		        $gambar->move($tujuan_gambar,$nama_gambar);
            }

            $response = [
                'status'  => 200,
                'message' => 'Data telah diproses.'
            ];
        }
        else
        {
            $response = [
                'status'  => 500,
                'message' => 'Data gagal diproses. '
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
        $perintah_show = Perintah::find($request->id);

	    return response()->json($perintah_show);
    }

    public function softdeleted(Request $request)
    {
        $query = Perintah::find($request->id)->delete();
        if($query)
        {
            Pengaduan::where('perintah_id',$request->id)
            ->update(['pegawai_dinas_id'=>null,'perintah_id'=>null]);
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

    public function getDownload($filename){

        $path = public_path('doc_surat_perintah/'.$filename);

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
