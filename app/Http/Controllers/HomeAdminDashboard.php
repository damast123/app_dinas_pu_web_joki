<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Perintah;

class HomeAdminDashboard extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengaduanCount = Pengaduan::count();
        $perintahCount = Perintah::count();
        $agendaCount = Agenda::count();
        $data = [
            'content'  => 'admin.home',
            'pengaduan_count'  => $pengaduanCount,
            'perintah_count'  => $perintahCount,
            'agenda_count'  => $agendaCount,
        ];
        return view('admin.layout.index', ['data' => $data]);
    }
}
