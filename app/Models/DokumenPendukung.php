<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenPendukung extends Model
{
    protected $table = 'dokumen_pendukungs';

    protected $fillable = [
        'nama', // Add 'nama' field to the fillable array
        'tanggal',
        'keterangan',
        'upload_dokumen',
        'approval',
        'alasan',
    ];

    public function dpa()
    {
        return $this->belongsTo(DPA::class, 'dpa_id');
    }
}
