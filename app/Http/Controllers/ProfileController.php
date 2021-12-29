<?php

namespace App\Http\Controllers;

use App\Models\Dinas;
use App\Models\Profile;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{

    public function index()
    {
        $data = [
            'content' => 'rakyat.welcome',

        ];
        return view('rakyat.layout.index', ['data' => $data]);
    }

    public function about()
    {
        $about = Profile::all()->last();

        $data = [
            'content'  => 'rakyat.about',
            'informasi_pu' => $about
        ];

        return view('rakyat.layout.index', ['data' => $data]);
    }

    public function struktureorganisasi()
    {
        $struktur = Profile::all()->last();

        $data = [
            'content'  => 'rakyat.struktur',
            'struktur' => $struktur
        ];

        return view('rakyat.layout.index', ['data' => $data]);
    }

    public function visimisi()
    {
        $visimisi = Profile::all()->last();

        $data = [
            'content'  => 'rakyat.visimisi',
            'visimisi' => $visimisi
        ];

        return view('rakyat.layout.index', ['data' => $data]);
    }

    public function tugaspokok()
    {
        $tugaspokok = Profile::all()->last();

        $data = [
            'content'  => 'rakyat.tugas',
            'tugaspokok' => $tugaspokok
        ];

        return view('rakyat.layout.index', ['data' => $data]);

    }

    public function fungsi()
    {
        $fungsi = Profile::all()->last();

        $data = [
            'content'  => 'rakyat.fungsi',
            'fungsi' => $fungsi
        ];

        return view('rakyat.layout.index', ['data' => $data]);

    }


    public function indexadmin()
    {
        $profile = Profile::all();

        foreach($profile as $val)
        {
            $dinas = Dinas::select('*')
            ->where('id',$val->pegawai_dinas_id)
            ->get();

        }

        $data = [
            'content' => 'admin.config.view_profile_data',
            'profile' => $profile,
            'dinas' => $dinas,
        ];
        return view('admin.layout.index', ['data' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $profile = Profile::find($request->id);

        return response()->json($profile);
    }

    public function edit()
    {
        $profile = Profile::all()->last();
        $data = [
            'content' => 'admin.config.ganti_profile_perusahaan',
            'profile' => $profile,
        ];
        return view('admin.layout.index', ['data' => $data]);
    }

    public function update(Request $request, Profile $profile)
    {
        $file = $request->file('gambar');
        $id = Auth::guard('admin')->user()->id;

        if($file==null)
        {
            $nama_file = "";
        }
        else
        {
            $nama_file = time()."_".$file->getClientOriginalName();
        }


        $query = DB::table('profiles')
        ->insert([
            'informasi_pu'  => $request->informasipu,
            'visi'      => $request->misi,
            'misi'  => $request->visi,
            'struktur_organisasi'  => $nama_file,
            'tugas_pokok'      => $request->tugas,
            'fungsi'  => $request->fungsi,
            'pegawai_dinas_id' => $id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        if($query) {
            if($file!=null)
            {
                $tujuan_upload = 'profile';
		        $file->move($tujuan_upload,$nama_file);
            }
            return back()->with('success', 'Update Profile Company successfully.');
        } else {
            return back()->with('error', 'Update Profile Company unsuccessfully.');
        }

    }

}
