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
                <div class="mb-3">
                    <p><strong>Nomor DPA:</strong> {{ $bast->dpa->kode_sub_kegiatan }}</p>
                    <p><strong>Nama Kegiatan:</strong> {{ $bast->dpa->nama_sub_kegiatan }}</p>
                    <p><strong>Nomor:</strong> {{ $bast->nomor }}</p>
                    <p><strong>Tanggal:</strong> {{ $bast->tanggal }}</p>
                    <p><strong>Keterangan:</strong> {{ $bast->keterangan }}</p>
                    <p><strong>Dokumen:</strong> <a href="{{ url('uploads/' . $dpaId . '/' . basename($bast->upload_dokumen)) }}" download>View Dokumen</a></p>
                    <p><strong>Status Persetujuan:</strong>
                        @if ($bast->approval === 1)
                            <span class="text-success">Dokumen Disetujui</span>
                        @elseif ($bast->approval === 2)
                            <span class="text-danger">Dokumen Ditolak</span>
                        @else
                            <span class="text-warning">Dokumen Belum Disetujui</span>
                        @endif
                    </p>
                    <p><strong>Alasan:</strong> {{ $bast->alasan }}</p>
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
