@extends('layouts.app')

@section('title', 'View Dokumen Pendukung')

@section('content')
<div class="container-fluid">
    <h1>View Dokumen Pendukung</h1>

    <div class="card">
        <div class="card-header">
            Dokumen Pendukung Details
        </div>
        <div class="card-body">
            @if ($dokumenPendukung->count() > 0)
                <div class="mb-3">
                    <p><strong>Nama:</strong> {{ $dokumenPendukung->first()->nama }}</p>
                    <p><strong>Tanggal:</strong> {{ $dokumenPendukung->first()->tanggal }}</p>
                    <p><strong>Keterangan:</strong> {{ $dokumenPendukung->first()->keterangan }}</p>
                    <p>
                        <strong>Dokumen:</strong>
                        <a href="{{ asset('storage/' . $dokumenPendukung->first()->upload_dokumen) }}" target="_blank">View Dokumen</a>
                    </p>
                </div>
            @else
                <p>No Dokumen Pendukung available</p>
            @endif
        </div>
        <div class="card-footer">
            @if ($dokumenPendukung->count() > 0)
                <a href="{{ route('PembantuPPTKView.dokumenpendukung.edit', ['id' => $dokumenPendukung->first()->id]) }}" class="btn btn-primary">Edit</a>
            @endif
        </div>
    </div>
</div>
@endsection
