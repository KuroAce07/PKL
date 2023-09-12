<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PdfText extends Model
{
    use HasFactory;
    protected $fillable = ['pdf_file', 'extracted_text'];
}
