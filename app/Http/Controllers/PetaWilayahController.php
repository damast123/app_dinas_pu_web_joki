<?php
namespace App\Http\Controllers;


use App\Models\PetaWilayah;
use App\Models\Daerah;
use App\Models\Dinas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class PetaWilayahController extends Controller
{
    public function index()
    {
        $petawilayah = PetaWilayah::cursorPaginate(10);
        $dinas= [];
        $daerah=[];

        foreach($petawilayah as $val)
        {
            $dinas = Dinas::select('*')
            ->where('id',$val->pegawai_dinas_id)
            ->get();
            $daerah = Daerah::select('*')
            ->where('id',$val->daerah_id)
            ->get();
        }
        $data = [
            'content'  => 'rakyat.peta_wilayah.index',
            'petawilayah' => $petawilayah,
            'dinas' => $dinas,
            'daerah' => $daerah
        ];
        return view('rakyat.layout.index', ['data' => $data]);
    }

    public function indexadmin()
    {
        $petawilayah = PetaWilayah::all();

        $dinas= [];

        $daerah=[];

        $input_daerah= Daerah::all();

        foreach($petawilayah as $value)
        {
            $dinas = Dinas::select('*')
            ->where('id',$value->pegawai_dinas_id)
            ->get();
            $daerah = Daerah::select('*')
            ->where('id',$value->daerah_id)
            ->get();

        }
        $data = [
            'content'  => 'admin.config.peta_wilayah',
            'petawilayah' => $petawilayah,
            'dinas' => $dinas,
            'daerah' => $daerah,
            'input_daerah' => $input_daerah,
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
        //
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
            'gambar'       => 'required|max:2048|mimes:jpeg,png,jpg,gif,svg',
            'file_doc'     => 'required|max:2048|mimes:doc,pdf,docx',
            'input_link'   => 'required',
            'input_daerah' => 'required'
        ], [
            'gambar.required'               => 'Mohon masukkan gambar.',
            'gambar.max'                    => 'Gambar maksimal 2MB.',
            'gambar.mimes'                  => 'Gambar harus berformat jpeg, jpg, png.',
            'file_doc.required'             => 'Mohon masukkan file dokumen.',
            'file_doc.max'                  => 'File maksimal 2MB.',
            'file_doc.mimes'                => 'File harus berformat doc, docx, pdf.',
            'input_link'                    => 'Mohon input link google earth',
            'input_daerah'                  => 'Mohon pilih daerah'
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $gambar = $request->file('gambar');
            $file = $request->file('file_doc');
            $link = $request->input_link;
            $daerah_input = $request->input_daerah;
            $judul_input = $request->input_judul;
            $desc = $request->input_desc;

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
            $id = Auth::guard('admin')->user()->id;
            $date = Carbon::now();

            $query = PetaWilayah::create([
                'judul'             => $judul_input,
                'tanggal_dibuat'    => $date,
                'deskripsi'         => $desc,
                'file'              => $nama_file,
                'gambar'            => $nama_gambar,
                'link'              => $link,
                'pegawai_dinas_id'  => $id,
                'daerah_id'         => $daerah_input,
            ]);

            if($query) {
                if($file!=null)
                {
                    $tujuan_upload_file = 'petawilayahfile';
                    $file->move($tujuan_upload_file,$nama_file);
                }
                if($gambar!=null)
                {
                    $tujuan_upload_gambar = 'petawilayahgambar';
                    $gambar->move($tujuan_upload_gambar,$nama_gambar);
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
        }

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PetaWilayah  $petaWilayah
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $petawilayah = PetaWilayah::find($request->id)->get();

        // return view('view_peta.show');
        return response()->json($petawilayah);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PetaWilayah  $petaWilayah
     * @return \Illuminate\Http\Response
     */
    public function showrakyat($id)
    {
        $petawilayah = PetaWilayah::find($id);

        $dinas = Dinas::find($petawilayah->pegawai_dinas_id);
        $daerah = Daerah::find($petawilayah->daerah_id);

        $data = [
            'content'  => 'rakyat.peta_wilayah.show',
            'petawilayah' => $petawilayah,
            'dinas' => $dinas,
            'daerah' => $daerah
        ];
        return view('rakyat.layout.index', ['data' => $data]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PetaWilayah  $petaWilayah
     * @return \Illuminate\Http\Response
     */
    public function edit(PetaWilayah $petaWilayah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PetaWilayah  $petaWilayah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PetaWilayah $petaWilayah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PetaWilayah  $petaWilayah
     * @return \Illuminate\Http\Response
     */
    public function destroy(PetaWilayah $petaWilayah)
    {
        //
    }

    public function getDownload($filename){

        $path = public_path('petawilayahfile/'.$filename);

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
