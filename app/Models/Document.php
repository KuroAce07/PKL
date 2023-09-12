<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['nama_dokumen', 'tanggal', 'keterangan', 'tipe_dokumen', 'file_path'];
}
