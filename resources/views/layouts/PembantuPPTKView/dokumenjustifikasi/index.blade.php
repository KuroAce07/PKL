@extends('layouts.app')

@section('title', 'View Dokumen Justifikasi')

@section('content')
<div class="container-fluid">
    <h1>View Dokumen Justifikasi</h1>

    <div class="card">
        <div class="card-header">
            Dokumen Justifikasi Details
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nama:</strong> {{ $dokumenJustifikasi->first()->nama }}</p>
                    <p><strong>Tanggal:</strong> {{ $dokumenJustifikasi->first()->tanggal }}</p>
                    <p><strong>Keterangan:</strong> {{ $dokumenJustifikasi->first()->keterangan }}</p>
                    <p><strong>Dokumen:</strong> <a href="{{ asset('storage/' . $dokumenJustifikasi->first()->upload_dokumen) }}" target="_blank">View Dokumen</a></p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('PembantuPPTKView.dokumenjustifikasi.edit', ['id' => $dokumenJustifikasi->first()->id]) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
</div>
@endsection
