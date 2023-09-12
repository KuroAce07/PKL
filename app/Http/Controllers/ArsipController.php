<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\ArsipLama;
use App\Models\Bendahara;
use App\Imports\ArsipLamaImport;
use App\Exports\exportdokumenpencairan;

class ArsipController extends Controller
{
    public function index()
    {
        $arsipList = ArsipLama::paginate(10); // Change the pagination value as needed
        return view('Arsip.index', compact('arsipList'));
    }

    public function edit($id)
    {
        $arsip = ArsipLama::findOrFail($id);
        return view('Arsip.edit', compact('arsip'));
    }
    
    public function file($id)
{
    $arsip = ArsipLama::findOrFail($id);
    
    // Get the related Bendahara record based on the 'tipe' in ArsipLama
    $bendahara = Bendahara::where('dpa_id', $arsip->tipe)->first();

    // Initialize an empty array of indicators
    $indicators = [
        'spp' => null,
        'sptjmspp' => null,
        'verif_spp' => null,
        'spm' => null,
        'sptjmspm' => null,
        'lampiran_sumber_dana' => null,
        'sp2d' => null,
    ];

    // Check if Bendahara record exists, and if so, populate the indicators
    if ($bendahara) {
        $indicators = [
            'spp' => $bendahara->spp,
            'sptjmspp' => $bendahara->sptjmspp,
            'verif_spp' => $bendahara->verif_spp,
            'spm' => $bendahara->spm,
            'sptjmspm' => $bendahara->sptjmspm,
            'lampiran_sumber_dana' => $bendahara->lampiran_sumber_dana,
            'sp2d' => $bendahara->sp2d,
        ];
    }

    return view('Arsip.file', compact('arsip', 'indicators'));
}

public function storefile(Request $request, $id)
{
    // Find the ArsipLama record
    $arsip = ArsipLama::findOrFail($id);

    // Check if a Bendahara record with the same 'dpa_id' already exists
    $bendahara = Bendahara::firstOrNew(['dpa_id' => $arsip->tipe]);

    // Define the fields that correspond to file uploads
    $fileFields = ['spp', 'sptjmspp', 'verif_spp', 'spm', 'sptjmspm', 'lampiran_sumber_dana', 'sp2d'];

    foreach ($fileFields as $field) {
        if ($request->hasFile($field)) {
            // Store the file in a subdirectory based on the field name
            $berkasPath = $request->file($field)->store($field, 'public');
            $bendahara->$field = $berkasPath;
        }
        // If the field is already filled, don't change it
        // If the field is not filled and no file is uploaded, it will remain as is
    }

    // Save the Bendahara record
    $bendahara->save();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Files uploaded and stored successfully.');
}



    public function update(Request $request, $id)
    {
        $arsip = ArsipLama::findOrFail($id);
        $arsip->update($request->all());

        return redirect()->route('Arsip.index')->with('success', 'Document updated successfully.');
    }
    public function create()
{
    return view('Arsip.create'); // Assuming your view file is named create.blade.php
}

public function importfile()
{
    return view('Arsip.importfile'); // Assuming your view file is named create.blade.php
}

public function destroy($id)
    {
        // Find the Arsip record by ID and delete it
        $arsip = Arsiplama::findOrFail($id);
        $arsip->delete();

        return redirect()->route('Arsip.index')->with('success', 'Document record deleted successfully');
    }

public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'no_spm' => 'required',
            'tanggal_spm' => 'required',
            'sumber_dana' => 'required',
            'uraian_belanja' => 'required',
            'sub_kegiatan' => 'required',
            'kegiatan' => 'required',
            'nama' => 'required',
            // Add other validation rules for your fields
        ]);

        // Create a new ArsipLama instance with the validated data
        $arsip = new ArsipLama();
        $arsip->no_spm = $request->input('no_spm');
        $arsip->tanggal_spm = $request->input('tanggal_spm');
        $arsip->nilai_spm = $request->input('nilai_spm');
        $arsip->sumber_dana = $request->input('sumber_dana');
        $arsip->uraian_belanja = $request->input('uraian_belanja');
        $arsip->sub_kegiatan = $request->input('sub_kegiatan');
        $arsip->kegiatan = $request->input('kegiatan');
        $arsip->nama = $request->input('nama');
        $arsip->pph_21 = $request->input('pph_21');
        $arsip->pph_22 = $request->input('pph_22');
        $arsip->pph_23 = $request->input('pph_23');
        $arsip->ppn = $request->input('ppn');
        $arsip->ppnd = $request->input('ppnd');
        $arsip->lain_lain = $request->input('lain_lain');
        $arsip->tanggal_sp2d = $request->input('tanggal_sp2d');
        $arsip->no_sp2d = $request->input('no_sp2d');
        
        // Save the new ArsipLama instance to the database
        $arsip->save();

        return redirect()->route('Arsip.index')->with('success', 'Document data created successfully.');
    }
    
    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);
    
        try {
            $file = $request->file('file');
    
            // Import the data from the Excel file using the ArsipLamaImport class
            Excel::import(new ArsipLamaImport, $file);
    
            return redirect()->route('Arsip.index')->with('success', 'File imported successfully.');
        } catch (\Exception $e) {
            return redirect()->route('Arsip.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function export()
    {
        return Excel::download(new exportdokumenpencairan, 'dokumen_pencairan.xlsx');
    }
}
