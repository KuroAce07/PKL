<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bast extends Model
{
    protected $table = 'basts';

    protected $fillable = ['nomor', 'tanggal', 'keterangan', 'upload_dokumen', 'approval', 'alasan',];

    public function dpa()
    {
        return $this->belongsTo(DPA::class, 'dpa_id');
    }
}
