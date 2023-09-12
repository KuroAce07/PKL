<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\DPA;
use App\Models\User;
use App\Traits\WablasTrait;
use App\Models\Realisasi;
use App\Models\addmetodepengadaan;
use App\Models\addsumberdana;
use App\Exports\exportdokumen;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ViewDPAController extends Controller
{
    public function index(Request $request)
{
    $column = $request->input('column');

    // Subquery to select the maximum 'id' for each 'id_dpa'
    $subquery = DPA::selectRaw('MAX(id) as max_id')
        ->groupBy('id_dpa');

    // Query to retrieve DPA data by joining with the subquery
    $dpaData = DPA::joinSub($subquery, 'max_ids', function ($join) {
        $join->on('dpa.id', '=', 'max_ids.max_id');
    })
    ->orderBy('id_dpa');

    // Check if the logged-in user has role_id 1 (admin) and allow access to all DPAs
    if (auth()->user()->role_id !== 1) {
        // Filter DPAs based on user access
        $dpaData = $dpaData->where(function ($query) {
            $query->where('user_id', auth()->user()->id)
                  ->orWhere('user_id2', auth()->user()->id)
                  ->orWhere('user_id3', auth()->user()->id)
                  ->orWhere('user_id4', auth()->user()->id);
        });
    }

    // Use Eloquent's built-in pagination
    $perPage = 10;
    $accessibleDpaData = $dpaData->paginate($perPage);

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
        'column' => $column, // Pass the column value to your view
        'ke' => '',

    ]);
}



    public function assignDpa($dpaId, $userId)
    {
        $user = User::findOrFail($userId);
        $dpa = DPA::findOrFail($dpaId);

        $dpa->user_id = $user->id;
        $dpa->save();
        
        $whatsappData = [];
        $whatsappData['phone'] = $user->mobile_number; // Assuming mobile_number is the column name in the users table
        $whatsappData['message'] = "Ada DPA Baru yang harus dikerjakan dari admin dengan Nomor DPA : {$dpa->kode_sub_kegiatan} ";
        $whatsappData['secret'] = false;
        $whatsappData['retry'] = false;
        $whatsappData['isGroup'] = false;
        WablasTrait::sendText([$whatsappData]);
        return redirect()->back()->with('success', 'DPA assigned successfully.');
    }

    public function assignPP($dpaId, $userId)
    {
    $user = User::findOrFail($userId);
    $dpa = DPA::findOrFail($dpaId);

        $dpa->user_id2 = $user->id;
        $dpa->save();

        $whatsappData = [];
        $whatsappData['phone'] = $user->mobile_number; // Assuming mobile_number is the column name in the users table
        $whatsappData['message'] = "Ada DPA Baru yang harus dikerjakan dari PPTK dengan Nomor DPA : {$dpa->kode_sub_kegiatan} ";
        $whatsappData['secret'] = false;
        $whatsappData['retry'] = false;
        $whatsappData['isGroup'] = false;
        WablasTrait::sendText([$whatsappData]);

        return redirect()->back()->with('success', 'Pejabat Pengadaan assigned successfully.');
    }

    public function assignPPPTK($dpaId, $userId)
    {
    $user = User::findOrFail($userId);
    $dpa = DPA::findOrFail($dpaId);

        $dpa->user_id3 = $user->id;
        $dpa->save();

        $whatsappData = [];
        $whatsappData['phone'] = $user->mobile_number; // Assuming mobile_number is the column name in the users table
        $whatsappData['message'] = "Ada DPA Baru yang harus dilengkapi dokumennya dari PPTK dengan Nomor DPA : {$dpa->kode_sub_kegiatan} ";
        $whatsappData['secret'] = false;
        $whatsappData['retry'] = false;
        $whatsappData['isGroup'] = false;
        WablasTrait::sendText([$whatsappData]);

        return redirect()->back()->with('success', 'Pembantu PPTK assigned successfully.');
    }

    public function assignBendahara($dpaId, $userId)
{
    $user = User::findOrFail($userId);
    $dpa = DPA::findOrFail($dpaId);

    $dpa->user_id4 = $user->id;
    $dpa->save();

    $whatsappData = [];
    $whatsappData['phone'] = $user->mobile_number; // Assuming mobile_number is the column name in the users table
    $whatsappData['message'] = "Ada DPA Baru yang harus dilengkapi dokumennya dari Bendahara dengan Nomor DPA: {$dpa->kode_sub_kegiatan}";
    $whatsappData['secret'] = false;
    $whatsappData['retry'] = false;
    $whatsappData['isGroup'] = false;
    WablasTrait::sendText([$whatsappData]);

    return redirect()->back()->with('success', 'Bendahara assigned successfully.');
}

public function showDeskripsiBendahara($dpaId)
{
    $dpa = DPA::findOrFail($dpaId);

    return view('ViewDPA.deskripsibendahara', compact('dpa'));
}

public function updateDescription(Request $request, $dpaId)
{
    $dpa = DPA::findOrFail($dpaId);

    $dpa->description = $request->input('description');
    $dpa->user_id4 = $request->input('bendahara');
    $dpa->save();

    return redirect()->route('viewDPA', ['column' => 'C'])->with('success', 'Description updated successfully.');
}

public function updateDescriptionPP(Request $request, $dpaId)
{
    $dpa = DPA::findOrFail($dpaId);

    $dpa->descriptionPP = $request->input('descriptionPP');
    $dpa->user_id2 = $request->input('pp');
    $dpa->save();

    return redirect()->route('viewDPA', ['column' => 'A'])->with('success', 'Description updated successfully.');
}

// ViewDPAController.php

public function showDeskripsiPejabatPengadaan($dpaId)
{
    $dpa = DPA::findOrFail($dpaId);

    return view('ViewDPA.deskripsiPejabatPengadaan', compact('dpa'));
}

public function updateDescriptionPPPTK(Request $request, $dpaId)
{
    $dpa = DPA::findOrFail($dpaId);

    $dpa->descriptionPPPTK = $request->input('descriptionPPPTK');
    $dpa->user_id3 = $request->input('ppptk');
    $dpa->save();

    return redirect()->route('viewDPA', ['column' => 'B'])->with('success', 'Description updated successfully.');
}

// ViewDPAController.php
public function showDeskripsiPPPTK($dpaId)
{
    $dpa = DPA::findOrFail($dpaId);

    return view('ViewDPA.deskripsiPPPTK', compact('dpa'));
}

public function submitRUP(Request $request, $dpaId)
{
    $dpa = DPA::findOrFail($dpaId);

    $dpa->rup = $request->input('rup');
    $dpa->nilairup = $request->input('nilairup');
    $dpa->save();

    return redirect()->route('viewDPA')->with('success', 'RUP updated successfully.');
}

public function updateDescriptionRUP(Request $request, $dpaId)
{
  $descriptionRUP = $request->input('descriptionRUP');

  // Update the description in the database.
  DB::table('dpa')->where('id', $dpaId)->update(['descriptionRUP' => $descriptionRUP]);

  // Redirect the user back to the pop up view.
  return redirect()->back();
}

public function submitSumberDana(Request $request, $dpaId)
{
    $sumber_dana = $request->input('sumber_dana');
    if ($request->has('other')) {
        $sumber_dana = $request->input('other');
    }

    // Save the sumber_dana value in the dpa database
    $dpa = DPA::findOrFail($dpaId);
    $dpa->sumber_dana = $sumber_dana;
    $dpa->save();

    return redirect()->back()->with('success', 'Sumber Dana submitted successfully.');
}

    public function canViewDpa($dpa)
    {
        // Check if the logged-in user is assigned to this DPA as PPTK or Pembantu PPTK
        return auth()->user()->id === $dpa->user_id || auth()->user()->id === $dpa->user_id2|| auth()->user()->id === $dpa->user_id3 || auth()->user()->id === $dpa->user_id4;
    }
    
public function edit($dpaId)
{
    $dpa = DPA::findOrFail($dpaId);
    $users = User::where('role_id', 3)->get(); // Adjust the query based on your needs

    return view('ViewDPA.edit', ['dpa' => $dpa, 'users' => $users]);
}

public function destroy($id)
{
    $dpa = DPA::find($id);

    if (!$dpa) {
        // Handle case where DPA doesn't exist
        return redirect()->back()->with('error', 'DPA not found.');
    }

    // Perform the deletion
    $dpa->delete();

    return redirect()->route('ViewDPA.index')->with('success', 'DPA deleted successfully.');
}

public function rak()
{
    $dpaData = DPA::all(); // Fetch all DPAs from the database

    return view('ViewDPA.rak', compact('dpaData'));
}

public function editrak($dpaId)
{
    $dpa = DPA::findOrFail($dpaId);
    $users = User::where('role_id', 3)->get(); // Adjust the query based on your needs

    return view('ViewDPA.edit', ['dpa' => $dpa, 'users' => $users]);
}

public function realrak($dpaId)
{
    $dpa = DPA::findOrFail($dpaId);
    $realisasi = Realisasi::where('dpa_id', $dpa->id)->first(); // Retrieve the associated Realisasi record
    return view('ViewDPA.realrak', ['dpa' => $dpa, 'realisasi' => $realisasi]); // Pass both $dpa and $realisasi to the view
}

public function UpdateRealisasi(Request $request, $dpaId)
{
    // Check if a DPA with the given ID exists
    $dpa = DPA::findOrFail($dpaId);

    // Get values from the form inputs
    $bulanValues = [];
    for ($i = 1; $i <= 12; $i++) {
        $bulanValue = "bulan_$i";
        $bulanValues[$bulanValue] = $request->input("bulan_$i");
    }
    $totalRak = $request->input('total_rak');

    // Find an existing Realisasi record by dpa_id
    $realisasi = Realisasi::where('dpa_id', $dpa->id)->first();
    if ($realisasi) {
        // Update the existing record in the realisasi table
        $realisasi->update([
            'bulan_1' => $bulanValues['bulan_1'],
            'bulan_2' => $bulanValues['bulan_2'],
            'bulan_3' => $bulanValues['bulan_3'],
            'bulan_4' => $bulanValues['bulan_4'],
            'bulan_5' => $bulanValues['bulan_5'],
            'bulan_6' => $bulanValues['bulan_6'],
            'bulan_7' => $bulanValues['bulan_7'],
            'bulan_8' => $bulanValues['bulan_8'],
            'bulan_9' => $bulanValues['bulan_9'],
            'bulan_10' => $bulanValues['bulan_10'],
            'bulan_11' => $bulanValues['bulan_11'],
            'bulan_12' => $bulanValues['bulan_12'],
            'total_rak' => $totalRak,
        ]);
    } else {
        // Create a new Realisasi record
        Realisasi::create([
            'dpa_id' => $dpa->id,
            'bulan_1' => $bulanValues['bulan_1'],
            'bulan_2' => $bulanValues['bulan_2'],
            'bulan_3' => $bulanValues['bulan_3'],
            'bulan_4' => $bulanValues['bulan_4'],
            'bulan_5' => $bulanValues['bulan_5'],
            'bulan_6' => $bulanValues['bulan_6'],
            'bulan_7' => $bulanValues['bulan_7'],
            'bulan_8' => $bulanValues['bulan_8'],
            'bulan_9' => $bulanValues['bulan_9'],
            'bulan_10' => $bulanValues['bulan_10'],
            'bulan_11' => $bulanValues['bulan_11'],
            'bulan_12' => $bulanValues['bulan_12'],
            'total_rak' => $totalRak,
        ]);
    }
    // Redirect back to the view
    return redirect()->route('ViewDPA.realrak', $dpaId)->with('success', 'Realisasi stored/updated successfully.');
}


public function pdf($dpaId)
{
    $dpa = DPA::findOrFail($dpaId);
    $pdfFilePath = public_path('uploads/' . $dpa->id . '/' . $dpa->id . '.pdf');

    if (file_exists($pdfFilePath)) {
        // Generate PDF view
        $pdf = PDF::loadView('ViewDPA.pdf', ['dpa' => $dpa]);

        // Return PDF download response
        return $pdf->download('dpa_' . $dpa->id . '.pdf');
    } else {
        return redirect()->back()->with('error', 'PDF file not found for this DPA.');
    }
}

public function update(Request $request, $dpaId)
{
    $dpa = DPA::findOrFail($dpaId);
    
    // Update the DPA fields based on the form inputs
    $dpa->kode_sub_kegiatan = $request->input('kode_sub_kegiatan');
    $dpa->nama_sub_kegiatan = $request->input('nama_sub_kegiatan');
    $dpa->nilai_rincian = $request->input('nilai_rincian');
    
    // Update PPTK (if applicable)
    if ($request->has('pptk')) {
        $user = User::findOrFail($request->input('pptk'));
        $dpa->user_id = $user->id;
    }

    $dpa->save();

    return redirect()->route('ViewDPA.index')->with('success', 'DPA updated successfully.');
}

public function tracking()
{
    $dpaData = DPA::paginate(10);
    return view('ViewDPA.track', ['dpaData' => $dpaData]);
}

public function dppa($id_dpa)
{
    $dppaData = DPA::where('id_dpa', $id_dpa)
        ->where('tipe', 'dppa')
        ->get();

    $combinedData = [];

    foreach ($dppaData as $item) {
        $matchingRow = DPA::where('id_dpa', $item->id_dpa)
            ->where('tipe', '<>', 'dppa') // Exclude the current row's tipe value
            ->first();

        if ($matchingRow) {
            $combinedData[] = [
                'dppaRow' => $item,
                'matchingRow' => $matchingRow,
            ];
        }
    }

    return view('ViewDPA.dppa', compact('combinedData'));
}

public function metodepengadaan()
{
    // Retrieve data from the "metodepengadaan" table
    $metodepengadaanData = addmetodepengadaan::all();

    return view('ViewDPA.metodepengadaan', ['metodepengadaanData' => $metodepengadaanData]);
}

public function addmetodepengadaan(Request $request)
    {
        // Validate and process the form data, then insert into the database
        // Example validation:
        $validatedData = $request->validate([
            'metode_pengadaan' => 'required|string|max:255',
            'keterangan' => 'required|string',
            // Add validation rules for other form fields as needed
        ]);

        // Insert the data into the database using the model
        AddMetodePengadaan::create($validatedData);

        return redirect()->route('ViewDPA.metodepengadaan')->with('success', 'Entry added successfully.');
    }

    public function deleteMetodePengadaan($id)
    {
        // Find the entry by ID and delete it
        $entry = AddMetodePengadaan::find($id);
    
        if (!$entry) {
            return redirect()->route('ViewDPA.metodepengadaan')->with('error', 'Entry not found.');
        }
    
        $entry->delete();
    
        return redirect()->route('ViewDPA.metodepengadaan')->with('success', 'Entry deleted successfully.');
    }

    public function sumberdana()
    {
        // Retrieve data from the "metodepengadaan" table
        $sumberdanadata = addsumberdana::all();
    
        return view('ViewDPA.sumberdana', ['sumberdanadata' => $sumberdanadata]);
    }
    
    public function addsumberdana(Request $request)
        {
            // Validate and process the form data, then insert into the database
            // Example validation:
            $validatedData = $request->validate([
                'sumber_dana' => 'required|string|max:255',
                'keterangan' => 'required|string',
                // Add validation rules for other form fields as needed
            ]);
    
            // Insert the data into the database using the model
            addsumberdana::create($validatedData);
    
            return redirect()->route('ViewDPA.sumberdana')->with('success', 'Entry added successfully.');
        }
    
        public function deletesumberdana($id)
        {
            // Find the entry by ID and delete it
            $entry = addsumberdana::find($id);
        
            if (!$entry) {
                return redirect()->route('ViewDPA.sumberdana')->with('error', 'Entry not found.');
            }
        
            $entry->delete();
        
            return redirect()->route('ViewDPA.sumberdana')->with('success', 'Entry deleted successfully.');
        }

        public function export()
        {
            return Excel::download(new exportdokumen, 'dokumen.xlsx');
        }
    
        public function ViewDPA($ke) {
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
}
