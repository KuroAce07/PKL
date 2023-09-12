@extends('layouts.app')

@section('title', 'Berita Acara Pembayaran (BAPH) - List')

@section('content')
<div class="container-fluid">
    <h1>List of Berita Acara Pembayaran (BAPH)</h1>
    @if ($baphs->count() > 0)
        <div class="card">
            <div class="card-header">
                BAPH Details
            </div>
            <div class="card-body">
                <div>
                    <p><strong>Nomor:</strong> {{ $baphs->first()->nomor }}</p>
                    <p><strong>Tanggal:</strong> {{ $baphs->first()->tanggal }}</p>
                    <p><strong>Keterangan:</strong> {{ $baphs->first()->keterangan }}</p>
                    <p><strong>Dokumen:</strong> <a href="{{ asset('storage/' . $baphs->first()->upload_dokumen) }}" target="_blank">View Dokumen</a></p>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('PembantuPPTKView.baph.edit', ['id' => $baphs->first()->id]) }}" class="btn btn-primary">Edit</a>
            </div>
        </div>
    @else
        <p>No BAPH available</p>
    @endif
</div>
@endsection
