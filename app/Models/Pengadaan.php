<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengadaan extends Model
{
    protected $fillable = ['pilihan', 'keterangan', 'berkas', 'dpa_id', 'nama_rekanan'];
    use HasFactory;

    public function dpa()
    {
        return $this->belongsTo(DPA::class, 'dpa_id');
    }
}
