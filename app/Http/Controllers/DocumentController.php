<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::all();
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        return view('documents.create');
    }

    public function store(Request $request)
    {
    $validatedData = $request->validate([
        'nama_dokumen' => 'required',
        'tanggal' => 'required|date',
        'keterangan' => 'required',
        'tipe_dokumen' => 'required',
        'file' => 'required|mimes:pdf,doc,docx|max:2048',
    ]);

    $file = $request->file('file');
    $file_path = $file->store('documents');

    $document = new Document([
        'nama_dokumen' => $validatedData['nama_dokumen'],
        'tanggal' => $validatedData['tanggal'],
        'keterangan' => $validatedData['keterangan'],
        'tipe_dokumen' => $validatedData['tipe_dokumen'],
        'file_path' => $file_path,
    ]);

    $document->save();

    return redirect()->route('documents.index')->with('success', 'Document created successfully');
    }

    public function edit(Document $document)
    {
    return view('documents.edit', compact('document'));
    }

    public function download(Document $document)
    {
    $filePath = $document->file_path;

    if (Storage::exists($filePath)) {
        return response()->download(storage_path('app/' . $filePath));
    } else {
        // Handle file not found scenario
        // For example, you can redirect back with an error message
        return redirect()->back()->with('error', 'File not found.');
    }
    }


    // ... other methods ...

}
