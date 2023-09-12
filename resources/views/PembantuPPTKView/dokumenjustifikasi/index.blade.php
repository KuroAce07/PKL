@extends('layouts.app')

@section('title', 'View Dokumen Justifikasi')

@section('content')
<div class="container-fluid">
    <h1>View Dokumen Justifikasi</h1>

    @if ($dokumenJustifikasi->count() > 0)
        @foreach ($dokumenJustifikasi as $dokumen)
            <div class="card mb-3">
                <div class="card-header">
                    Dokumen Justifikasi Details
                </div>
                <div class="card-body">
                    <p><strong>Nomor DPA:</strong> {{ $dokumen->dpa->kode_sub_kegiatan }}</p>
                    <p><strong>Nama Kegiatan:</strong> {{ $dokumen->dpa->nama_sub_kegiatan }}</p>
                    <p><strong>Nama:</strong> {{ $dokumen->nama }}</p>
                    <p><strong>Tanggal:</strong> {{ $dokumen->tanggal }}</p>
                    <p><strong>Keterangan:</strong> {{ $dokumen->keterangan }}</p>
                    <p><strong>Dokumen:</strong> <a href="{{ url('uploads/' . $dpaId . '/' . basename($dokumen->upload_dokumen)) }}" download>View Dokumen</a></p>
                    <p><strong>Status Persetujuan:</strong>
                        @if ($dokumen->approval === 1)
                            <span class="text-success">Dokumen Disetujui</span>
                        @elseif ($dokumen->approval === 2)
                            <span class="text-danger">Dokumen Ditolak</span>
                        @else
                            <span class="text-warning">Dokumen Belum Disetujui</span>
                        @endif
                    </p>
                    <p><strong>Alasan:</strong> {{ $dokumen->alasan }}</p>
                </div>
                <div class="card-footer">
                    <!-- Add link to edit page for each $dokumen -->
                    <a href="{{ route('PembantuPPTKView.dokumenjustifikasi.edit', ['id' => $dokumen->id]) }}" class="btn btn-primary">Edit</a>
                </div>
            </div>
        @endforeach
    @else
        <p>No Dokumen Justifikasi available</p>
    @endif
</div>
@endsection
