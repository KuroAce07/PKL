<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CeklisForm;
use Illuminate\Support\Facades\Response;
use PDF;

class CeklisformController extends Controller
{
    public function index($dpa_id)
    {
        $ceklisForms = CeklisForm::where('dpa_id', $dpa_id)->get();
        return view('ceklisform.index', ['ceklisForms' => $ceklisForms, 'dpa_id' => $dpa_id]);

    }
    public function store(Request $request)
    {
        $dpa_id = $request->input('dpa_id');
        $data = [
            'dpa_id' => $dpa_id, // Assuming dpa_id is passed through the form
            'nama' => $request->has('nama') ? 1 : 0,
            'kwitansi' => $request->has('kwitansi') ? 1 : 0,
            'nota_bukti_invoice' => $request->has('nota_bukti_invoice') ? 1 : 0,
            'dok_kontrak' => $request->has('dok_kontrak') ? 1 : 0,
            'surat_pemesanan' => $request->has('surat_pemesanan') ? 1 : 0,
            'surat_perjanjian' => $request->has('surat_perjanjian') ? 1 : 0,
            'ringkasan_kontrak' => $request->has('ringkasan_kontrak') ? 1 : 0,
            'dok_epurchasing' => $request->has('dok_epurchasing') ? 1 : 0,
            'dok_pendukung' => $request->has('dok_pendukung') ? 1 : 0,
            'tkdn' => $request->has('tkdn') ? 1 : 0,
            'berita_serah_terima' => $request->has('berita_serah_terima') ? 1 : 0,
            'berita_pembayaran' => $request->has('berita_pembayaran') ? 1 : 0,
            'berita_pemeriksaan' => $request->has('berita_pemeriksaan') ? 1 : 0,
            // ... repeat for other checkbox fields
        ];
        CeklisForm::create($data);
        // $checkboxFields = ['kwitansi', 'nota_bukti_invoice', 'surat_pemesanan', 'dok_kontrak', 'surat_perjanjian', 'ringkasan_kontrak', 'dok_epurchasing', 'dok_pendukung', 'tkdn', 'berita_serah_terima', 'berita_pembayaran', 'berita_pemeriksaan'];
        // foreach ($checkboxFields as $field) {
        //     $data[$field] = $request->has($field) ? 1 : 0;
        
    
        // Create the CeklisForm record
        // CeklisForm::create($data);
    
        // Generate and save PDF
        $pdfPath = $this->generatePDF($dpa_id);
        $request->session()->put('pdfPath', $pdfPath);
    
        return redirect()->route('ceklisform.result', ['id' => $data['dpa_id']]);
    }
    
   

    
    public function generatePDF($dpa_id)
    {
        $ceklisForms = CeklisForm::where('dpa_id', $dpa_id)->get();
        // dd($ceklisForms);
        $pdf = PDF::loadView('ceklisform.pdf', ['ceklisForms' => $ceklisForms]);
        
        $pdfPath = 'uploads/' . 'ceklisform_' . $dpa_id . '.pdf';
        $pdf->save(public_path($pdfPath));
        
        return $pdfPath;
    }

    public function downloadPdf($dpa_id)
    {
        $pdfPath = $this->generatePDF($dpa_id);
        
        $pdfContent = file_get_contents(public_path($pdfPath));
        $response = Response::make($pdfContent);
        $response->header('Content-Type', 'application/pdf');
        $response->header('Content-Disposition', 'inline; filename="' . $pdfPath . '"');
        
        return $response;
    }

    public function showResult($dpa_id)
    {
        $ceklisForms = CeklisForm::where('dpa_id', $dpa_id)->get();
        return view('ceklisform.result', ['ceklisForms' => $ceklisForms, 'dpa_id' => $dpa_id]);
    }

    public function edit($dpa_id)
    {
        $ceklis = Ceklisform::where('dpa_id', $dpa_id)->first();
        if (!$ceklis) {
            return redirect()->route('ceklisform.result', ['id' => $dpa_id])->with('error', 'Berkas not found.');
        }

        return view('ceklisform.edit', compact('ceklis', 'dpa_id'));
    }
    public function update(Request $request, $dpa_id)
    {
        
        // Validasi data yang diubah
        $data = [
            'kwitansi' => $request->has('kwitansi') ? 1 : 0,
            'nota_bukti_invoice' => $request->has('nota_bukti_invoice') ? 1 : 0,
            'dok_kontrak' => $request->has('dok_kontrak') ? 1 : 0,
            'surat_pemesanan' => $request->has('surat_pemesanan') ? 1 : 0,
            'surat_perjanjian' => $request->has('surat_perjanjian') ? 1 : 0,
            'ringkasan_kontrak' => $request->has('ringkasan_kontrak') ? 1 : 0,
            'dok_epurchasing' => $request->has('dok_epurchasing') ? 1 : 0,
            'dok_pendukung' => $request->has('dok_pendukung') ? 1 : 0,
            'tkdn' => $request->has('tkdn') ? 1 : 0,
            'berita_serah_terima' => $request->has('berita_serah_terima') ? 1 : 0,
            'berita_pembayaran' => $request->has('berita_pembayaran') ? 1 : 0,
            'berita_pemeriksaan' => $request->has('berita_pemeriksaan') ? 1 : 0,
            // ... repeat for other checkbox fields
        ];

        // Temukan data berdasarkan ID
        $ceklisform = Ceklisform::where('dpa_id', $dpa_id)->first();

        // Update data dengan data yang baru
        $ceklisform->update($data);
        
        return redirect()->route('ceklisform.result', ['id' => $dpa_id])->with('success', 'Form updated successfully.');
    }


}
