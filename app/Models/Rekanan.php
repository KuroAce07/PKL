<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekanan extends Model
{
    protected $fillable = [
        'kode_rekanan', // Add other fields here as needed
        'jenis_rekanan',
        'nik_rekanan',
        'nomor_npwp',
        'nama_rekanan',
        'nama_instansi',
        'jenis_usaha',
        'nama_bank',
        'nama_cabang',
        'nomor_rekening',
        'nama_rekening',
        'telepon',
        'alamat',
    ];
    use HasFactory;
}
