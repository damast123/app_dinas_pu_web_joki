<?php
namespace App\Http\Controllers;


use App\Models\PetaWilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use File;

class PetaWilayahController extends Controller
{
    public function index()
    {
        $petawilayah = PetaWilayah::cursorPaginate(10);
        $dinas= [];
        foreach($petawilayah as $val)
        {
            $dinas[] = $val->dinas;
        }
        $data = [
            'content'  => 'rakyat.petawilayah',
            'petawilayah' => $petawilayah,
            'dinas' => $dinas
        ];
        return view('rakyat.layout.index', ['data' => $data]);
    }

    public function indexadmin()
    {
        $petawilayah = PetaWilayah::all();
        $dinas= [];
        foreach($petawilayah as $val)
        {
            $dinas[] = $val->dinas;
        }
        $data = [
            'content'  => 'admin.config.peta_wilayah',
            'petawilayah' => $petawilayah,
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
            'gambar'   => 'required|max:2048|mimes:jpeg,png,jpg,gif,svg',
            'file_doc'  => 'required|max:2048|mimes:doc,pdf,docx'
        ], [
            'gambar.required'               => 'Mohon masukkan gambar.',
            'gambar.max'                    => 'Gambar maksimal 2MB.',
            'gambar.mimes'                  => 'Gambar harus berformat jpeg, jpg, png.',
            'file_doc.required'             => 'Mohon masukkan file dokumen.',
            'file_doc.max'                  => 'File maksimal 2MB.',
            'file_doc.mimes'                => 'File harus berformat doc, docx, pdf.',
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $gambar = $request->file('gambar');
            $file = $request->file('file_doc');

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
            $query = PetaWilayah::create([
                'gambar'    => $nama_gambar,
                'file'      => $nama_file,
                'dinas_id'  => $id
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
        return view('view_peta.show');
        // $petawilayah = PetaWilayah::find($request->id)->get();

        // return response()->json($petawilayah);
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
}
