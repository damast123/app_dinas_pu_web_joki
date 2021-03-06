<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Dinas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class GalleryController extends Controller
{

    public function index()
    {
        $gallery = Gallery::all();

        $data = [
            'content' => 'rakyat.gallery_rakyat',
            'gallery' => $gallery
        ];
        return view('rakyat.layout.index', ['data' => $data]);
    }

    public function indexadmin()
    {
        $gallery = Gallery::all();
        $count = Gallery::all()->count();
        $dinas = [];
        foreach($gallery as $val)
        {
            $dinas[] = Dinas::select('*')
            ->where('id',$val->pegawai_dinas_id)
            ->get();

        }
        $data = [
            'content' => 'admin.config.gallery',
            'gallery' => $gallery,
            'dinas'   => $dinas,
            'count'   => $count
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
        $validation = Validator::make($request->all(), [
            'gambar'   => 'required|max:409600|mimes:jpeg,png,jpg,gif,svg,mpeg,ogg,mp4,webm,3gp,mov,mkv,flv,avi,wmv,ts',
            'title'  => 'required'
        ], [
            'gambar.required'   => 'Mohon masukkan file.',
            'gambar.max'        => 'File maksimal 400 MB.',
            'gambar.mimes'      => 'File harus berformat jpeg, jpg, png, gif, svg, mkv,mpeg, ogg, mp4, webm, 3gp, mov, flv, avi, wmv, ts.',
            'title.required'    => 'Mohon isi title.',
        ]);

        if($validation->fails()) {
            $response = [
                'status' => 422,
                'error'  => $validation->errors()
            ];
        } else {
            $id = Auth::guard('admin')->user()->id;
            $file = $request->file('gambar');

            if($file==null)
            {
                $nama_file = "";
            }
            else
            {
                $nama_file = time()."_".$file->getClientOriginalName();
            }

            $query = Gallery::create([
                'title'  => $request->title,
                'file'      => $nama_file,
                'keterangan'  => $request->keterangan,
                'pegawai_dinas_id' => $id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            if($query) {
                if($file!=null)
                {
                    $tujuan_upload = 'file_gallery';
                    $file->move($tujuan_upload,$nama_file);
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
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        //
    }
}
