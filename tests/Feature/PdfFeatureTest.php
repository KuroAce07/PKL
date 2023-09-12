<?php

// tests/Feature/PdfFeatureTest.php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PdfFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_pdf_upload_and_extraction()
    {
        Storage::fake('pdfs');

        // Create a sample PDF file and store it in the "storage/app/pdfs" directory
        $pdfFile = UploadedFile::fake()->create('sample.pdf', 2048, 'application/pdf');
        Storage::disk('pdfs')->putFileAs('', $pdfFile, 'sample.pdf');

        // Simulate the PDF upload request
        $response = $this->post('/upload-pdf', ['pdf_file' => $pdfFile]);

        // Assert that the response is successful
        $response->assertStatus(200);

        // Assert that the view contains the extracted text
        $response->assertSee('Extracted PDF Text');

        // Assert that the view contains the table with the extracted text
        $response->assertSee('<table');
    }
}
