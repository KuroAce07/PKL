<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RisalahKontrak extends Model
{
    use HasFactory;

protected $fillable = [
   
    'kode_program_kegiatan',
    'nama_program',
    'nama_kegiatan',
    'nama_paket_pekerjaan',
    'lokasi_pekerjaan',
    'sumber_dana',
    'nama_pelaksana_pekerjaan',
    'jenis_usaha',
    'alamat_pelaksana_pekerjaan',
    'nama_pimpinan_direktur',
    'npwp',
    'nomor_kontrak',
    'tanggal_kontrak',
    'nilai_kontrak',
    'nomor_rekening_bank',
    'nama_rekening',
    'metode_pengadaan',
    'adendum_kontrak',
    'keterangan',
    'upload_dokumen',
    'approval',
    'alasan',
    'dpa_id',
];

    public function dpa()
    {
        return $this->belongsTo(DPA::class, 'dpa_id');
    }
}

