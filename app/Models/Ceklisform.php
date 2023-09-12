<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ceklisform extends Model
{
    protected $guarded = ['id'];
    use HasFactory;
    public function dpa()
    {
        return $this->belongsTo(DPA::class, 'dpa_id');
    }
}
