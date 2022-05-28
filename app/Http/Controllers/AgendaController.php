<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Dinas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AgendaController extends Controller
{

    public function index()
    {
        $date = Carbon::now();
        $agenda = Agenda::whereDate('tanggal_mulai','>=',$date->toDateTimeString())->cursorPaginate(10);
        $agenda_sebelum = Agenda::whereDate('tanggal_mulai','<',$date->toDateTimeString())->get();
        $dinas = [];
        foreach($agenda as $val)
        {
            $dinas[] = Dinas::select('*')
            ->where('id',$val->pegawai_dinas_id)
            ->get();
        }
        $data = [
            'content'  => 'rakyat.agenda',
            'agenda' => $agenda,
            'agenda_sebelum' => $agenda_sebelum,
            'dinas' => $dinas
        ];

        return view('rakyat.layout.index', ['data' => $data]);
    }
    public function indexadmin()
    {
        $agenda = Agenda::all();
        $dinas = [];
        foreach($agenda as $value)
        {
            $dinas[] = Dinas::select('*')
            ->where('id',$value->pegawai_dinas_id)
            ->get();
        }
        $data = [
            'content'  => 'admin.agenda.index',
            'agenda' => $agenda,
            'dinas' => $dinas
        ];
        return view('admin.layout.index', ['data' => $data]);
    }


    public function create()
    {
        $data = [
            'content' => 'admin.agenda.create'
        ];
        return view('admin.layout.index', ['data' => $data]);
    }


    public function store(Request $request)
    {
        $id = Auth::guard('admin')->user()->id;
        $request->validate([
            'nama_event' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_akhir' => 'required',
            'jam' => 'required',
            'tempat_event' => 'required',
            'isi_event' => 'required'
        ], [
            'nama_event.required' => 'Nama Event Tidak Boleh Kosong',
            'tanggal_mulai.required' => 'Tanggal Tidak Boleh Kosong',
            'tanggal_akhir.required' => 'Tanggal Tidak Boleh Kosong',
            'jam.required' => 'Jam Tidak Boleh Kosong',
            'tempat_event.required' => 'Tempat Event Tidak Boleh Kosong',
            'isi_event.required' => 'Isi Event Tidak Boleh Kosong',
        ]);

        $add_agenda = Agenda::create([
            'nama_event'      => $request->nama_event,
            'tanggal_mulai'  => $request->tanggal_mulai,
            'tanggal_akhir'      => $request->tanggal_akhir,
            'jam'      => $request->jam,
            'isi_event'  => $request->isi_event,
            'tempat_event' => $request->tempat_event,
            'pegawai_dinas_id' => $id,
        ]);
        if($add_agenda)
        {
            return back()->with('success', 'Sukses membuat agenda.');
        }
        else
        {
            return back()->with('error', 'Gagal membuat agenda.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $agenda_show = Agenda::find($request->id);

	    return response()->json($agenda_show);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $agenda = Agenda::find($request->id);

	    return response()->json($agenda);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'nama_event' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_akhir' => 'required',
            'jam' => 'required',
            'tempat_event' => 'required',
            'isi_event' => 'required'
        ], [
            'nama_event.required' => 'Nama Event Tidak Boleh Kosong',
            'tanggal_mulai.required' => 'Tanggal Tidak Boleh Kosong',
            'tanggal_akhir.required' => 'Tanggal Tidak Boleh Kosong',
            'jam.required' => 'Jam Tidak Boleh Kosong',
            'tempat_event.required' => 'Tempat Event Tidak Boleh Kosong',
            'isi_event.required' => 'Isi Event Tidak Boleh Kosong',
        ]);
        $update_agenda = Agenda::where('id',$request->id)
        ->update([
            'nama_event'      => $request->nama_event,
            'tanggal_mulai'  => $request->tanggal_mulai,
            'tanggal_akhir'      => $request->tanggal_akhir,
            'jam'      => $request->jam,
            'isi_event'  => $request->isi_event,
            'tempat_event' => $request->tempat_event,
        ]);
        if($update_agenda) {
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
