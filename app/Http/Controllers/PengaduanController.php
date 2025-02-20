<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    public function index()
    {
        $data = Pengaduan::where('id_user', Auth::user()->id)->get()->all(); //mengambil nilai pengaduan yang sesuai dengan id yang login
        return view('user.pengaduan.index', compact('data'));
    }

    public function create()
    {
        return view('user.pengaduan.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        // rules pengisian form.
        $request->validate([
            'judul_pengaduan' => ['required', 'min:5', 'max:50', 'string'], 
            'isi' => ['required'],
            'gambar' => ['required', 'max:10240'],
        ]);
        // kondisi ketika mengambil file gambar
        if($request->hasFile('gambar'))
        {
            $img = $request->file('gambar'); //mengambil nilai file yang ada pada request (gambar).
            $path = 'public/images/pengaduan'; //path menyimpan gambar.
            $ext = $img->getClientOriginalExtension();
            $nama = 'gambar_pengaduan_'.Carbon::now()->format('ymdhis').'.'.$ext; //nama file ketika disave. 
            $img->storeAs($path, $nama); // menyimpan ke path dan mengganti dengan nama baru yang sudah di definisikan di $nama
            $input['gambar'] = $nama; // nama value yang disimpan di database.
        }
        $input['id_user'] = Auth::user()->id; //mengambil id user yang sedang login
        $input['tanggal_pengaduan'] = Carbon::now()->format('Y-m-d h:i:s'); //waktu dibuat

        Pengaduan::create($input);
        return redirect()->route('pengaduan.index')->with('success', 'Data berhasil dibuat');
    }

    public function detail($id)
    {
        $data = Pengaduan::findOrFail($id);
        $tanggapan = Tanggapan::where('id_pengaduan', $id)->get()->all();
        return view('user.pengaduan.detail', compact('data', 'tanggapan'));
    }

}
