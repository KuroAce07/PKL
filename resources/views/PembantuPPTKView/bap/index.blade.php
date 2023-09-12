@extends('layouts.app')

@section('title', 'View Berita Acara Pembayaran (BAP)')

@section('content')
<div class="container-fluid">
    <h1>View Berita Acara Pembayaran (BAP)</h1>
    <div class="card">
        <div class="card-header">
            BAP Details
        </div>
        <div class="card-body">
            @if ($baps)
                <div class="mb-3">
                    <p><strong>Nomor DPA:</strong> {{ $baps->dpa->kode_sub_kegiatan }}</p>
                    <p><strong>Nama Kegiatan:</strong> {{ $baps->dpa->nama_sub_kegiatan }}</p>
                    <p><strong>Nomor:</strong> {{ $baps->nomor }}</p>
                    <p><strong>Tanggal:</strong> {{ $baps->tanggal }}</p>
                    <p><strong>Keterangan:</strong> {{ $baps->keterangan }}</p>
                    <p><strong>Dokumen:</strong> <a href="{{ url('uploads/' . $dpaId . '/' . basename($baps->upload_dokumen)) }}" download>View Dokumen</a></p>
                    <p><strong>Status Persetujuan:</strong>
                        @if ($baps->approval === 1)
                            <span class="text-success">Dokumen Disetujui</span>
                        @elseif ($baps->approval === 2)
                            <span class="text-danger">Dokumen Ditolak</span>
                        @else
                            <span class="text-warning">Dokumen Belum Disetujui</span>
                        @endif
                    </p>
                    <p><strong>Alasan:</strong> {{ $baps->alasan }}</p>
                </div>
            @else
                <p>No BAP available</p>
            @endif
        </div>
        <div class="card-footer">
            @if ($baps)
                <a href="{{ route('PembantuPPTKView.bap.edit', ['id' => $baps->id]) }}" class="btn btn-primary">Edit</a>
            @endif
        </div>
    </div>
</div>
@endsection
