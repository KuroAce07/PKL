@extends('layouts.app')

@section('title', 'Berita Acara Pembayaran (BAP) - List')

@section('content')
<div class="container-fluid">
    <h1>List of Berita Acara Pembayaran (BAP)</h1>
    @if ($baps->count() > 0)
        <div class="card">
            <div class="card-header">
                BAP Details
            </div>
            <div class="card-body">
                <div>
                    <p><strong>Nomor:</strong> {{ $baps->first()->nomor }}</p>
                    <p><strong>Tanggal:</strong> {{ $baps->first()->tanggal }}</p>
                    <p><strong>Keterangan:</strong> {{ $baps->first()->keterangan }}</p>
                    <p><strong>Dokumen:</strong> <a href="{{ asset('storage/' . $baps->first()->upload_dokumen) }}" target="_blank">View Dokumen</a></p>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('PembantuPPTKView.bap.edit', ['id' => $baps->first()->id]) }}" class="btn btn-primary">Edit</a>
            </div>
        </div>
    @else
        <p>No BAP available</p>
    @endif
</div>
@endsection
