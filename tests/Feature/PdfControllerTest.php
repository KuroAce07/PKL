<?php

// tests/Feature/PdfControllerTest.php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToText\Pdf;
use Tests\TestCase;

class PdfControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_pdf_text_extraction()
    {
        Storage::fake('pdfs');
        
        // Create a sample PDF file and store it in the "storage/app/pdfs" directory
        $pdfFile = UploadedFile::fake()->create('sample.pdf', 2048, 'application/pdf');
        Storage::disk('pdfs')->putFileAs('', $pdfFile, 'sample.pdf');

        // Simulate the PDF upload request
        $response = $this->post('/upload-pdf', ['pdf_file' => $pdfFile]);

        // Ensure the response contains the extracted text
        $response->assertSeeText(Pdf::getText($pdfFile));
    }
}
