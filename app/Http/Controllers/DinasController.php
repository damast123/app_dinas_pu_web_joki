<?php

namespace App\Http\Controllers;

use App\Models\Dinas;
use Illuminate\Http\Request;

class DinasController extends Controller
{
    public function index()
    {
        $dinas = Dinas::all();
        $role = [];
        $jabatan = [];
        foreach($dinas as $val)
        {
            $role[] = $val->role;
            $jabatan[] = $val->jabatan;
        }
        $data = [
            'content' => 'admin.config.dinas',
            'dinas' => $dinas,
            'role' => $role,
            'jabatan' => $jabatan,
        ];
        return view('admin.layout.index', ['data' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dinas  $dinas
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $dinas_show = Dinas::find($request->id);

	    return response()->json($dinas_show);
    }
}
