<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bendahara;

class BendaharaController extends Controller
{
    public function create_spp($dpa_id)
    {
        
        return view('bendahara.create_spp',['dpa_id' => $dpa_id]);
    }
    public function create_spm($dpa_id)
    {
        return view('bendahara.create_spm',['dpa_id' => $dpa_id]);
    }
    public function create_sp2d($dpa_id)
    {
        return view('bendahara.create_sp2d',['dpa_id' => $dpa_id]);
    }

    public function store_spp(Request $request)
    {
        $data = $request->validate([
            'dpa_id' => 'required',
            'no_spp' => 'required',
            'no_sptjmspp' => 'required',
            'ket_spp' => 'required',
            'spp' => 'nullable|file|mimes:jpeg,png,pdf',
            'spyjmspp' => 'nullable|file|mimes:jpeg,png,pdf',
            'verif_spp' => 'nullable|file|mimes:jpeg,png,pdf',
        ]);

        $berkasFields = ['spp', 'sptjmspp', 'verifikasi_spp'];
        foreach ($berkasFields as $field) {
            if ($request->hasFile($field)) {
                $berkasPath = $request->file($field)->store($field, 'public');
                $data[$field] = $berkasPath;
            }
        }
        
    $data['dpa_id'] = $request->input('dpa_id');

    Bendahara::create($data);

    return redirect()->route('bendahara.create_spp', ['id' => $data['dpa_id']])
        ->with('success', 'Data berhasil disimpan.');
}
    
   
    public function store_spm(Request $request)
    {
        $data = $request->validate([
            'dpa_id' => 'required',
            'no_spm' => 'required',
            'no_sptjmspm' => 'required',
            'spm' => 'nullable|file|mimes:jpeg,png,pdf',
            'lampiran_sumber_dana' => 'nullable|file|mimes:jpeg,png,pdf',
            'sptjmspm' => 'nullable|file|mimes:jpeg,png,pdf',
        ]);

    $berkasFields = ['spm', 'sptjmspm', 'lampiran_sumber_dana'];
    foreach ($berkasFields as $field) {
        if ($request->hasFile($field)) {
            $berkasPath = $request->file($field)->store($field, 'public');
            $data[$field] = $berkasPath;
        }
    }
    $data['dpa_id'] = $request->input('dpa_id');

    $data1 = Bendahara::first();
    if ($data1) {
        $data1->update($data);
    }


    return redirect()->route('bendahara.create_spm', ['id' => $data['dpa_id']])
        ->with('success', 'Data berhasil disimpan.');
    }
    public function store_sp2d(Request $request)
    {
        $data = $request->validate([
            'dpa_id' => 'required',
            'no_sp2d' => 'required',
            'tanggal' => 'required',
            'ket_sp2d' => 'required',
            'sp2d' => 'nullable|file|mimes:jpeg,png,pdf',
        ]);

    $berkasFields = ['sp2d'];
    foreach ($berkasFields as $field) {
        if ($request->hasFile($field)) {
            $berkasPath = $request->file($field)->store($field, 'public');
            $data[$field] = $berkasPath;
        }
    }
    $data['dpa_id'] = $request->input('dpa_id');

    $data1 = Bendahara::first();
    if ($data1) {
        $data1->update($data);
    }


    return redirect()->route('bendahara.create_spp', ['id' => $data['dpa_id']])
        ->with('success', 'Data berhasil disimpan.');
    }
}