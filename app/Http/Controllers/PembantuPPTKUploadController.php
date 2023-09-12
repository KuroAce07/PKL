<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DokumenKontrak;
use App\Models\DokumenPendukung;
use App\Models\EPurchasing;
use App\Models\DokumenJustifikasi;
use App\Models\Bast;
use App\Models\Bap;
use App\Models\Baph;
use App\Models\PilihRekanan;
use App\Models\DPA;
use App\Models\Rekanan;
use App\Models\User;
use App\Models\Bukti;
use App\Models\Surat;
use App\Models\DokumenKontrakSPK;
use App\Models\SuratPerjanjian;
use App\Models\RisalahKontrak;
use App\Models\NPWP;
use App\Models\Buku;
use App\Models\NIB;


class PembantuPPTKUploadController extends Controller
{

//=====================DOKUMEN KONTRAK==========================================================

public function createDokumenKontrak()
{
    $dpas = DPA::all(); // Fetch the list of DPAs
    $dpaId = request()->query('dpaId'); // Get the value of dpaId from the URL parameter
    return view('PembantuPPTKView.dokumenkontrak.create', compact('dpas', 'dpaId'));
}

public function showDokumenKontrak($dpaId)
{
    $dokumenKontrak = DokumenKontrak::where('dpa_id', $dpaId)->firstOrFail();
    return view('PembantuPPTKView.dokumenkontrak.show', ['dokumenKontrak' => $dokumenKontrak,'dpaId' => $dpaId,]);
}


public function storeDokumenKontrak(Request $request)
{
    $validatedData = $request->validate([
        'dpa_id' => 'required|numeric', // Validate the selected DPA
        'no_bukti' => 'nullable|numeric',
        'nama_kegiatan_transaksi' => 'required',
        'tanggal_kontrak' => 'required|date',
        'jumlah_uang' => 'required|numeric',
        'ppn' => 'nullable|numeric',
        'pph' => 'nullable|numeric',
        'potongan_lain' => 'nullable|numeric',
        'jumlah_potongan' => 'nullable|numeric',
        'jumlah_total' => 'required|numeric',
        'keterangan' => 'nullable|string',
        'upload_dokumen' => 'nullable|file',
        'alasan' => 'nullable',
    ]);

    $dokumenKontrak = new DokumenKontrak($validatedData);
    $dokumenKontrak->dpa_id = $request->input('dpa_id');

    // Process and store the uploaded file
    if ($request->hasFile('upload_dokumen')) {
        $uploadedFile = $request->file('upload_dokumen');

        // Create a directory path based on the dpa_id
        $directoryPath = public_path('uploads') . DIRECTORY_SEPARATOR . $dokumenKontrak->dpa_id;

        // Make sure the directory exists, if not, create it
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        // Move the uploaded file to the directory
        $fileName = time() . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedFile->move($directoryPath, $fileName);

        // Update the dokumenKontrak with the file information
        $dokumenKontrak->upload_dokumen = $directoryPath . DIRECTORY_SEPARATOR . $fileName;
    }

    $dokumenKontrak->save();

    return redirect()->route('PembantuPPTKView.dokumenkontrak.create')->with('success', 'Dokumen Kontrak saved successfully.');
}

public function editDokumenKontrak($id)
{
    $dokumenKontrak = DokumenKontrak::findOrFail($id);
    $dpas = DPA::all(); // Fetch the list of DPAs
    return view('PembantuPPTKView.dokumenkontrak.edit', ['dokumenKontrak' => $dokumenKontrak, 'dpas' => $dpas]);
}

public function updateDokumenKontrak(Request $request, $id)
{
    $validatedData = $request->validate([
        'dpa_id' => 'nullable|numeric', // Validate the selected DPA
        'no_bukti' => 'nullable|numeric',
        'nama_kegiatan_transaksi' => 'nullable',
        'tanggal_kontrak' => 'nullable|date',
        'jumlah_uang' => 'nullable|numeric',
        'ppn' => 'nullable|numeric',
        'pph' => 'nullable|numeric',
        'potongan_lain' => 'nullable|numeric',
        'jumlah_potongan' => 'nullable|numeric',
        'jumlah_total' => 'nullable|numeric',
        'keterangan' => 'nullable|string',
        'upload_dokumen' => 'nullable|file',
        'alasan' => 'nullable',
    ]);

    $dokumenKontrak = DokumenKontrak::findOrFail($id);
    $dokumenKontrak->fill($validatedData);

    // Set the approval value based on checkbox
    if (!auth()->user()->hasRole('Pembantu PPTK')) {
        if ($request->has('approval')) {
            $dokumenKontrak->approval = 1;
        } elseif ($request->has('reject')) {
            $dokumenKontrak->approval = 2;
        } else {
            $dokumenKontrak->approval = 0;
        }
    }

    $dokumenKontrak->save();
    $dpa_id = $request->input('dpa_id'); // Retrieve the value of 'dpa_id' from the request

    return redirect()->route('PembantuPPTKView.dokumenkontrak.show', ['dpaId' => $dpa_id])->with('success', 'Dokumen Kontrak updated successfully.');
    
}

    //=====================DOKUMEN JUSTIFIKASI==========================================================
    public function createDokumenJustifikasi()
    {
        $dpas = DPA::all(); // Fetch the list of DPAs
        $dpaId = request()->query('dpaId');
        return view('PembantuPPTKView.dokumenjustifikasi.create', compact('dpas', 'dpaId'));
    }
    
    public function indexDokumenJustifikasi($dpaId)
    {
    $dokumenJustifikasi = DokumenJustifikasi::where('dpa_id', $dpaId)->get();
    $dpas = DPA::all();
    return view('PembantuPPTKView.dokumenjustifikasi.index', ['dokumenJustifikasi' => $dokumenJustifikasi, 'dpas' => $dpas, 'dpaId' => $dpaId,]);
    }  

    public function storeDokumenJustifikasi(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable',
            'upload_dokumen' => 'nullable|file',
            'dpa_id' => 'required|numeric', // Validate the selected DPA
            'alasan' => 'nullable',
        ]);
    
        $dokumenJustifikasi = new DokumenJustifikasi($validatedData);
        $dokumenJustifikasi->dpa_id = $request->input('dpa_id');
    
        // Process and store the uploaded file
        if ($request->hasFile('upload_dokumen')) {
            $uploadedFile = $request->file('upload_dokumen');
    
            $directoryPath = public_path('uploads') . DIRECTORY_SEPARATOR . $dokumenJustifikasi->dpa_id;
    
            if (!file_exists($directoryPath)) {
                mkdir($directoryPath, 0777, true);
            }
    
            $fileName = time() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move($directoryPath, $fileName);
    
            $dokumenJustifikasi->upload_dokumen = $directoryPath . DIRECTORY_SEPARATOR . $fileName;
        }
    
        $dokumenJustifikasi->save();
    
        return redirect()->route('PembantuPPTKView.dokumenjustifikasi.create')->with('success', 'Dokumen Justifikasi saved successfully.');
    }

    public function editDokumenJustifikasi($id)
    {
        $dokumenJustifikasi = DokumenJustifikasi::findOrFail($id);
        $dpas = DPA::all(); // Fetch the list of DPAs

        return view('PembantuPPTKView.dokumenjustifikasi.edit', ['dokumenJustifikasi' => $dokumenJustifikasi,'dpas' => $dpas,]);
    }

    public function updateDokumenJustifikasi(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'nullable',
            'tanggal' => 'nullable|date',
            'keterangan' => 'nullable',
            'upload_dokumen' => 'nullable|file',
            'alasan' => 'nullable',
        ]);

        $dokumenJustifikasi = DokumenJustifikasi::findOrFail($id);
        // Check if a file was uploaded
        if ($request->hasFile('upload_dokumen')) {
            // Handle the file upload
            $file = $request->file('upload_dokumen');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            // Update the upload_dokumen field
            $validatedData['upload_dokumen'] = $filename;
        } else {
            // Remove the upload_dokumen field from the validated data array
            unset($validatedData['upload_dokumen']);
        }

        $dokumenJustifikasi->fill($validatedData);
    
        
        if (!auth()->user()->hasRole('Pembantu PPTK')) {
            if ($request->has('approval')) {
                $dokumenJustifikasi->approval = 1;
            } elseif ($request->has('reject')) {
                $dokumenJustifikasi->approval = 2;
            } else {
                $dokumenJustifikasi->approval = 0;
            }
        }
    
        $dpaId = $request->input('dpa_id'); 
        $dokumenJustifikasi->dpa_id = $dpaId;
        $dokumenJustifikasi->save();
    
        return redirect()->route('PembantuPPTKView.dokumenjustifikasi.index', ['dpaId' => $dpaId])->with('success', 'Dokumen Justifikasi updated successfully.');
    }

    //=====================E-PURCHASING==========================================================

    public function createEPurchasing()
    {
        $dpas = DPA::all(); // Fetch the list of DPAs
        $pejabatPengadaanUsers = User::where('role_id', 4)->get();
        return view('PembantuPPTKView.epurchaseview.create', ['dpas' => $dpas, 'pejabatPengadaanUsers' => $pejabatPengadaanUsers]);
    }
    
    public function indexEPurchasing($dpaId)
    {
        $ePurchasing = EPurchasing::select('e_purchasings.*', 'users.first_name', 'users.last_name')
        ->join('users', 'users.id', '=', 'e_purchasings.nama_pejabat_pengadaan')
        ->where('dpa_id', $dpaId)->firstOrFail();

        $dpas = DPA::all();
    
        return view('PembantuPPTKView.epurchaseview.index', ['ePurchasing' => $ePurchasing, 'dpas' => $dpas, 'dpaId' => $dpaId,]);
    }
            
        public function storeEPurchasing(Request $request)
        {
            $validatedData = $request->validate([
                'e_commerce' => 'nullable',
                'id_paket' => 'nullable',
                'jumlah' => 'nullable|numeric',
                'harga_total' => 'nullable|numeric',
                'tanggal_buat' => 'nullable|date',
                'tanggal_ubah' => 'nullable|date',
                'nama_pejabat_pengadaan' => 'nullable',
                'nama_penyedia' => 'nullable',
                'keterangan' => 'nullable',
                'upload_dokumen' => 'nullable|file',
                'dpa_id' => 'nullable|numeric', 
                'alasan' => 'nullable',
            ]);
        
            $ePurchasing = new EPurchasing($validatedData);
            $ePurchasing->dpa_id = $request->input('dpa_id');
  
            if ($request->hasFile('upload_dokumen')) {
                $uploadedFile = $request->file('upload_dokumen');
                
                // Create a directory path based on the dpa_id
                $directoryPath = public_path('uploads') . DIRECTORY_SEPARATOR . $ePurchasing->dpa_id;
        
                // Make sure the directory exists, if not, create it
                if (!file_exists($directoryPath)) {
                    mkdir($directoryPath, 0777, true);
                }
        
                // Move the uploaded file to the directory
                $fileName = time() . '.' . $uploadedFile->getClientOriginalExtension();
                $uploadedFile->move($directoryPath, $fileName);
        
                // Update the dokumenPendukung with the file information
                $ePurchasing->upload_dokumen = $directoryPath . DIRECTORY_SEPARATOR . $fileName;
            }
        
            $ePurchasing->save();
        
            return redirect()->route('PembantuPPTKView.epurchaseview.create')->with('success', 'E-Purchasing data saved successfully.');
        }    
        
        
        public function editEPurchasing($id)
        {
            $ePurchasing = EPurchasing::findOrFail($id);
            $dpas = DPA::all(); // Fetch the list of DPAs
            $pejabatPengadaanUsers = User::where('role_id', 4)->get();
        
            return view('PembantuPPTKView.epurchaseview.edit', [
                'ePurchasing' => $ePurchasing,
                'dpas' => $dpas,
                'pejabatPengadaanUsers' => $pejabatPengadaanUsers, // Include this line
            ]);
        }
        
        public function updateEPurchasing(Request $request, $id)
        {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'e_commerce' => 'nullable',
                'id_paket' => 'nullable',
                'jumlah' => 'nullable|numeric',
                'harga_total' => 'nullable|numeric',
                'tanggal_buat' => 'nullable|date',
                'tanggal_ubah' => 'nullable|date',
                'nama_pejabat_pengadaan' => 'nullable',
                'nama_penyedia' => 'nullable',
                'keterangan' => 'nullable',
                'upload_dokumen' => 'nullable|file',
                'dpa_id' => 'nullable|numeric', // Validate the selected DPA
                'alasan' => 'nullable',
            ]);
        
            $ePurchasing = EPurchasing::findOrFail($id);

        // Check if a file was uploaded
        if ($request->hasFile('upload_dokumen')) {
            // Handle the file upload
            $file = $request->file('upload_dokumen');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            // Update the upload_dokumen field
            $validatedData['upload_dokumen'] = $filename;
        } else {
            // Remove the upload_dokumen field from the validated data array
            unset($validatedData['upload_dokumen']);
        }

            $ePurchasing->fill($validatedData);
        
            // Set the approval value based on checkbox
            if (!auth()->user()->hasRole('Pembantu PPTK')) {
                if ($request->has('approval')) {
                    $ePurchasing->approval = 1;
                } elseif ($request->has('reject')) {
                    $ePurchasing->approval = 2;
                } else {
                    $ePurchasing->approval = 0;
                }
            }
        
            $dpaId = $request->input('dpa_id'); // Retrieve dpaId from the input
            $ePurchasing->dpa_id = $dpaId;
            $ePurchasing->save();
        
            return redirect()->route('PembantuPPTKView.epurchaseview.index', ['dpaId' => $dpaId])->with('success', 'E-Purchasing data updated successfully.');
        }
    
//=====================DOKUMEN PENDUKUNG==========================================================

public function createDokumenPendukung()
{
    $dpas = DPA::all(); 
    $dpaId = request()->query('dpaId');
    return view('PembantuPPTKView.dokumenpendukung.create', compact('dpas', 'dpaId'));
}

public function indexDokumenPendukung($dpaId)
{
    $dokumenPendukung = DokumenPendukung::where('dpa_id', $dpaId)->firstOrFail();
    return view('PembantuPPTKView.dokumenpendukung.index', ['dokumenPendukung' => $dokumenPendukung, 'dpaId' => $dpaId,]);
}

public function storeDokumenPendukung(Request $request)
{
    $validatedData = $request->validate([
        'nama' => 'required',
        'tanggal' => 'required|date',
        'keterangan' => 'nullable',
        'upload_dokumen' => 'nullable|file',
        'dpa_id' => 'required|numeric',
        'alasan' => 'nullable',
    ]);

    $dokumenPendukung = new DokumenPendukung($validatedData);
    $dokumenPendukung->dpa_id = $request->input('dpa_id');

    // Process and store the uploaded file
    if ($request->hasFile('upload_dokumen')) {
        $uploadedFile = $request->file('upload_dokumen');
        
        // Create a directory path based on the dpa_id
        $directoryPath = public_path('uploads') . DIRECTORY_SEPARATOR . $dokumenPendukung->dpa_id;

        // Make sure the directory exists, if not, create it
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        // Move the uploaded file to the directory
        $fileName = time() . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedFile->move($directoryPath, $fileName);

        // Update the dokumenPendukung with the file information
        $dokumenPendukung->upload_dokumen = $directoryPath . DIRECTORY_SEPARATOR . $fileName;
    }

    $dokumenPendukung->save();

    return redirect()->route('PembantuPPTKView.dokumenpendukung.create')->with('success', 'Dokumen Pendukung saved successfully.');
}


public function editDokumenPendukung($id)
{
    $dokumenPendukung = DokumenPendukung::findOrFail($id);
    $dpas = DPA::all(); // Fetch the list of DPAs
    return view('PembantuPPTKView.dokumenpendukung.edit', ['dokumenPendukung' => $dokumenPendukung,'dpas' => $dpas]);
}

public function updateDokumenPendukung(Request $request, $id)
{
    $validatedData = $request->validate([
        'nama' => 'nullable',
        'tanggal' => 'nullable|date',
        'keterangan' => 'nullable',
        'upload_dokumen' => 'nullable|file',
        'alasan' => 'nullable',
    ]);

    $dokumenPendukung = DokumenPendukung::findOrFail($id);

        // Check if a file was uploaded
        if ($request->hasFile('upload_dokumen')) {
            // Handle the file upload
            $file = $request->file('upload_dokumen');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            // Update the upload_dokumen field
            $validatedData['upload_dokumen'] = $filename;
        } else {
            // Remove the upload_dokumen field from the validated data array
            unset($validatedData['upload_dokumen']);
        }

    $dokumenPendukung->fill($validatedData);

    if (!auth()->user()->hasRole('Pembantu PPTK')) {
        if ($request->has('approval')) {
            $dokumenPendukung->approval = 1;
        } elseif ($request->has('reject')) {
            $dokumenPendukung->approval = 2;
        } else {
            $dokumenPendukung->approval = 0;
        }
    }

    $dpaId = $request->input('dpa_id'); // Retrieve dpaId from the input
    $dokumenPendukung->save();
    $dpa_id = $request->input('dpa_id');

    return redirect()->route('PembantuPPTKView.dokumenpendukung.index', ['dpaId' => $dpaId])->with('success', 'Dokumen Pendukung data updated successfully.');
}

    //=====================BAST==========================================================

    public function createBast()
    {
        $dpas = DPA::all();
        $dpaId = request()->query('dpaId');
        return view('PembantuPPTKView.bast.create', compact('dpas', 'dpaId'));
    }

    public function indexBast($dpaId)
    {
    $bast = Bast::where('dpa_id', $dpaId)->firstOrFail();
    $dpas = DPA::all();
    return view('PembantuPPTKView.bast.index', ['bast' => $bast, 'dpaId' => $dpaId,]);
    }

    public function storeBast(Request $request)
    {
        $validatedData = $request->validate([
            'nomor' => 'required',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable',
            'upload_dokumen' => 'nullable|file',
            'dpa_id' => 'required|numeric',
            'alasan' => 'nullable',
        ]);
    
        $bast = new Bast($validatedData);
        $bast->dpa_id = $request->input('dpa_id');
    
        // Process and store the uploaded file
        if ($request->hasFile('upload_dokumen')) {
            $uploadedFile = $request->file('upload_dokumen');
    
            $directoryPath = public_path('uploads') . DIRECTORY_SEPARATOR . $bast->dpa_id;
    
            if (!file_exists($directoryPath)) {
                mkdir($directoryPath, 0777, true);
            }
    
            $fileName = time() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move($directoryPath, $fileName);
    
            $bast->upload_dokumen = $directoryPath . DIRECTORY_SEPARATOR . $fileName;
        }
    
        $bast->save();
    
        return redirect()->route('PembantuPPTKView.bast.create')->with('success', 'BAST saved successfully.');
    }

    public function editBast($id)
    {
        $bast = Bast::findOrFail($id);
        $dpas = DPA::all(); 
        return view('PembantuPPTKView.bast.edit', ['bast' => $bast, 'dpas' => $dpas]);
    }
    
    public function updateBast(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nomor' => 'nullable',
            'tanggal' => 'nullable|date',
            'keterangan' => 'nullable',
            'upload_dokumen' => 'nullable|file',
            'dpa_id' => 'required|numeric',
            'alasan' => 'nullable',
        ]);
    

        $bast = Bast::findOrFail($id);

        // Check if a file was uploaded
        if ($request->hasFile('upload_dokumen')) {
            // Handle the file upload
            $file = $request->file('upload_dokumen');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            // Update the upload_dokumen field
            $validatedData['upload_dokumen'] = $filename;
        } else {
            // Remove the upload_dokumen field from the validated data array
            unset($validatedData['upload_dokumen']);
        }

        $bast->fill($validatedData);
    
        if (!auth()->user()->hasRole('Pembantu PPTK')) {
            if ($request->has('approval')) {
                $bast->approval = 1;
            } elseif ($request->has('reject')) {
                $bast->approval = 2;
            } else {
                $bast->approval = 0;
            }
        }

        $dpaId = $request->input('dpa_id');
        $dpa_id = $request->input('dpa_id');
        $bast->save();
    
        return redirect()->route('PembantuPPTKView.bast.index', ['dpaId' => $dpaId])->with('success', 'BAST data updated successfully.');
    }
    

    //=====================BERITA ACARA PEMBAYARAN==========================================================

    public function createBap()
{
    $dpas = DPA::all(); // Fetch the list of DPAs
    $dpaId = request()->query('dpaId');
    return view('PembantuPPTKView.bap.create', compact('dpas', 'dpaId'));
}

public function indexBap($dpaId)
{
    $baps = Bap::where('dpa_id', $dpaId)->firstOrFail();
    return view('PembantuPPTKView.bap.index', ['baps' => $baps, 'dpaId' => $dpaId,]); 
}

public function storeBap(Request $request)
{
    $validatedData = $request->validate([
        'nomor' => 'required',
        'tanggal' => 'required|date',
        'keterangan' => 'nullable',
        'upload_dokumen' => 'nullable|file',
        'dpa_id' => 'required|numeric',
        'alasan' => 'nullable',
    ]);

    $bap = new Bap($validatedData);
    $bap->dpa_id = $request->input('dpa_id');

    // Process and store the uploaded file
    if ($request->hasFile('upload_dokumen')) {
        $uploadedFile = $request->file('upload_dokumen');

        $directoryPath = public_path('uploads') . DIRECTORY_SEPARATOR . $bap->dpa_id;

        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        $fileName = time() . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedFile->move($directoryPath, $fileName);

        $bap->upload_dokumen = $directoryPath . DIRECTORY_SEPARATOR . $fileName;
    }

    $bap->save();

    return redirect()->route('PembantuPPTKView.bap.create')->with('success', 'BAP saved successfully.');
}

public function editBap($id)
{
    $baps = Bap::findOrFail($id);
    $dpas = DPA::all(); 
    return view('PembantuPPTKView.bap.edit', ['baps' => $baps, 'dpas' => $dpas]);
}

public function updateBap(Request $request, $id)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'nomor' => 'nullable',
        'tanggal' => 'nullable|date',
        'keterangan' => 'nullable',
        'upload_dokumen' => 'nullable|file',
        'dpa_id' => 'required|numeric',
        'alasan' => 'nullable',
    ]);

    $baps = Bap::findOrFail($id);

        // Check if a file was uploaded
        if ($request->hasFile('upload_dokumen')) {
            // Handle the file upload
            $file = $request->file('upload_dokumen');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            // Update the upload_dokumen field
            $validatedData['upload_dokumen'] = $filename;
        } else {
            // Remove the upload_dokumen field from the validated data array
            unset($validatedData['upload_dokumen']);
        }

    $baps->fill($validatedData);

        if (!auth()->user()->hasRole('Pembantu PPTK')) {
            if ($request->has('approval')) {
                $baps->approval = 1;
            } elseif ($request->has('reject')) {
                $baps->approval = 2;
            } else {
                $baps->approval = 0;
            }
        }

    $dpaId = $request->input('dpa_id'); 
    $baps->dpa_id = $dpaId;
    $baps->save();

    return redirect()->route('PembantuPPTKView.bap.index', ['dpaId' => $dpaId])->with('success', 'BAP data updated successfully.');
}

    //=====================BERITA ACARA PEMERIKSAAN HASIL PEKERJAAN==========================================================


    public function createBaph()
{
    $dpas = DPA::all(); // Fetch the list of DPAs
    $dpaId = request()->query('dpaId');
    return view('PembantuPPTKView.baph.create', compact('dpas', 'dpaId'));
}

public function indexBaph($dpaId)
{
    $baphs = Baph::where('dpa_id', $dpaId)->firstOrFail();
    return view('PembantuPPTKView.baph.index', ['baphs' => $baphs, 'dpaId' => $dpaId,]); 
}

public function storeBaph(Request $request)
{
    $validatedData = $request->validate([
        'nomor' => 'required',
        'tanggal' => 'required|date',
        'keterangan' => 'nullable',
        'upload_dokumen' => 'nullable|file',
        'dpa_id' => 'required|numeric',
        'alasan' => 'nullable',
    ]);

    $baph = new Baph($validatedData);
    $baph->dpa_id = $request->input('dpa_id');

    // Process and store the uploaded file
    if ($request->hasFile('upload_dokumen')) {
        $uploadedFile = $request->file('upload_dokumen');

        $directoryPath = public_path('uploads') . DIRECTORY_SEPARATOR . $baph->dpa_id;

        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        $fileName = time() . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedFile->move($directoryPath, $fileName);

        $baph->upload_dokumen = $directoryPath . DIRECTORY_SEPARATOR . $fileName;
    }

    $baph->save();

    return redirect()->route('PembantuPPTKView.baph.create')->with('success', 'BAP saved successfully.');
}


public function editBaph($id)
{
    $baphs = Baph::findOrFail($id);
    $dpas = DPA::all(); 
    return view('PembantuPPTKView.baph.edit', ['baphs' => $baphs, 'dpas' => $dpas]);
}

public function updateBaph(Request $request, $id)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'nomor' => 'nullable',
        'tanggal' => 'nullable|date',
        'keterangan' => 'nullable',
        'upload_dokumen' => 'nullable|file',
        'dpa_id' => 'required|numeric',
        'alasan' => 'nullable',
    ]);

    $baphs = Baph::findOrFail($id);

        // Check if a file was uploaded
        if ($request->hasFile('upload_dokumen')) {
            // Handle the file upload
            $file = $request->file('upload_dokumen');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            // Update the upload_dokumen field
            $validatedData['upload_dokumen'] = $filename;
        } else {
            // Remove the upload_dokumen field from the validated data array
            unset($validatedData['upload_dokumen']);
        }

    $baphs->fill($validatedData);

    if (!auth()->user()->hasRole('Pembantu PPTK')) {
        if ($request->has('approval')) {
            $baphs->approval = 1;
        } elseif ($request->has('reject')) {
            $baphs->approval = 2;
        } else {
            $baphs->approval = 0;
        }
    }

    $dpaId = $request->input('dpa_id'); 
    $baphs->dpa_id = $dpaId;
    $baphs->save();

    return redirect()->route('PembantuPPTKView.baph.index', ['dpaId' => $dpaId])->with('success', 'BAPH data updated successfully.');
}
    
/* //=====================PILIH REKANAN==========================================================

public function createPilihRekanan()
{
    $dpas = DPA::all();
    $rekanans = Rekanan::all(); 

    return view('PembantuPPTKView.pilihrekanan.create', ['dpas' => $dpas,'rekanans' => $rekanans,]);
}

public function indexPilihRekanan($dpaId)
{
    $pilihanRekanan = PilihRekanan::where('dpa_id', $dpaId)->firstOrFail();
    $rekanans = Rekanan::all();
    $dpas = DPA::all(); 
    
    return view('PembantuPPTKView.pilihrekanan.index', compact('pilihanRekanan', 'rekanans', 'dpas')); // add 'dpas' to the compact function
}

public function storePilihRekanan(Request $request)
{
    $validatedData = $request->validate([
        'pilih' => 'required',
        'detail' => 'required',
        'jenis_pengadaan' => 'required',
        'keterangan' => 'required',
        'dpa_id' => 'required|numeric', 
        'alasan' => 'nullable',
    ]);

    $pilihanRekanan = new PilihRekanan($validatedData);
    $pilihanRekanan->dpa_id = $request->input('dpa_id');
    $pilihanRekanan->save();

    return redirect()->route('PembantuPPTKView.pilihrekanan.create')->with('success', 'Pilihan Rekanan saved successfully.');
}

public function editPilihRekanan($id)
{
    $pilihanRekanan = PilihRekanan::findOrFail($id);
    $dpas = DPA::all();
    $rekanans = Rekanan::all(); 

    return view('PembantuPPTKView.pilihrekanan.edit', ['pilihanRekanan' => $pilihanRekanan,'dpas' => $dpas,'rekanans' => $rekanans, ]);
}

public function updatePilihRekanan(Request $request, $id)
{
    $validatedData = $request->validate([
        'pilih' => 'nullable',
        'detail' => 'nullable',
        'jenis_pengadaan' => 'nullable',
        'keterangan' => 'nullable',
        'dpa_id' => 'required|numeric', 
        'alasan' => 'nullable',
    ]);

    $pilihanRekanan = PilihRekanan::findOrFail($id);
    $pilihanRekanan->fill($validatedData);

    if ($request->has('approval')) {
        $pilihanRekanan->approval = 1; 
    } elseif ($request->has('reject')) {
        $pilihanRekanan->approval = 2;
    } else {
        $pilihanRekanan->approval = 0;
    }

    $dpaId = $request->input('dpa_id'); 
    $pilihanRekanan->dpa_id = $dpaId;
    $pilihanRekanan->save();

    return redirect()->route('PembantuPPTKView.pilihrekanan.index', ['dpaId' => $dpaId])->with('success', 'Pilihan Rekanan data updated successfully.');
} */

//=====================Bukti Pembelian==========================================================

    public function createBukti()
{
    $dpas = DPA::all(); // Fetch the list of DPAs
    $dpaId = request()->query('dpaId');
    return view('PembantuPPTKView.bukti.create', compact('dpas', 'dpaId'));
}

public function indexBukti($dpaId)
{
    $buktis = Bukti::where('dpa_id', $dpaId)->firstOrFail();
    return view('PembantuPPTKView.bukti.index', ['buktis' => $buktis, 'dpaId' => $dpaId,]); 
}

public function storeBukti(Request $request)
{
    $validatedData = $request->validate([
        'nama' => 'nullable',
        'nomor' => 'required',
        'tanggal' => 'required|date',
        'keterangan' => 'nullable',
        'upload_dokumen' => 'nullable|file',
        'dpa_id' => 'required|numeric',
        'alasan' => 'nullable',
    ]);

    $buktis = new Bukti($validatedData);
    $buktis->dpa_id = $request->input('dpa_id');

    // Process and store the uploaded file
    if ($request->hasFile('upload_dokumen')) {
        $uploadedFile = $request->file('upload_dokumen');

        // Create a directory path based on the dpa_id
        $directoryPath = public_path('uploads') . DIRECTORY_SEPARATOR . $buktis->dpa_id;

        // Make sure the directory exists, if not, create it
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        // Move the uploaded file to the directory
        $fileName = time() . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedFile->move($directoryPath, $fileName);

        // Update the dokumenKontrak with the file information
        $buktis->upload_dokumen = $directoryPath . DIRECTORY_SEPARATOR . $fileName;
    }

    $buktis->save();

    return redirect()->route('PembantuPPTKView.bukti.create')->with('success', 'Bukti Pembelian saved successfully.');
}

public function editBukti($id)
{
    $buktis = Bukti::findOrFail($id);
    $dpas = DPA::all(); 
    return view('PembantuPPTKView.bukti.edit', ['buktis' => $buktis, 'dpas' => $dpas]);
}

public function updateBukti(Request $request, $id)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'nama' => 'nullable',
        'nomor' => 'nullable',
        'tanggal' => 'nullable|date',
        'keterangan' => 'nullable',
        'upload_dokumen' => 'nullable|file',
        'dpa_id' => 'required|numeric',
        'alasan' => 'nullable',
    ]);

    $buktis = Bukti::findOrFail($id);

    // Check if a file was uploaded
    if ($request->hasFile('upload_dokumen')) {
        // Handle the file upload
        $file = $request->file('upload_dokumen');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);
        // Update the upload_dokumen field
        $validatedData['upload_dokumen'] = $filename;
    } else {
        // Remove the upload_dokumen field from the validated data array
        unset($validatedData['upload_dokumen']);
    }

    $buktis->fill($validatedData);

    if (!auth()->user()->hasRole('Pembantu PPTK')) {
        if ($request->has('approval')) {
            $buktis->approval = 1;
        } elseif ($request->has('reject')) {
            $buktis->approval = 2;
        } else {
            $buktis->approval = 0;
        }
    }

    $dpaId = $request->input('dpa_id'); 
    $buktis->dpa_id = $dpaId;
    $buktis->save();

    return redirect()->route('PembantuPPTKView.bukti.index', ['dpaId' => $dpaId])->with('success', 'Bukti Pembelian data updated successfully.');
}


//=====================Surat Pemesanan==========================================================

public function createSurat()
{
    $dpas = DPA::all(); // Fetch the list of DPAs
    $dpaId = request()->query('dpaId');
    return view('PembantuPPTKView.surat.create', compact('dpas', 'dpaId'));
}

public function indexSurat($dpaId)
{
    $surats = Surat::where('dpa_id', $dpaId)->firstOrFail();
    return view('PembantuPPTKView.surat.index', ['surats' => $surats, 'dpaId' => $dpaId,]); 
}

public function storeSurat(Request $request)
{
    $validatedData = $request->validate([
        'nama' => 'nullable',
        'nomor' => 'required',
        'tanggal' => 'required|date',
        'keterangan' => 'nullable',
        'upload_dokumen' => 'nullable|file',
        'dpa_id' => 'required|numeric',
        'alasan' => 'nullable',
    ]);

    $surats = new Surat($validatedData);
    $surats->dpa_id = $request->input('dpa_id');

    // Process and store the uploaded file
    if ($request->hasFile('upload_dokumen')) {
        $uploadedFile = $request->file('upload_dokumen');

        $directoryPath = public_path('uploads') . DIRECTORY_SEPARATOR . $surats->dpa_id;

        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        $fileName = time() . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedFile->move($directoryPath, $fileName);

        $surats->upload_dokumen = $directoryPath . DIRECTORY_SEPARATOR . $fileName;
    }

    $surats->save();

    return redirect()->route('PembantuPPTKView.surat.create')->with('success', 'Surat Pemesanan saved successfully.');
}

public function editSurat($id)
{
    $surats = Surat::findOrFail($id);
    $dpas = DPA::all(); 
    return view('PembantuPPTKView.surat.edit', ['surats' => $surats, 'dpas' => $dpas]);
}

public function updateSurat(Request $request, $id)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'nama' => 'nullable',
        'nomor' => 'nullable',
        'tanggal' => 'nullable|date',
        'keterangan' => 'nullable',
        'upload_dokumen' => 'nullable|file',
        'dpa_id' => 'required|numeric',
        'alasan' => 'nullable',
    ]);

    $surats = Surat::findOrFail($id);

        // Check if a file was uploaded
        if ($request->hasFile('upload_dokumen')) {
            // Handle the file upload
            $file = $request->file('upload_dokumen');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            // Update the upload_dokumen field
            $validatedData['upload_dokumen'] = $filename;
        } else {
            // Remove the upload_dokumen field from the validated data array
            unset($validatedData['upload_dokumen']);
        }

    $surats->fill($validatedData);

    
    if (!auth()->user()->hasRole('Pembantu PPTK')) {
        if ($request->has('approval')) {
            $surats->approval = 1;
        } elseif ($request->has('reject')) {
            $surats->approval = 2;
        } else {
            $surats->approval = 0;
        }
    }

    $dpaId = $request->input('dpa_id'); 
    $surats->dpa_id = $dpaId;
    $surats->save();

    return redirect()->route('PembantuPPTKView.surat.index', ['dpaId' => $dpaId])->with('success', 'Surat Pemesanan data updated successfully.');
}



//=====================DOKUMEN KONTRAK SPK==========================================================

public function createDokumenKontrakSPK()
{
    $dpas = DPA::all(); // Fetch the list of DPAs
    $dpaId = request()->query('dpaId'); // Get the value of dpaId from the URL parameter
    return view('PembantuPPTKView.dokumenkontrakspk.create', compact('dpas', 'dpaId'));
}

public function indexDokumenKontrakSPK($dpaId)
{
    $dokumenKontrakspk = DokumenKontrakSPK::where('dpa_id', $dpaId)->firstOrFail();
    return view('PembantuPPTKView.dokumenkontrakspk.index', ['dokumenKontrakspk' => $dokumenKontrakspk,'dpaId' => $dpaId,]);
}


public function storeDokumenKontrakSPK(Request $request)
{
    $validatedData = $request->validate([
        'dpa_id' => 'required|numeric', // Validate the selected DPA
        'no_bukti' => 'nullable|numeric',
        'nama_kegiatan_transaksi' => 'required',
        'tanggal_kontrak' => 'required|date',
        'jumlah_uang' => 'required|numeric',
        'ppn' => 'nullable|numeric',
        'pph' => 'nullable|numeric',
        'potongan_lain' => 'nullable|numeric',
        'jumlah_potongan' => 'nullable|numeric',
        'jumlah_total' => 'required|numeric',
        'keterangan' => 'nullable|string',
        'upload_dokumen' => 'nullable|file',
        'alasan' => 'nullable',
    ]);

    $dokumenKontrakspk = new DokumenKontrakSPK($validatedData);
    $dokumenKontrakspk->dpa_id = $request->input('dpa_id');

    // Process and store the uploaded file
    if ($request->hasFile('upload_dokumen')) {
        $uploadedFile = $request->file('upload_dokumen');

        // Create a directory path based on the dpa_id
        $directoryPath = public_path('uploads') . DIRECTORY_SEPARATOR . $dokumenKontrakspk->dpa_id;

        // Make sure the directory exists, if not, create it
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        // Move the uploaded file to the directory
        $fileName = time() . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedFile->move($directoryPath, $fileName);

        // Update the dokumenKontrak with the file information
        $dokumenKontrakspk->upload_dokumen = $directoryPath . DIRECTORY_SEPARATOR . $fileName;
    }

    $dokumenKontrakspk->save();

    return redirect()->route('PembantuPPTKView.dokumenkontrakspk.create')->with('success', 'Dokumen Kontrak (SPK) saved successfully.');
}

public function editDokumenKontrakSPK($id)
{
    $dokumenKontrakspk = DokumenKontrakSPK::findOrFail($id);
    $dpas = DPA::all(); // Fetch the list of DPAs
    return view('PembantuPPTKView.dokumenkontrakspk.edit', ['dokumenKontrakspk' => $dokumenKontrakspk, 'dpas' => $dpas]);
}

public function updateDokumenKontrakSPK(Request $request, $id)
{
    $validatedData = $request->validate([
        'dpa_id' => 'nullable|numeric', // Validate the selected DPA
        'no_bukti' => 'nullable|numeric',
        'nama_kegiatan_transaksi' => 'nullable',
        'tanggal_kontrak' => 'nullable|date',
        'jumlah_uang' => 'nullable|numeric',
        'ppn' => 'nullable|numeric',
        'pph' => 'nullable|numeric',
        'potongan_lain' => 'nullable|numeric',
        'jumlah_potongan' => 'nullable|numeric',
        'jumlah_total' => 'nullable|numeric',
        'keterangan' => 'nullable|string',
        'upload_dokumen' => 'nullable|file',
        'alasan' => 'nullable',
    ]);

    $dokumenKontrakspk = DokumenKontrakSPK::findOrFail($id);
    $dokumenKontrakspk->fill($validatedData);

    // Set the approval value based on checkbox
    if (!auth()->user()->hasRole('Pembantu PPTK')) {
        if ($request->has('approval')) {
            $dokumenKontrakspk->approval = 1;
        } elseif ($request->has('reject')) {
            $dokumenKontrakspk->approval = 2;
        } else {
            $dokumenKontrakspk->approval = 0;
        }
    }

    $dokumenKontrakspk->save();
    $dpa_id = $request->input('dpa_id'); // Retrieve the value of 'dpa_id' from the request

    return redirect()->route('PembantuPPTKView.dokumenkontrakspk.index', ['dpaId' => $dpa_id])->with('success', 'Dokumen Kontrak (SPK) updated successfully.');
    
}

//=====================Surat Perjanjian==========================================================

public function createSuratPerjanjian()
{
    $dpas = DPA::all(); // Fetch the list of DPAs
    $dpaId = request()->query('dpaId');
    return view('PembantuPPTKView.suratperjanjian.create', compact('dpas', 'dpaId'));
}

public function indexSuratPerjanjian($dpaId)
{
    $suratperjanjians = SuratPerjanjian::where('dpa_id', $dpaId)->firstOrFail();
    return view('PembantuPPTKView.suratperjanjian.index', ['suratperjanjians' => $suratperjanjians, 'dpaId' => $dpaId,]); 
}

public function storeSuratPerjanjian(Request $request)
{
    $validatedData = $request->validate([
        'nama' => 'nullable',
        'nomor' => 'required',
        'tanggal' => 'required|date',
        'keterangan' => 'nullable',
        'upload_dokumen' => 'nullable|file',
        'dpa_id' => 'required|numeric',
        'alasan' => 'nullable',
    ]);

    $suratperjanjians = new SuratPerjanjian($validatedData);
    $suratperjanjians->dpa_id = $request->input('dpa_id');

    // Process and store the uploaded file
    if ($request->hasFile('upload_dokumen')) {
        $uploadedFile = $request->file('upload_dokumen');

        $directoryPath = public_path('uploads') . DIRECTORY_SEPARATOR . $suratperjanjians->dpa_id;

        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        $fileName = time() . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedFile->move($directoryPath, $fileName);

        $suratperjanjians->upload_dokumen = $directoryPath . DIRECTORY_SEPARATOR . $fileName;
    }

    $suratperjanjians->save();

    return redirect()->route('PembantuPPTKView.suratperjanjian.create')->with('success', 'Surat Perjanjian saved successfully.');
}

public function editSuratPerjanjian($id)
{
    $suratperjanjians = SuratPerjanjian::findOrFail($id);
    $dpas = DPA::all(); 
    return view('PembantuPPTKView.suratperjanjian.edit', ['suratperjanjians' => $suratperjanjians, 'dpas' => $dpas]);
}

public function updateSuratPerjanjian(Request $request, $id)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'nama' => 'nullable',
        'nomor' => 'nullable',
        'tanggal' => 'nullable|date',
        'keterangan' => 'nullable',
        'upload_dokumen' => 'nullable|file',
        'dpa_id' => 'required|numeric',
        'alasan' => 'nullable',
    ]);

    $suratperjanjians = SuratPerjanjian::findOrFail($id);

        // Check if a file was uploaded
        if ($request->hasFile('upload_dokumen')) {
            // Handle the file upload
            $file = $request->file('upload_dokumen');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            // Update the upload_dokumen field
            $validatedData['upload_dokumen'] = $filename;
        } else {
            // Remove the upload_dokumen field from the validated data array
            unset($validatedData['upload_dokumen']);
        }

    $suratperjanjians->fill($validatedData);

    if (!auth()->user()->hasRole('Pembantu PPTK')) {
        if ($request->has('approval')) {
            $suratperjanjians->approval = 1;
        } elseif ($request->has('reject')) {
            $suratperjanjians->approval = 2;
        } else {
            $suratperjanjians->approval = 0;
        }
    }

    $dpaId = $request->input('dpa_id'); 
    $suratperjanjians->dpa_id = $dpaId;
    $suratperjanjians->save();

    return redirect()->route('PembantuPPTKView.suratperjanjian.index', ['dpaId' => $dpaId])->with('success', 'Surat Perjanjian data updated successfully.');
}

//=====================Risalah Kontrak==========================================================

public function createRisalahKontrak()
{
    $dpas = DPA::all(); // Fetch the list of DPAs
    $dpaId = request()->query('dpaId');
    return view('PembantuPPTKView.risalahkontrak.create', compact('dpas', 'dpaId'));
}

public function indexRisalahKontrak($dpaId)
{
    $risalahkontraks = RisalahKontrak::where('dpa_id', $dpaId)->firstOrFail();
    return view('PembantuPPTKView.risalahkontrak.index', ['risalahkontraks' => $risalahkontraks, 'dpaId' => $dpaId,]); 
}

public function storeRisalahKontrak(Request $request)
{
    $validatedData = $request->validate([
        'kode_program_kegiatan' => 'required',
        'nama_program' => 'required',
        'nama_kegiatan' => 'required',
        'nama_paket_pekerjaan' => 'nullable',
        'lokasi_pekerjaan' => 'nullable',
        'sumber_dana' => 'nullable',
        'nama_pelaksana_pekerjaan' => 'nullable',
        'jenis_usaha' => 'nullable',
        'alamat_pelaksana_pekerjaan' => 'nullable',
        'nama_pimpinan_direktur' => 'nullable',
        'npwp' => 'nullable',
        'nomor_kontrak' => 'nullable',
        'tanggal_kontrak' => 'required|date',
        'nilai_kontrak' => 'nullable|integer',
        'nomor_rekening_bank' => 'nullable',
        'nama_rekening' => 'nullable',
        'metode_pengadaan' => 'nullable',
        'adendum_kontrak' => 'nullable',
        'keterangan' => 'nullable',
        'upload_dokumen' => 'nullable|file',
        'alasan' => 'nullable',
        'dpa_id' => 'required|numeric',
    ]);

    $risalahkontraks = new RisalahKontrak($validatedData);
    $risalahkontraks->dpa_id = $request->input('dpa_id');

    // Process and store the uploaded file
    if ($request->hasFile('upload_dokumen')) {
        $uploadedFile = $request->file('upload_dokumen');

        $directoryPath = public_path('uploads') . DIRECTORY_SEPARATOR . $risalahkontraks->dpa_id;

        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        $fileName = time() . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedFile->move($directoryPath, $fileName);

        $risalahkontraks->upload_dokumen = $directoryPath . DIRECTORY_SEPARATOR . $fileName;
    }

    $risalahkontraks->save();

    return redirect()->route('PembantuPPTKView.risalahkontrak.create')->with('success', 'Risalah Kontrak saved successfully.');
}

public function editRisalahKontrak($id)
{
    $risalahkontraks = RisalahKontrak::findOrFail($id);
    $dpas = DPA::all(); 
    return view('PembantuPPTKView.risalahkontrak.edit', ['risalahkontraks' => $risalahkontraks, 'dpas' => $dpas]);
}

public function updateRisalahKontrak(Request $request, $id)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'kode_program_kegiatan' => 'required',
        'nama_program' => 'required',
        'nama_kegiatan' => 'required',
        'nama_paket_pekerjaan' => 'nullable',
        'lokasi_pekerjaan' => 'nullable',
        'sumber_dana' => 'nullable',
        'nama_pelaksana_pekerjaan' => 'nullable',
        'jenis_usaha' => 'nullable',
        'alamat_pelaksana_pekerjaan' => 'nullable',
        'nama_pimpinan_direktur' => 'nullable',
        'npwp' => 'nullable',
        'nomor_kontrak' => 'nullable',
        'tanggal_kontrak' => 'required|date',
        'nilai_kontrak' => 'nullable|integer',
        'nomor_rekening_bank' => 'nullable',
        'nama_rekening' => 'nullable',
        'metode_pengadaan' => 'nullable',
        'adendum_kontrak' => 'nullable',
        'keterangan' => 'nullable',
        'upload_dokumen' => 'nullable|file',
        'alasan' => 'nullable',
        'dpa_id' => 'required|numeric',
    ]);

    $risalahkontraks = RisalahKontrak::findOrFail($id);

        // Check if a file was uploaded
        if ($request->hasFile('upload_dokumen')) {
            // Handle the file upload
            $file = $request->file('upload_dokumen');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            // Update the upload_dokumen field
            $validatedData['upload_dokumen'] = $filename;
        } else {
            // Remove the upload_dokumen field from the validated data array
            unset($validatedData['upload_dokumen']);
        }

    $risalahkontraks->fill($validatedData);

    if (!auth()->user()->hasRole('Pembantu PPTK')) {
        if ($request->has('approval')) {
            $risalahkontraks->approval = 1;
        } elseif ($request->has('reject')) {
            $risalahkontraks->approval = 2;
        } else {
            $risalahkontraks->approval = 0;
        }
    }

    $dpaId = $request->input('dpa_id'); 
    $risalahkontraks->dpa_id = $dpaId;
    $risalahkontraks->save();

    return redirect()->route('PembantuPPTKView.risalahkontrak.index', ['dpaId' => $dpaId])->with('success', 'Risalah Kontrak data updated successfully.');
}

//=====================NPWP==========================================================

public function createNPWP()
{
    $dpas = DPA::all(); // Fetch the list of DPAs
    $dpaId = request()->query('dpaId');
    return view('PembantuPPTKView.npwp.create', compact('dpas', 'dpaId'));
}

public function indexNPWP($dpaId)
{
    $npwps = NPWP::where('dpa_id', $dpaId)->firstOrFail();
    return view('PembantuPPTKView.npwp.index', ['npwps' => $npwps, 'dpaId' => $dpaId,]); 
}

public function storeNPWP(Request $request)
{
    $validatedData = $request->validate([
        'nama' => 'nullable',
        'nomor' => 'required',
        'tanggal' => 'required|date',
        'keterangan' => 'nullable',
        'upload_dokumen' => 'nullable|file',
        'dpa_id' => 'required|numeric',
        'alasan' => 'nullable',
    ]);

    $npwps = new NPWP($validatedData);
    $npwps->dpa_id = $request->input('dpa_id');

    // Process and store the uploaded file
    if ($request->hasFile('upload_dokumen')) {
        $uploadedFile = $request->file('upload_dokumen');

        $directoryPath = public_path('uploads') . DIRECTORY_SEPARATOR . $npwps->dpa_id;

        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        $fileName = time() . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedFile->move($directoryPath, $fileName);

        $npwps->upload_dokumen = $directoryPath . DIRECTORY_SEPARATOR . $fileName;
    }

    $npwps->save();

    return redirect()->route('PembantuPPTKView.npwp.create')->with('success', 'NPWP saved successfully.');
}

public function editNPWP($id)
{
    $npwps = NPWP::findOrFail($id);
    $dpas = DPA::all(); 
    return view('PembantuPPTKView.npwp.edit', ['npwps' => $npwps, 'dpas' => $dpas]);
}

public function updateNPWP(Request $request, $id)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'nama' => 'nullable',
        'nomor' => 'nullable',
        'tanggal' => 'nullable|date',
        'keterangan' => 'nullable',
        'upload_dokumen' => 'nullable|file',
        'dpa_id' => 'required|numeric',
        'alasan' => 'nullable',
    ]);

    $npwps = NPWP::findOrFail($id);

        // Check if a file was uploaded
        if ($request->hasFile('upload_dokumen')) {
            // Handle the file upload
            $file = $request->file('upload_dokumen');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            // Update the upload_dokumen field
            $validatedData['upload_dokumen'] = $filename;
        } else {
            // Remove the upload_dokumen field from the validated data array
            unset($validatedData['upload_dokumen']);
        }

    $npwps->fill($validatedData);

    if (!auth()->user()->hasRole('Pembantu PPTK')) {
        if ($request->has('approval')) {
            $npwps->approval = 1;
        } elseif ($request->has('reject')) {
            $npwps->approval = 2;
        } else {
            $npwps->approval = 0;
        }
    }

    $dpaId = $request->input('dpa_id'); 
    $npwps->dpa_id = $dpaId;
    $npwps->save();

    return redirect()->route('PembantuPPTKView.npwp.index', ['dpaId' => $dpaId])->with('success', 'NPWP data updated successfully.');
}

//=====================Buku Rekening Bank==========================================================

public function createBuku()
{
    $dpas = DPA::all(); // Fetch the list of DPAs
    $dpaId = request()->query('dpaId');
    return view('PembantuPPTKView.buku.create', compact('dpas', 'dpaId'));
}

public function indexBuku($dpaId)
{
    $bukus = Buku::where('dpa_id', $dpaId)->firstOrFail();
    return view('PembantuPPTKView.buku.index', ['bukus' => $bukus, 'dpaId' => $dpaId,]); 
}

public function storeBuku(Request $request)
{
    $validatedData = $request->validate([
        'nama' => 'nullable',
        'nomor' => 'required',
        'tanggal' => 'required|date',
        'keterangan' => 'nullable',
        'upload_dokumen' => 'nullable|file',
        'dpa_id' => 'required|numeric',
        'alasan' => 'nullable',
    ]);

    $bukus = new Buku($validatedData);
    $bukus->dpa_id = $request->input('dpa_id');

    // Process and store the uploaded file
    if ($request->hasFile('upload_dokumen')) {
        $uploadedFile = $request->file('upload_dokumen');

        $directoryPath = public_path('uploads') . DIRECTORY_SEPARATOR . $bukus->dpa_id;

        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        $fileName = time() . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedFile->move($directoryPath, $fileName);

        $bukus->upload_dokumen = $directoryPath . DIRECTORY_SEPARATOR . $fileName;
    }

    $bukus->save();

    return redirect()->route('PembantuPPTKView.buku.create')->with('success', 'Buku Rekening Bank saved successfully.');
}

public function editBuku($id)
{
    $bukus = Buku::findOrFail($id);
    $dpas = DPA::all(); 
    return view('PembantuPPTKView.buku.edit', ['bukus' => $bukus, 'dpas' => $dpas]);
}

public function updateBuku(Request $request, $id)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'nama' => 'nullable',
        'nomor' => 'nullable',
        'tanggal' => 'nullable|date',
        'keterangan' => 'nullable',
        'upload_dokumen' => 'nullable|file',
        'dpa_id' => 'required|numeric',
        'alasan' => 'nullable',
    ]);

    $bukus = Buku::findOrFail($id);

        // Check if a file was uploaded
        if ($request->hasFile('upload_dokumen')) {
            // Handle the file upload
            $file = $request->file('upload_dokumen');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            // Update the upload_dokumen field
            $validatedData['upload_dokumen'] = $filename;
        } else {
            // Remove the upload_dokumen field from the validated data array
            unset($validatedData['upload_dokumen']);
        }

    $bukus->fill($validatedData);

    if (!auth()->user()->hasRole('Pembantu PPTK')) {
        if ($request->has('approval')) {
            $bukus->approval = 1;
        } elseif ($request->has('reject')) {
            $bukus->approval = 2;
        } else {
            $bukus->approval = 0;
        }
    }

    $dpaId = $request->input('dpa_id'); 
    $bukus->dpa_id = $dpaId;
    $bukus->save();

    return redirect()->route('PembantuPPTKView.buku.index', ['dpaId' => $dpaId])->with('success', 'Buku Rekening Bank data updated successfully.');
}

//=====================NIB==========================================================

public function createNIB()
{
    $dpas = DPA::all(); // Fetch the list of DPAs
    $dpaId = request()->query('dpaId');
    return view('PembantuPPTKView.nib.create', compact('dpas', 'dpaId'));
}

public function indexNIB($dpaId)
{
    $nibs = NIB::where('dpa_id', $dpaId)->firstOrFail();
    return view('PembantuPPTKView.nib.index', ['nibs' => $nibs, 'dpaId' => $dpaId,]); 
}

public function storeNIB(Request $request)
{
    $validatedData = $request->validate([
        'nama' => 'nullable',
        'nomor' => 'required',
        'tanggal' => 'required|date',
        'keterangan' => 'nullable',
        'upload_dokumen' => 'nullable|file',
        'dpa_id' => 'required|numeric',
        'alasan' => 'nullable',
    ]);

    $nibs = new NIB($validatedData);
    $nibs->dpa_id = $request->input('dpa_id');

    // Process and store the uploaded file
    if ($request->hasFile('upload_dokumen')) {
        $uploadedFile = $request->file('upload_dokumen');

        $directoryPath = public_path('uploads') . DIRECTORY_SEPARATOR . $nibs->dpa_id;

        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        $fileName = time() . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedFile->move($directoryPath, $fileName);

        $nibs->upload_dokumen = $directoryPath . DIRECTORY_SEPARATOR . $fileName;
    }

    $nibs->save();

    return redirect()->route('PembantuPPTKView.nib.create')->with('success', 'NIB saved successfully.');
}

public function editNIB($id)
{
    $nibs = NIB::findOrFail($id);
    $dpas = DPA::all(); 
    return view('PembantuPPTKView.nib.edit', ['nibs' => $nibs, 'dpas' => $dpas]);
}

public function updateNIB(Request $request, $id)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'nama' => 'nullable',
        'nomor' => 'nullable',
        'tanggal' => 'nullable|date',
        'keterangan' => 'nullable',
        'upload_dokumen' => 'nullable|file',
        'dpa_id' => 'required|numeric',
        'alasan' => 'nullable',
    ]);

    $nibs = NIB::findOrFail($id);

        // Check if a file was uploaded
        if ($request->hasFile('upload_dokumen')) {
            // Handle the file upload
            $file = $request->file('upload_dokumen');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            // Update the upload_dokumen field
            $validatedData['upload_dokumen'] = $filename;
        } else {
            // Remove the upload_dokumen field from the validated data array
            unset($validatedData['upload_dokumen']);
        }

    $nibs->fill($validatedData);

    if (!auth()->user()->hasRole('Pembantu PPTK')) {
        if ($request->has('approval')) {
            $nibs->approval = 1;
        } elseif ($request->has('reject')) {
            $nibs->approval = 2;
        } else {
            $nibs->approval = 0;
        }
    }

    $dpaId = $request->input('dpa_id'); 
    $nibs->dpa_id = $dpaId;
    $nibs->save();

    return redirect()->route('PembantuPPTKView.nib.index', ['dpaId' => $dpaId])->with('success', 'NIB data updated successfully.');
}


public function dokumenPembantuPPTK()
{
    // Retrieve the data for the "Dokumen Kontrak" row
    $dokumenKontrak = DokumenKontrak::where('dpa_id', request()->query('dpaId'))->first();
    $dokumenjustifikasi = DokumenJustifikasi::where('dpa_id', request()->query('dpaId'))->first();
    $dokumenPendukung = DokumenPendukung::where('dpa_id', request()->query('dpaId'))->first();
    $dokumenEpurchasing = EPurchasing::where('dpa_id', request()->query('dpaId'))->first();
    $bap = Bap::where('dpa_id', request()->query('dpaId'))->first();
    $baph = Baph::where('dpa_id', request()->query('dpaId'))->first();
    $bast = Bast::where('dpa_id', request()->query('dpaId'))->first();
    /* $pilihRekanan = PilihRekanan::where('dpa_id', request()->query('dpaId'))->first(); */
    $buktis = Bukti::where('dpa_id', request()->query('dpaId'))->first();
    $surats = Surat::where('dpa_id', request()->query('dpaId'))->first();
    $dokumenKontrakSPK = DokumenKontrakSPK::where('dpa_id', request()->query('dpaId'))->first();
    $risalahkontrak = RisalahKontrak::where('dpa_id', request()->query('dpaId'))->first();
    $npwp = NPWP::where('dpa_id', request()->query('dpaId'))->first();
    $buku = Buku::where('dpa_id', request()->query('dpaId'))->first();
    $nib = NIB::where('dpa_id', request()->query('dpaId'))->first();

    
    $suratperjanjians = SuratPerjanjian::where('dpa_id', request()->query('dpaId'))->first();

    // Pass the data to the view
    return view('PembantuPPTKView.dokumenpembantupptk', ['dokumenKontrak' => $dokumenKontrak, 'dokumenjustifikasi' => $dokumenjustifikasi, 'bap' => $bap, 
    'dokumenEpurchasing' => $dokumenEpurchasing, 'dokumenPendukung' => $dokumenPendukung, 'baph' => $baph, 'bast' => $bast/* , 'pilihRekanan' => $pilihRekanan */
    , 'buktis' => $buktis, 'surats' => $surats, 'dokumenKontrakSPK' => $dokumenKontrakSPK, 'suratperjanjians' => $suratperjanjians, 'risalahkontrak' => $risalahkontrak, 
    'npwp' => $npwp, 'buku' => $buku, 'nib' => $nib ]);
}
}


