<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PilihRekanan extends Model
{
    protected $table = 'pilih_rekanans';
    protected $fillable = ['pilih', 'detail', 'jenis_pengadaan', 'keterangan', 'approval', 'alasan',];

    public function dpa()
    {
        return $this->belongsTo(DPA::class, 'dpa_id');
    }
}
