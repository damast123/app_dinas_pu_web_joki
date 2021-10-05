<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
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
        $about = Profile::all();

        $data = [
            'content'  => 'rakyat.about',
            'informasi_pu' => $about
        ];

        return view('rakyat.layout.index', ['data' => $data]);
    }

    public function struktureorganisasi()
    {
        $struktur = Profile::all();

        $data = [
            'content'  => 'rakyat.struktur',
            'struktur' => $struktur
        ];

        return view('rakyat.layout.index', ['data' => $data]);
    }

    public function visimisi()
    {
        $visimisi = Profile::all();

        $data = [
            'content'  => 'rakyat.visimisi',
            'visimisi' => $visimisi
        ];

        return view('rakyat.layout.index', ['data' => $data]);
    }

    public function tugaspokok()
    {
        $tugaspokok = Profile::all();

        $data = [
            'content'  => 'rakyat.tugas',
            'tugaspokok' => $tugaspokok
        ];

        return view('rakyat.layout.index', ['data' => $data]);

    }

    public function fungsi()
    {
        $fungsi = Profile::all();

        $data = [
            'content'  => 'rakyat.fungsi',
            'fungsi' => $fungsi
        ];

        return view('rakyat.layout.index', ['data' => $data]);

    }


    public function indexadmin()
    {
        $profile = Profile::all();
        $data = [
            'content' => 'admin.config.ganti_profile_perusahaan',
            'profile' => $profile,
        ];
        return view('admin.layout.index', ['data' => $data]);
    }

    public function update(Request $request, Profile $profile)
    {
        $file = $request->file('gambar');
        if($file==null)
        {
            $nama_file = "";
        }
        else
        {
            $nama_file = "1.png";
        }


        $query = DB::table('profiles')
        ->update([
            'informasi_pu'  => $request->informasipu,
            'visi'      => $request->misi,
            'misi'  => $request->visi,
            'struktur_organisasi'  => $nama_file,
            'tugas_pokok'      => $request->tugas,
            'fungsi'  => $request->fungsi,
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
