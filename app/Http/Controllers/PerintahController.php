<?php

namespace App\Http\Controllers;

use App\Models\Dinas;
use App\Models\Perintah;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PerintahController extends Controller
{
    public function index()
    {
        $id = Auth::guard('admin')->user()->id;
        $surat_perintah = Perintah::select('*')
        ->where('dinas_pembuat',$id)
        ->orWhere('dinas_tujuan',$id)
        ->get();

        foreach($surat_perintah as $val)
        {
            $dinas_pembuat = Dinas::select('*')
            ->where('id',$val->dinas_pembuat)
            ->get();
            $dinas_tujuan = Dinas::select('*')
            ->where('id',$val->dinas_tujuan)
            ->get();
        }


        $data = [
            'content'  => 'admin.surat_perintah.index',
            'surat_perintah' => $surat_perintah,
            'dinas_pembuat' => $dinas_pembuat,
            'dinas_tujuan' => $dinas_tujuan
        ];
        return view('admin.layout.index', ['data' => $data]);
    }

    public function create()
    {
        $id = Auth::guard('admin')->user()->id;
        $dinas = Dinas::where('id','!=',$id)->get();
        $data = [
            'content'  => 'admin.surat_perintah.create',
            'dinas'    => $dinas
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
            'dinas_tujuan' => 'required',
        ], [
            'no_surat_perintah.required' => 'No Surat Perintah Tidak Boleh Kosong',
            'tanggal_surat_perintah.required' => 'Tanggal Tidak Boleh Kosong',
            'pesan.required' => 'Pesan Tidak Boleh Kosong',
            'lokasi.required' => 'Lokasi Tidak Boleh Kosong',
            'status_laporan.required' => 'Status Laporan Tidak Boleh Kosong',
            'dinas_tujuan.required' => 'Dinas Tujuan Tidak Boleh Kosong',
        ]);
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
            'dinas_pembuat'     => $id,
            'dinas_tujuan'      => $request->dinas_tujuan,
        ]);
        if($add_perintah)
        {
            $emailDinasTujuan = Dinas::where('id',$request->dinas_tujuan)->get();
            $details = [
                'title' => 'Ada surat perintah',
                'body' => 'Ini ada surat perintah dengan no: '.$request->no_surat_perintah.'. Silahkan cek di web'
            ];

            try {
                Mail::to($emailDinasTujuan[0]['email'])->send(new \App\Mail\MyMail($details));
            } catch(\Exception $e){
                echo "Email gagal dikirim karena $e.";
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

        $arr_merge = array_merge($arr,$getNamaFile,$getNamaGambar,);
        // dd($arr_merge);
        $update_perintah = Perintah::findOrFail($request->id_edit)
            ->update($arr_merge);

        $get_email_pembuat = Dinas::find($request->dinas_pembuat);

        $get_email_tujuan = Dinas::find($request->dinas_tujuan);

        if($update_perintah)
        {
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
            $details = [
                'title' => 'Update perintah ',
                'body' => 'Perintah dengan no surat: '.$request->no_surat_perintah.' sudah di update. Silahkan cek di web.'
            ];
            if($id==$get_email_pembuat->id)
            {
                try {
                    Mail::to($get_email_tujuan->email)->send(new \App\Mail\MyMailUpdate($details));
                } catch(\Exception $e){
                    echo "Email gagal dikirim karena $e.";
                }
            }
            else
            {
                try {
                    Mail::to($get_email_pembuat->email)->send(new \App\Mail\MyMailUpdate($details));
                } catch(\Exception $e){
                    echo "Email gagal dikirim karena $e.";
                }
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
        $perintah_show = Perintah::find($request->id);

	    return response()->json($perintah_show);
    }

    public function softdeleted(Request $request)
    {
        $query = Perintah::find($request->id)->delete();
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
        $query = Perintah::find($request->id)->forceDelete();
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
