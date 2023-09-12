<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class addmetodepengadaan extends Model
{
    use HasFactory;
    protected $table = 'metodepengadaan';
    protected $fillable = [
        'metode_pengadaan',
        'keterangan',
    ];
}
