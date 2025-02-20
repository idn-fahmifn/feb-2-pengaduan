<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class TanggapanController extends Controller
{
    public function index()
    {
        $data = Pengaduan::paginate(10);
        return view('tanggapan.index', compact('data'));
    }

    public function detail($id)
    {
        $data = Pengaduan::findOrFail($id); //mengambil nilai tanggapannya.
        return view('tanggapan.detail', compact('data'));
    }

}
