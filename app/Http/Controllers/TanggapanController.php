<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Carbon\Carbon;
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
        $tanggapan = Tanggapan::where('id_pengaduan', $id)->get()->all();
        return view('tanggapan.detail', compact('data', 'tanggapan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_tanggapan' => ['string', 'min:5', 'max:50', 'required'],
            'isi_tanggapan' => ['required'],
        ]);

        Tanggapan::create([
            'id_pengaduan' => $request->id_pengaduan, //mengambil data dari ID
            'judul_tanggapan' => $request->judul_tanggapan, //judul
            'isi_tanggapan' => $request->isi_tanggapan, //isi
            'tanggal_tanggapan' => Carbon::now()->format('Y-m-d H:i:s') //tanggal sekarang
        ]);

        $data = Pengaduan::findOrFail($request->id_pengaduan); //mengambil data dari detail yang dipilih
        $data->status = $request->status; //mengubah status apabila ada perubahan
        $data->save(); //menyimpan status

        return back()->with('success', 'Tanggapan berhasil dibuat');

    }

}
