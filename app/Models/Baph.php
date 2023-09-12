<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Baph extends Model
{
    protected $table = 'baphs';
    protected $fillable = ['nomor', 'tanggal', 'keterangan', 'upload_dokumen', 'approval', 'alasan',];// Add the approval attribute to the $fillable array];

    public function dpa()
    {
        return $this->belongsTo(DPA::class, 'dpa_id');
    }
}