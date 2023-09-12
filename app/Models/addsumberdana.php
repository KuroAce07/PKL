<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class addsumberdana extends Model
{
    use HasFactory;
    protected $table = 'sumberdana';
    protected $fillable = [
        'sumber_dana',
        'keterangan',
        // ... add other fillable columns as needed
    ];
}
