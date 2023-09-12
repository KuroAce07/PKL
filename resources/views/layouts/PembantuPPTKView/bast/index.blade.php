@extends('layouts.app')

@section('title', 'Berita Acara Serah Terima Hasil Pekerjaan (BAST) - View')

@section('content')
<div class="container-fluid">
    <h1>View Berita Acara Serah Terima Hasil Pekerjaan (BAST)</h1>

    <div class="card">
        <div class="card-header">
            BAST Details
        </div>
        <div class="card-body">
            @if ($bast)
                <div>
                    <p><strong>Nomor:</strong> {{ $bast->nomor }}</p>
                    <p><strong>Tanggal:</strong> {{ $bast->tanggal }}</p>
                    <p><strong>Keterangan:</strong> {{ $bast->keterangan }}</p>
                    <p><strong>Dokumen:</strong> <a href="{{ asset('storage/' . $bast->upload_dokumen) }}" target="_blank">View Dokumen</a></p>
                </div>
            @else
                <p>No BAST available</p>
            @endif
        </div>
        <div class="card-footer">
            @if ($bast)
                <a href="{{ route('PembantuPPTKView.bast.edit', ['id' => $bast->id]) }}" class="btn btn-primary">Edit</a>
            @endif
        </div>
    </div>
</div>
@endsection
