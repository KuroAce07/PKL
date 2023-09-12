<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Rekanan;

class RekananController extends Controller
{
    public function index()
    {
        $rekanans = Rekanan::all();
        return view('rekanan.index', compact('rekanans'));
    }
    public function create()
{
    return view('rekanan.create'); 
}
public function edit($id)
{
    $rekanan = Rekanan::findOrFail($id);
    return view('rekanan.edit', compact('rekanan'));
}
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'kode_rekanan' => 'required',
        'jenis_rekanan' => 'required|in:Perorangan,Perusahaan',
        'nama_rekanan' => 'required',
        'nik_rekanan' => 'nullable',
        'nomor_npwp' => 'nullable',
        'nama_instansi' => 'nullable',
        'jenis_usaha' => 'nullable',
        'nama_bank' => 'nullable',
        'nama_cabang' => 'nullable',
        'nomor_rekening' => 'nullable',
        'nama_rekening' => 'nullable',
        'telepon' => 'nullable',
        'alamat' => 'nullable',
    ]);

    Rekanan::create($validatedData);

    return redirect()->route('rekanan.create')->with('success', 'Rekanan created successfully!');
}
public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'kode_rekanan' => 'required',
        'jenis_rekanan' => 'required|in:Perorangan,Perusahaan',
        'nama_rekanan' => 'required',
        'nik_rekanan' => 'nullable',
        'nomor_npwp' => 'nullable',
        'nama_instansi' => 'nullable',
        'jenis_usaha' => 'nullable',
        'nama_bank' => 'nullable',
        'nama_cabang' => 'nullable',
        'nomor_rekening' => 'nullable',
        'nama_rekening' => 'nullable',
        'telepon' => 'nullable',
        'alamat' => 'nullable',
    ]);

    $rekanan = Rekanan::findOrFail($id);
    $rekanan->update($validatedData);

    return redirect()->route('rekanan.index')->with('success', 'Rekanan updated successfully!');
}

    // Other controller methods for CRUD operations
}
