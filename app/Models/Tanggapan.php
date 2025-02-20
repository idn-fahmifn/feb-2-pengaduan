<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    protected $table = 'tanggapan';
    protected $guarded;

    protected $casts = ['tanggal_tanggapan' => 'datetime'];

    public function pengaduan()
    {
        $this->belongsTo(Pengaduan::class, 'id_pengaduan');
    }
}
