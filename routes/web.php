<?php

use App\Http\Controllers\ViewDPAController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\PembantuPPTKUploadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Imports\ArsipLamaImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\RekananController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\BendaharaController;
use App\Http\Controllers\CeklisformController;
use App\Http\Controllers\DokumenKontrakController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Profile Routes
Route::prefix('profile')->name('profile.')->middleware('auth')->group(function(){
    Route::get('/', [HomeController::class, 'getProfile'])->name('detail');
    Route::post('/update', [HomeController::class, 'updateProfile'])->name('update');
    Route::post('/change-password', [HomeController::class, 'changePassword'])->name('change-password');
});

// Roles
Route::resource('roles', App\Http\Controllers\RolesController::class);

//arsip
Route::get('/imported-data', [ImportController::class, 'showImportedData'])->name('imported.data');
Route::resource('/arsip', App\Http\Controllers\ArsipController::class);
Route::get('/Dokumen', [ArsipController::class, 'index'])->name('Arsip.index');
Route::get('/Dokumen/Import-file', [ArsipController::class, 'importfile'])->name('Arsip.importfile');
Route::post('/Dokumen/Import', [ArsipController::class, 'import'])->name('Arsip.import');
Route::get('/Dokumen/{id}/Edit', [ArsipController::class, 'edit'])->name('Arsip.edit');
Route::put('/Dokumen/{id}', [ArsipController::class, 'update'])->name('Arsip.update');
Route::get('/Dokumen/{id}/File', [ArsipController::class, 'file'])->name('Arsip.file');
Route::get('/Dokumen/Create', [ArsipController::class, 'create'])->name('Arsip.create');
Route::post('/Dokumen/Store', [ArsipController::class, 'store'])->name('Arsip.store');
Route::delete('/Dokumen/{id}', [ArsipController::class, 'destroy'])->name('Arsip.destroy');
Route::get('/Dokumen/Export', [ArsipController::class, 'export'])->name('Arsip.export');
Route::post('/Dokumen/{id}/storefile', [ArsipController::class, 'storefile'])->name('Arsip.storefile');

// Permissions
Route::resource('permissions', App\Http\Controllers\PermissionsController::class);
//rekanan
Route::resource('rekanan', RekananController::class);
Route::get('/Rekanan', [RekananController::class, 'index'])->name('rekanan.index');
Route::get('/Rekanan/Create', [RekananController::class, 'create'])->name('rekanan.create');
Route::post('/Rekanan/Store', [RekananController::class, 'store'])->name('rekanan.store');
Route::get('/Rekanan/{id}/Edit', [RekananController::class, 'edit'])->name('rekanan.edit');
Route::put('/Rekanan/{id}', [RekananController::class, 'update'])->name('rekanan.update');

Route::get('/dokumenpembantupptk', [PembantuPPTKUploadController::class, 'dokumenPembantuPPTK'])->name('PembantuPPTKView.dokumenpembantupptk');

    //E-Purchasing
    Route::get('/epurchasing/create', [PembantuPPTKUploadController::class, 'createEPurchasing'])->name('PembantuPPTKView.epurchaseview.create');
    Route::put('/epurchasing/{id}', [PembantuPPTKUploadController::class, 'updateEPurchasing'])->name('PembantuPPTKView.epurchaseview.update');
    Route::post('/epurchasing/store', [PembantuPPTKUploadController::class, 'storeEPurchasing'])->name('PembantuPPTKView.epurchaseview.store');
    Route::get('/epurchasing/{id}/edit', [PembantuPPTKUploadController::class, 'editEPurchasing'])->name('PembantuPPTKView.epurchaseview.edit');
    Route::get('/epurchasing/{dpaId}', [PembantuPPTKUploadController::class, 'indexEPurchasing'])->name('PembantuPPTKView.epurchaseview.index');

    //BAST
    Route::get('/bast/create', [PembantuPPTKUploadController::class, 'createBast'])->name('PembantuPPTKView.bast.create');
    Route::post('/bast/store', [PembantuPPTKUploadController::class, 'storeBast'])->name('PembantuPPTKView.bast.store');
    Route::get('/bast/{dpaId}', [PembantuPPTKUploadController::class, 'indexBast'])->name('PembantuPPTKView.bast.index');
    Route::get('/bast/{id}/edit', [PembantuPPTKUploadController::class, 'editBast'])->name('PembantuPPTKView.bast.edit');
    Route::put('/bast/{id}', [PembantuPPTKUploadController::class, 'updateBast'])->name('PembantuPPTKView.bast.update');
    
    //DokumenKontrak
    Route::get('/dokumenkontrak/create', [PembantuPPTKUploadController::class, 'createDokumenKontrak'])->name('PembantuPPTKView.dokumenkontrak.create');
    Route::post('/dokumenkontrak/store', [PembantuPPTKUploadController::class, 'storeDokumenKontrak'])->name('PembantuPPTKView.dokumenkontrak.store');
    Route::get('/dokumenkontrak/{dpaId}', [PembantuPPTKUploadController::class, 'showDokumenKontrak'])->name('PembantuPPTKView.dokumenkontrak.show');
    Route::get('/dokumenkontrak/{id}/edit', [PembantuPPTKUploadController::class, 'editDokumenKontrak'])->name('PembantuPPTKView.dokumenkontrak.edit');
    Route::put('/dokumenkontrak/update/{id}', [PembantuPPTKUploadController::class, 'updateDokumenKontrak'])->name('PembantuPPTKView.dokumenkontrak.update');

    //DokumenPendukung
    Route::get('/dokumenpendukung/create', [PembantuPPTKUploadController::class, 'createDokumenPendukung'])->name('PembantuPPTKView.dokumenpendukung.create');
    Route::get('/dokumenpendukung/{dpaId}', [PembantuPPTKUploadController::class, 'indexDokumenPendukung'])->name('PembantuPPTKView.dokumenpendukung.index');
    Route::post('/dokumenpendukung', [PembantuPPTKUploadController::class, 'storeDokumenPendukung'])->name('PembantuPPTKView.dokumenpendukung.store');
    Route::get('/dokumenpendukung/{id}/edit', [PembantuPPTKUploadController::class, 'editDokumenPendukung'])->name('PembantuPPTKView.dokumenpendukung.edit');
    Route::put('/dokumenpendukung/{id}', [PembantuPPTKUploadController::class, 'updateDokumenPendukung'])->name('PembantuPPTKView.dokumenpendukung.update');

    //DokumenJustifikasi
    Route::get('/dokumenjustifikasi/create', [PembantuPPTKUploadController::class, 'createDokumenJustifikasi'])->name('PembantuPPTKView.dokumenjustifikasi.create');
    Route::get('/dokumenjustifikasi/{dpaId}', [PembantuPPTKUploadController::class, 'indexDokumenJustifikasi'])->name('PembantuPPTKView.dokumenjustifikasi.index');
    Route::post('/dokumenjustifikasi', [PembantuPPTKUploadController::class, 'storeDokumenJustifikasi'])->name('PembantuPPTKView.dokumenjustifikasi.store');
    Route::get('/dokumenjustifikasi/{id}/edit', [PembantuPPTKUploadController::class, 'editDokumenJustifikasi'])->name('PembantuPPTKView.dokumenjustifikasi.edit');
    Route::put('/dokumenjustifikasi/{id}', [PembantuPPTKUploadController::class, 'updateDokumenJustifikasi'])->name('PembantuPPTKView.dokumenjustifikasi.update');    

    //BAP
    Route::get('/bap/create', [PembantuPPTKUploadController::class, 'createBap'])->name('PembantuPPTKView.bap.create');
    Route::post('/bap/store', [PembantuPPTKUploadController::class, 'storeBap'])->name('PembantuPPTKView.bap.store');
    Route::get('/bap/{dpaId}', [PembantuPPTKUploadController::class, 'indexBap'])->name('PembantuPPTKView.bap.index');
    Route::get('/bap/{id}/edit', [PembantuPPTKUploadController::class, 'editBap'])->name('PembantuPPTKView.bap.edit');
    Route::put('/bap/{id}', [PembantuPPTKUploadController::class, 'updateBap'])->name('PembantuPPTKView.bap.update');
    
    //BAPH
    Route::put('/baph/{id}', [PembantuPPTKUploadController::class, 'updateBaph'])->name('PembantuPPTKView.baph.update');
    Route::get('/baph/create', [PembantuPPTKUploadController::class, 'createBaph'])->name('PembantuPPTKView.baph.create');
    Route::get('/baph/{dpaId}', [PembantuPPTKUploadController::class, 'indexBaph'])->name('PembantuPPTKView.baph.index');
    Route::post('/baph/store', [PembantuPPTKUploadController::class, 'storeBaph'])->name('PembantuPPTKView.baph.store');
    Route::get('/baph/{id}/edit', [PembantuPPTKUploadController::class, 'editBaph'])->name('PembantuPPTKView.baph.edit');

    /* //PilihRekanan
    Route::get('/pilihrekanan/create', [PembantuPPTKUploadController::class, 'createPilihRekanan'])->name('PembantuPPTKView.pilihrekanan.create');
    Route::get('/pilihrekanan/{dpaId}', [PembantuPPTKUploadController::class, 'indexPilihRekanan'])->name('PembantuPPTKView.pilihrekanan.index');
    Route::get('/pilihrekanan/{id}/edit', [PembantuPPTKUploadController::class, 'editPilihRekanan'])->name('PembantuPPTKView.pilihrekanan.edit');
    Route::post('/pilihrekanan/store', [PembantuPPTKUploadController::class, 'storePilihRekanan'])->name('PembantuPPTKView.pilihrekanan.store');
    Route::put('/pilihrekanan/{id}', [PembantuPPTKUploadController::class, 'updatePilihRekanan'])->name('PembantuPPTKView.pilihrekanan.update'); */

    //Bukti
    Route::get('/bukti/create', [PembantuPPTKUploadController::class, 'createBukti'])->name('PembantuPPTKView.bukti.create'); 
    Route::post('/bukti/store', [PembantuPPTKUploadController::class, 'storeBukti'])->name('PembantuPPTKView.bukti.store');
    Route::get('/bukti/{dpaId}', [PembantuPPTKUploadController::class, 'indexBukti'])->name('PembantuPPTKView.bukti.index');
    Route::get('/bukti/{id}/edit', [PembantuPPTKUploadController::class, 'editBukti'])->name('PembantuPPTKView.bukti.edit');
    Route::put('/bukti/{id}', [PembantuPPTKUploadController::class, 'updateBukti'])->name('PembantuPPTKView.bukti.update');

    //Surat Pemesanan
    Route::get('/surat/create', [PembantuPPTKUploadController::class, 'createSurat'])->name('PembantuPPTKView.surat.create'); 
    Route::post('/surat/store', [PembantuPPTKUploadController::class, 'storeSurat'])->name('PembantuPPTKView.surat.store');
    Route::get('/surat/{dpaId}', [PembantuPPTKUploadController::class, 'indexSurat'])->name('PembantuPPTKView.surat.index');
    Route::get('/surat/{id}/edit', [PembantuPPTKUploadController::class, 'editSurat'])->name('PembantuPPTKView.surat.edit');
    Route::put('/surat/{id}', [PembantuPPTKUploadController::class, 'updateSurat'])->name('PembantuPPTKView.surat.update');

    //Dokumen Kontrak SPK
    Route::get('/dokumenkontrakspk/create', [PembantuPPTKUploadController::class, 'createDokumenKontrakSPK'])->name('PembantuPPTKView.dokumenkontrakspk.create');
    Route::post('/dokumenkontrakspk/store', [PembantuPPTKUploadController::class, 'storeDokumenKontrakSPK'])->name('PembantuPPTKView.dokumenkontrakspk.store');
    Route::get('/dokumenkontrakspk/{dpaId}', [PembantuPPTKUploadController::class, 'indexDokumenKontrakSPK'])->name('PembantuPPTKView.dokumenkontrakspk.index');
    Route::get('/dokumenkontrakspk/{id}/edit', [PembantuPPTKUploadController::class, 'editDokumenKontrakSPK'])->name('PembantuPPTKView.dokumenkontrakspk.edit');
    Route::put('/dokumenkontrakspk/update/{id}', [PembantuPPTKUploadController::class, 'updateDokumenKontrakSPK'])->name('PembantuPPTKView.dokumenkontrakspk.update');

    //Surat Perjanjian
    Route::get('/suratperjanjian/create', [PembantuPPTKUploadController::class, 'createSuratPerjanjian'])->name('PembantuPPTKView.suratperjanjian.create'); 
    Route::post('/suratperjanjian/store', [PembantuPPTKUploadController::class, 'storeSuratPerjanjian'])->name('PembantuPPTKView.suratperjanjian.store');
    Route::get('/suratperjanjian/{dpaId}', [PembantuPPTKUploadController::class, 'indexSuratPerjanjian'])->name('PembantuPPTKView.suratperjanjian.index');
    Route::get('/suratperjanjian/{id}/edit', [PembantuPPTKUploadController::class, 'editSuratPerjanjian'])->name('PembantuPPTKView.suratperjanjian.edit');
    Route::put('/suratperjanjian/{id}', [PembantuPPTKUploadController::class, 'updateSuratPerjanjian'])->name('PembantuPPTKView.suratperjanjian.update');

    //Risalah Kontrak
    Route::get('/risalahkontrak/create', [PembantuPPTKUploadController::class, 'createRisalahKontrak'])->name('PembantuPPTKView.risalahkontrak.create'); 
    Route::post('/risalahkontrak/store', [PembantuPPTKUploadController::class, 'storeRisalahKontrak'])->name('PembantuPPTKView.risalahkontrak.store');
    Route::get('/risalahkontrak/{dpaId}', [PembantuPPTKUploadController::class, 'indexRisalahKontrak'])->name('PembantuPPTKView.risalahkontrak.index');
    Route::get('/risalahkontrak/{id}/edit', [PembantuPPTKUploadController::class, 'editRisalahKontrak'])->name('PembantuPPTKView.risalahkontrak.edit');
    Route::put('/risalahkontrak/{id}', [PembantuPPTKUploadController::class, 'updateRisalahKontrak'])->name('PembantuPPTKView.risalahkontrak.update');

    //NPWP
    Route::get('/npwp/create', [PembantuPPTKUploadController::class, 'createNPWP'])->name('PembantuPPTKView.npwp.create'); 
    Route::post('/npwp/store', [PembantuPPTKUploadController::class, 'storeNPWP'])->name('PembantuPPTKView.npwp.store');
    Route::get('/npwp/{dpaId}', [PembantuPPTKUploadController::class, 'indexNPWP'])->name('PembantuPPTKView.npwp.index');
    Route::get('/npwp/{id}/edit', [PembantuPPTKUploadController::class, 'editNPWP'])->name('PembantuPPTKView.npwp.edit');
    Route::put('/npwp/{id}', [PembantuPPTKUploadController::class, 'updateNPWP'])->name('PembantuPPTKView.npwp.update');

    //Buku Rekening
    Route::get('/buku/create', [PembantuPPTKUploadController::class, 'createBuku'])->name('PembantuPPTKView.buku.create'); 
    Route::post('/buku/store', [PembantuPPTKUploadController::class, 'storeBuku'])->name('PembantuPPTKView.buku.store');
    Route::get('/buku/{dpaId}', [PembantuPPTKUploadController::class, 'indexBuku'])->name('PembantuPPTKView.buku.index');
    Route::get('/buku/{id}/edit', [PembantuPPTKUploadController::class, 'editBuku'])->name('PembantuPPTKView.buku.edit');
    Route::put('/buku/{id}', [PembantuPPTKUploadController::class, 'updateBuku'])->name('PembantuPPTKView.buku.update');

    //NIB
    Route::get('/nib/create', [PembantuPPTKUploadController::class, 'createNIB'])->name('PembantuPPTKView.nib.create'); 
    Route::post('/nib/store', [PembantuPPTKUploadController::class, 'storeNIB'])->name('PembantuPPTKView.nib.store');
    Route::get('/nib/{dpaId}', [PembantuPPTKUploadController::class, 'indexNIB'])->name('PembantuPPTKView.nib.index');
    Route::get('/nib/{id}/edit', [PembantuPPTKUploadController::class, 'editNIB'])->name('PembantuPPTKView.nib.edit');
    Route::put('/nib/{id}', [PembantuPPTKUploadController::class, 'updateNIB'])->name('PembantuPPTKView.nib.update');
    
    

// Upload DPA
Route::resource('UploadDPA', App\Http\Controllers\UploadDPAController::class);
Route::get('/UploadDpa', [UploadDPAController::class, 'index'])->name('UploadDpa.index');
Route::post('/UploadDpa', [UploadDPAController::class, 'store'])->name('UploadDpa.store');
//Route::get('/ViewDpa', [ViewDPAController::class, 'index'])->name('ViewDPA.index');
//Route::get('/', [UploadDPAController::class, 'index'])->name('upload_dpa.index');
//Route::post('/store', [UploadDPAController::class, 'store'])->name('upload_dpa.store');

// View List DPA
Route::resource('ViewDPA', App\Http\Controllers\ViewDPAController::class);
//export
Route::get('/DPA/Export', [ViewDPAController::class, 'export'])->name('ViewDPA.export');
//view sub DPA
Route::get('/DPA/Lama/{id_dpa}', [ViewDPAController::class, 'dppa'])->name('ViewDPA.dppa');
Route::get('/RAK', [ViewDPAController::class, 'rak'])->name('ViewDPA.rak');
Route::get('/RAK/Edit/{id}', [ViewDPAController::class, 'rak'])->name('ViewDPA.editrak');
//realisasi
Route::get('/RAK/Realisasi/{id}', [ViewDPAController::class, 'realrak'])->name('ViewDPA.realrak');
Route::put('/RAK/Realisasi/{id}', [ViewDPAController::class, 'updateRealisasi'])->name('ViewDPA.updateRealisasi');
//sumber dana dan pengadaan
Route::get('/sumberdana', [ViewDPAController::class, 'sumberdana'])->name('ViewDPA.sumberdana');
Route::post('/sumberdana', [ViewDPAController::class, 'addsumberdana'])->name('ViewDPA.sumberdana');
Route::delete('/sumberdana/{id}', [ViewDPAController::class, 'deletesumberdana'])->name('ViewDPA.deletesumberdana');
Route::get('/metodepengadaan', [ViewDPAController::class, 'metodepengadaan'])->name('ViewDPA.metodepengadaan');
Route::post('/metodepengadaan', [ViewDPAController::class, 'addmetodepengadaan'])->name('ViewDPA.metodepengadaan');
Route::delete('/metodepengadaan/{id}', [ViewDPAController::class, 'deleteMetodePengadaan'])->name('ViewDPA.deleteMetodePengadaan');


Route::delete('/deleteDPA/{id}', [ViewDPAController::class, 'destroy'])->name('ViewDPA.destroy');
Route::put('/RAK/{dpa}', [ViewDPAController::class, 'update'])->name('updaterak');
Route::get('/EditDPA/{id}', [ViewDPAController::class, 'edit'])->name('editDPA');
Route::get('/ViewPDF/{id}', [ViewDPAController::class, 'viewPDF'])->name('viewPDF');
Route::put('/DPA/{dpa}', [ViewDPAController::class, 'update'])->name('updateDPA');
Route::get('/assignPP/{dpaId}/{userId}', [ViewDPAController::class, 'assignPP'])->name('ViewDPA.assignPP');
Route::get('/assignPPPTK/{dpaId}/{userId}', [ViewDPAController::class, 'assignPPPTK'])->name('ViewDPA.assignPPPTK');
Route::get('/assignBendahara/{dpaId}/{userId}', [ViewDPAController::class, 'assignBendahara'])->name('ViewDPA.assignBendahara');
        Route::get('/deskripsi-bendahara/{dpaId}', [ViewDPAController::class, 'showDeskripsiBendahara'])->name('deskripsiBendahara');
        Route::put('/update-description/{dpaId}', [ViewDPAController::class, 'updateDescription'])->name('updateDescription');
        Route::get('/deskripsi-pejabat-pengadaan/{dpaId}', [ViewDPAController::class, 'showDeskripsiPejabatPengadaan'])->name('deskripsiPejabatPengadaan');
        Route::put('/update-description-pp/{dpaId}', [ViewDPAController::class, 'updateDescriptionPP'])->name('updateDescriptionPP');
        Route::get('/deskripsi-ppptk/{dpaId}', [ViewDPAController::class, 'showDeskripsiPPPTK'])->name('deskripsiPPPTK');
        Route::put('/update-description-ppptk/{dpaId}', [ViewDPAController::class, 'updateDescriptionPPPTK'])->name('updateDescriptionPPPTK');
        Route::post('/submitRUP/{dpaId}', [ViewDPAController::class, 'submitRUP'])->name('submitRUP');
        Route::get('/view-dpa', [ViewDPAController::class, 'index'])->name('viewDPA');
Route::post('/submit-sumber-dana/{dpaId}', [ViewDPAController::class, 'submitSumberDana'])->name('submitSumberDana');
Route::get('/Track', [ViewDPAController::class, 'tracking'])->name('ViewDPA.track');
Route::get('/ViewDPA/{dpaId}/{userId}', [ViewDPAController::class, 'assignDpa'])->name('ViewDPA.assignDpa');

//Bendahara
Route::get('/form/create_spp/{id}', [BendaharaController::class, 'create_spp'])->name('bendahara.create_spp');
Route::get('/form/create_spm/{id}', [BendaharaController::class, 'create_spm'])->name('bendahara.create_spm');
Route::get('/form/create_sp2d/{id}', [BendaharaController::class, 'create_sp2d'])->name('bendahara.create_sp2d');
Route::get('/form/submit/{dpa_id}', [BendaharaController::class, 'submit'])->name('bendahara.submit');
Route::post('/form/store_spp', [BendaharaController::class, 'store_spp'])->name('bendahara.store_spp');
Route::post('/form/store_spm', [BendaharaController::class, 'store_spm'])->name('bendahara.store_spm');
Route::post('/form/store_sp2d', [BendaharaController::class, 'store_sp2d'])->name('bendahara.store_sp2d');


//ceklisform
Route::get('/ceklisform/{id}', [CeklisformController::class, 'index'])->name('ceklisform.index');
Route::post('/ceklisform', [CeklisformController::class, 'store'])->name('ceklisform.store');
Route::get('/ceklisform/result/{id}', [CeklisformController::class, 'showResult'])->name('ceklisform.result');
Route::get('/ceklisform/download-pdf/{id}', [CeklisformController::class, 'downloadPdf'])->name('ceklisform.downloadPdf');
Route::get('/ceklisform/{id}/edit', [CeklisformController::class, 'edit'])->name('ceklisform.edit');
Route::put('/ceklisform/{id}', [CeklisformController::class, 'update'])->name('ceklisform.update');
Route::get('/ceklisDPA/{ke}', [ViewDPAController::class, 'ViewDPA'])->name('ceklisDPA.dpa');


//Pejabat Pengadaan
Route::get('/form/create/{id}', [PengadaanController::class, 'create_pengadaan'])->name('pengadaan.create_pengadaan');
Route::post('/form/store', [PengadaanController::class, 'store_pengadaan'])->name('pengadaan.store_pengadaan');
Route::get('/pengadaan', [PengadaanController::class, 'index'])->name('pengadaan.index');
Route::get('/pengadaan', [PengadaanController::class, 'berkas'])->name('pengadaan.index');
Route::delete('/pengadaan/{id}', [PengadaanController::class, 'delete'])->name('pengadaan.delete');
Route::get('/pengadaan/{id}/edit', [PengadaanController::class, 'edit'])->name('pengadaan.edit');
Route::put('/pengadaan/{id}', [PengadaanController::class, 'update'])->name('pengadaan.update');
Route::get('/viewDPA/{ke}', [ViewDPAController::class, 'ViewDPA'])->name('ViewDPA.pengadaan');


// Users 
Route::middleware('auth')->prefix('users')->name('users.')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
    Route::put('/update/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/delete/{user}', [UserController::class, 'delete'])->name('destroy');
    Route::get('/update/status/{user_id}/{status}', [UserController::class, 'updateStatus'])->name('status');

    
    Route::get('/import-users', [UserController::class, 'importUsers'])->name('import');
    Route::post('/upload-users', [UserController::class, 'uploadUsers'])->name('upload');

    Route::get('export/', [UserController::class, 'export'])->name('export');
    //Route::post('/uploadDPA', [FileController::class, 'store'])->name('file.store');
    
});

