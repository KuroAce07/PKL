<?php

namespace App\Http\Controllers;

use App\Models\DPA;
use Illuminate\Http\Request;
use App\Models\Pengadaan;
use App\Models\Rekanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\User;



class PengadaanController extends Controller
{
    public function create_pengadaan($dpa_id)
    {
        $dpaData = DPA::where('id', $dpa_id)->get(); // Ubah query ini sesuai dengan cara Anda mendapatkan data DPA
        $users = User::where('role_id', 5)->get();
        $rekanans = Rekanan::all();
        $pejabatPengadaanUsers = User::where('role_id', 4)->get();
        
        return view('pengadaan.create_pengadaan', [
            'dpa_id' => $dpa_id,
            'dpaData' => $dpaData, 
            'rekanans' => $rekanans,
            'pejabatPengadaanUsers' => $pejabatPengadaanUsers,
            'users' => $users,// Teruskan data DPA ke view
        ]);
    }


    public function store_pengadaan(Request $request)
    {
        $data = $request->validate([
            'dpa_id' => 'required',
            'pilihan' => 'required',
            'nama_rekanan' => 'required',
            'keterangan' => 'required',
            'berkas' => 'nullable|file|mimes:jpeg,png,pdf',
        ]);
        // dd($data);

        if ($request->hasFile('berkas')) {
            $uploadedFile = $request->file('berkas');
            $destinationPath = public_path('uploads/berkas pemilihan'); // Update the path to match your project's directory structure
            $filename = $uploadedFile->getClientOriginalName();
        
            // Move the uploaded file to the destination directory
            $uploadedFile->move($destinationPath, $filename);
        
            $data['berkas'] = 'uploads/berkas pemilihan/' . $filename;
        }
        
        // Assign the dpa_id from the form input
        $data['dpa_id'] = $request->input('dpa_id');

        // Create a new Pengadaan record with the data
        Pengadaan::create($data);

        return redirect()->route('pengadaan.create_pengadaan', ['id' => $data['dpa_id']])
            ->with('success', 'Data berhasil disimpan.');
    }

    public function berkas() {
        $berkass = Pengadaan::with(['dpa'])->get();

        return view('pengadaan.index', [
            'berkass' => $berkass
        ]);
    }

    public function delete($id)
    {
        $berkas = Pengadaan::findOrFail($id);

        // Periksa apakah pengguna memiliki peran 'Pejabat Pengadaan'
        if (!Auth::user()->hasRole('Pejabat Pengadaan')) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus dokumen pemilihan.');
        }
        
        if ($berkas->berkas) {
            // Hapus berkas fisik dari sistem berkas
            File::delete(public_path($berkas->berkas));
        }

        // Hapus rekaman dari database
        $berkas->delete();

        return redirect()->route('pengadaan.index')->with('success', 'Dokumen pemilihan berhasil dihapus.');
    }
    public function edit($id)
    {
        $rekanans = Rekanan::all();
        $berkas = Pengadaan::find($id);
        if (!$berkas) {
            return redirect()->route('pengadaan.index')->with('error', 'Berkas not found.');
        }

        return view('pengadaan.edit', compact('berkas', 'rekanans'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        // Validasi data yang diubah
        $validatedData = $request->validate([
            'pilihan' => 'required',
            'keterangan' => 'required',
            'nama_rekanan' => 'required'
            // 'berkas' => 'nullable|file|mimes:jpeg,png,pdf',
            // Tambahkan validasi untuk field lain
        ]);

        // Temukan data berdasarkan ID
        $berkas = Pengadaan::findOrFail($id);

        // Update data dengan data yang baru
        $berkas->update($validatedData);

        return redirect()->route('pengadaan.index')->with('success', 'Berkas berhasil diperbarui.');
    }

}
