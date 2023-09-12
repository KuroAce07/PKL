@extends('layouts.app')

@section('title', 'Dokumen Kontrak')

@section('content')
<div class="container-fluid">
    <h1>Dokumen Kontrak</h1>

    <!-- Display the details of a single Dokumen Kontrak entry -->
    <div class="card">
        <div class="card-header">
            Dokumen Kontrak Details
        </div>
        <div class="card-body">
            <p><strong>Jenis Kontrak:</strong> {{ $dokumenKontrak->jenis_kontrak }}</p>
            <p><strong>Nama Kegiatan Transaksi:</strong> {{ $dokumenKontrak->nama_kegiatan_transaksi }}</p>
            <p><strong>Tanggal Kontrak:</strong> {{ $dokumenKontrak->tanggal_kontrak }}</p>
            <p><strong>Jumlah Uang:</strong> {{ $dokumenKontrak->jumlah_uang }}</p>
            <p><strong>PPN:</strong> {{ $dokumenKontrak->ppn }}</p>
            <p><strong>PPH:</strong> {{ $dokumenKontrak->pph }}</p>
            <p><strong>Potongan Lain:</strong> {{ $dokumenKontrak->potongan_lain }}</p>
            <p><strong>Jumlah Potongan:</strong> {{ $dokumenKontrak->jumlah_potongan }}</p>
            <p><strong>Jumlah Total:</strong> {{ $dokumenKontrak->jumlah_total }}</p>
            <p><strong>Keterangan:</strong> {{ $dokumenKontrak->keterangan }}</p>
        </div>
        <div class="card-footer">
            <!-- Add buttons for actions like Edit and Delete -->
            <a href="{{ route('PembantuPPTKView.dokumenkontrak.edit', ['id' => $dokumenKontrak->id]) }}" class="btn btn-primary">Edit</a>
            <!-- Add other actions/buttons as needed -->
        </div>
    </div>
</div>
@endsection
