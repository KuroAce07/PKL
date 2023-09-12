<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenKontrak extends Model
{
    protected $table = 'dokumen_kontraks';

    protected $fillable = [
        'no_bukti',
        'nama_kegiatan_transaksi',
        'tanggal_kontrak',
        'jumlah_uang',
        'potongan_lain',
        'ppn',
        'pph',
        'jumlah_potongan',
        'jumlah_total',
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
