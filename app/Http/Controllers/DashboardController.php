<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function dashboard()
    {
        $pending = Pengaduan::where('status', 'pending')->count();
        $proses = Pengaduan::where('status', 'proses')->count();
        $selesai = Pengaduan::where('status', 'selesai')->count();
        $ditolak = Pengaduan::where('status', 'ditolak')->count();
        return view('dashboard', compact('pending', 'proses', 'selesai', 'ditolak'));
    }
}
