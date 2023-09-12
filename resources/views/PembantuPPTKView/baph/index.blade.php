@extends('layouts.app')

@section('title', 'Berita Acara Pembayaran (BAPH) - List')

@section('content')
<div class="container-fluid">
    <h1>View Berita Acara Pembayaran (BAPH)</h1>
    <div class="card">
        <div class="card-header">
            BAPH Details
        </div>
        <div class="card-body">
            @if ($baphs)
                <div class="mb-3">
                    <p><strong>Nomor DPA:</strong> {{ $baphs->dpa->kode_sub_kegiatan }}</p>
                    <p><strong>Nama Kegiatan:</strong> {{ $baphs->dpa->nama_sub_kegiatan }}</p>
                    <p><strong>Nomor:</strong> {{ $baphs->nomor }}</p>
                    <p><strong>Tanggal:</strong> {{ $baphs->tanggal }}</p>
                    <p><strong>Keterangan:</strong> {{ $baphs->keterangan }}</p>
                    <p><strong>Dokumen:</strong> <a href="{{ url('uploads/' . $dpaId . '/' . basename($baphs->upload_dokumen)) }}" download>View Dokumen</a></p>
                    <p><strong>Status Persetujuan:</strong>
                        @if ($baphs->approval === 1)
                            <span class="text-success">Dokumen Disetujui</span>
                        @elseif ($baphs->approval === 2)
                            <span class="text-danger">Dokumen Ditolak</span>
                        @else
                            <span class="text-warning">Dokumen Belum Disetujui</span>
                        @endif
                    </p>
                    <p><strong>Alasan:</strong> {{ $baphs->alasan }}</p>
                </div>
            @else
                <p>No BAPH available</p>
            @endif
        </div>
        <div class="card-footer">
            @if ($baphs)
                <a href="{{ route('PembantuPPTKView.baph.edit', ['id' => $baphs->id]) }}" class="btn btn-primary">Edit</a>
            @endif
        </div>
    </div>
</div>
@endsection
