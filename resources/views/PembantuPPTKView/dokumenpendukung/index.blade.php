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
            @if ($dokumenPendukung)
                <div class="mb-3">
                    <p><strong>Nomor DPA:</strong> {{ $dokumenPendukung->dpa->kode_sub_kegiatan }}</p>
                    <p><strong>Nama Kegiatan:</strong> {{ $dokumenPendukung->dpa->nama_sub_kegiatan }}</p>
                    <p><strong>Nama:</strong> {{ $dokumenPendukung->nama }}</p>
                    <p><strong>Tanggal:</strong> {{ $dokumenPendukung->tanggal }}</p>
                    <p><strong>Keterangan:</strong> {{ $dokumenPendukung->keterangan }}</p>
                    <p><strong>Dokumen:</strong> <a href="{{ url('uploads/' . $dpaId . '/' . basename($dokumenPendukung->upload_dokumen)) }}" download>View Dokumen</a></p>

                    <p><strong>Status Persetujuan:</strong>
                        @if ($dokumenPendukung->approval === 1)
                            <span class="text-success">Dokumen Disetujui</span>
                        @elseif ($dokumenPendukung->approval === 2)
                            <span class="text-danger">Dokumen Ditolak</span>
                        @else
                            <span class="text-warning">Dokumen Belum Disetujui</span>
                        @endif
                    </p>
                    <p><strong>Alasan:</strong> {{ $dokumenPendukung->alasan }}</p>
                </div>
            @else
                <p>No Dokumen Pendukung available</p>
            @endif
        </div>
        <div class="card-footer">
            @if ($dokumenPendukung)
                <a href="{{ route('PembantuPPTKView.dokumenpendukung.edit', ['id' => $dokumenPendukung->id]) }}" class="btn btn-primary">Edit</a>
            @endif
        </div>
    </div>
</div>
@endsection
