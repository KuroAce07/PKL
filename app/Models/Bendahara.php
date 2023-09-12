<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bendahara extends Model
{
    //protected $fillable = ['spp', 'sptjmspp', 'sp2d', 'verif_spp', 'no_spp', 'no_sptjmspp',  'no_sp2d',  'ket_spp',  'ket_sp2d', 'tanggal', 'dpa_id'];
    protected $guarded = ['id'];
    use HasFactory;
}
