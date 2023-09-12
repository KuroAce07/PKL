<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bendahara;
use App\Models\Rekanan;
use App\Models\DPA;
use App\Models\User;
use App\Models\RisalahKontrak;
use App\Models\ArsipLama;
use Illuminate\Pagination\LengthAwarePaginator;

class BendaharaController extends Controller
{
    public function create_spp($dpa_id)
    {
        $dpaData = DPA::where('id', $dpa_id)->get(); // Ubah query ini sesuai dengan cara Anda mendapatkan data DPA
        $users = User::where('role_id', 5)->get();
        $rekanans = Rekanan::all();
        $pejabatPengadaanUsers = User::where('role_id', 6)->get();
        
        return view('bendahara.create_spp',[
            'dpa_id' => $dpa_id,
            'dpaData' => $dpaData, 
            'rekanans' => $rekanans,
            'pejabatPengadaanUsers' => $pejabatPengadaanUsers,
            'users' => $users,// Teruskan data DPA ke view
        ]);
    }
    public function create_spm($dpa_id)
    {
        $dpaData = DPA::where('id', $dpa_id)->get(); // Ubah query ini sesuai dengan cara Anda mendapatkan data DPA
        $users = User::where('role_id', 5)->get();
        $rekanans = Rekanan::all();
        $pejabatPengadaanUsers = User::where('role_id', 6)->get();

        return view('bendahara.create_spm',[
            'dpa_id' => $dpa_id,
            'dpaData' => $dpaData, 
            'rekanans' => $rekanans,
            'pejabatPengadaanUsers' => $pejabatPengadaanUsers,
            'users' => $users,
        ]);
    }
    public function create_sp2d($dpa_id)
    {
        $dpaData = DPA::where('id', $dpa_id)->get(); // Ubah query ini sesuai dengan cara Anda mendapatkan data DPA
        $users = User::where('role_id', 5)->get();
        $rekanans = Rekanan::all();
        $pejabatPengadaanUsers = User::where('role_id', 6)->get();

        return view('bendahara.create_sp2d',[
            'dpa_id' => $dpa_id,
            'dpaData' => $dpaData, 
            'rekanans' => $rekanans,
            'pejabatPengadaanUsers' => $pejabatPengadaanUsers,
            'users' => $users,
        ]);
    }

    public function store_spp(Request $request)
    {
        $data = $request->validate([
            'dpa_id' => 'required',
            'no_spp' => 'required',
            'no_sptjmspp' => 'required',
            'nilai_spp' => 'required',
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
            'nilai_spm' => 'required',
            'ket_spm' => 'required',
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
            'nilai_sp2d' => 'required',
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

    public function ViewDPA($ke)
    {
        // $column = $request->input('column');
        // Subquery to select the maximum 'id' for each 'id_dpa'
        $subquery = DPA::selectRaw('MAX(id) as max_id')
        ->groupBy('id_dpa');

        // Query to retrieve DPA data by joining with the subquery
        $dpaData = DPA::joinSub($subquery, 'max_ids', function ($join) {
            $join->on('dpa.id', '=', 'max_ids.max_id');
        })
        ->orderBy('id_dpa')
        ->get(); // Get all data


        // Check if the logged-in user has role_id 1 (admin) and allow access to all DPAs
        if (auth()->user()->role_id === 1) {
            // No need to filter if the user is an admin
            $accessibleDpaData = $dpaData;
        } else {
            // Filter DPAs based on user access
            $filteredDpaData = $dpaData->filter(function ($dpa) {
                return $this->canViewDpa($dpa);
            });

            // Create a LengthAwarePaginator instance for the filtered data
            $perPage = 10;
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $currentPageItems = $filteredDpaData->slice(($currentPage - 1) * $perPage, $perPage)->all();
            $accessibleDpaData = new LengthAwarePaginator($currentPageItems, count($filteredDpaData), $perPage);
        }

        $users = User::where('role_id', 3)->get();
        $pejabatPengadaanUsers = User::where('role_id', 4)->get();
        $pembantupptkUsers = User::where('role_id', 5)->get();
        $bendaharaUsers = User::where('role_id', 6)->get();

        return view('ViewDPA.index', [
            'dpaData' => $accessibleDpaData,
            'users' => $users,
            'pejabatPengadaanUsers' => $pejabatPengadaanUsers,
            'pembantupptkUsers' => $pembantupptkUsers,
            'bendaharaUsers' => $bendaharaUsers,
            'ke' => $ke,
            // 'column' => $column, // Pass the column value to your view
        ]);
    }
    public function submit($dpa_id){
        $dpaData = DPA::find($dpa_id); // Use find instead of get to retrieve a single DPA record by its ID
    
        if (!$dpaData) {
            return redirect()->back()->with('error', 'DPA not found.'); // Handle the case where DPA doesn't exist
        }
    
        // Retrieve the data from the selected row in table bendaharas
        $bendaharaData = Bendahara::where('dpa_id', $dpa_id)->first();
    
        if (!$bendaharaData) {
            return redirect()->back()->with('error', 'Bendahara data not found for this DPA.');
        }
    
        // Retrieve additional data from the DPA table based on the same dpa_id
        $additionalData = DPA::select('nama_akun', 'nama_kegiatan', 'nama_sub_kegiatan', 'nama_skpd')
            ->where('id_dpa', $dpa_id)
            ->first();
    
        // Retrieve 'sumber_dana' data from the 'risalah_kontraks' table based on 'dpa_id'
        $sumberDanaData = RisalahKontrak::where('dpa_id', $dpa_id)->pluck('sumber_dana')->first();
    
        // Set the columns from all tables to update or insert into table arsip_lama
        $arsipLamaData = [
            'no_spm' => $bendaharaData->no_spm,
            'nilai_spm' => $bendaharaData->nilai_spm,
            'no_sp2d' => $bendaharaData->no_sp2d,
            'tipe' => $bendaharaData->dpa_id, // Assuming 'tipe' should be set to 'dpa_id'
            'tanggal_spm' => now(), // Set the 'tanggal_spm' column to the current date
            'uraian_belanja' => $additionalData->nama_akun,
            'nama_sub_kegiatan' => $additionalData->nama_kegiatan,
            'sub_kegiatan' => $additionalData->nama_sub_kegiatan,
            'nama' => $additionalData->nama_skpd,
            'sumber_dana' => $sumberDanaData, // Add 'sumber_dana' from 'risalah_kontraks'
        ];
    
        // Update or insert into table arsip_lama based on 'tipe' (dpa_id) column
        ArsipLama::updateOrInsert(
            ['tipe' => $bendaharaData->dpa_id],
            $arsipLamaData
        );
    
        return redirect()->route('Arsip.index')->with('success', 'Data successfully added or updated in dokumen pencairan.');
    }
    

}