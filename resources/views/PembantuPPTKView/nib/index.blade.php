@extends('layouts.app')

@section('title', 'NIB - View')

@section('content')
<div class="container-fluid">
    <h1>NIB</h1>
    <div class="card">
        <div class="card-header">
        NIB Details
        </div>
        <div class="card-body">
            @if ($nibs)
                <div class="mb-3">
                    <p><strong>Nomor DPA:</strong> {{ $nibs->dpa->kode_sub_kegiatan }}</p>
                    <p><strong>Nama Kegiatan:</strong> {{ $nibs->dpa->nama_sub_kegiatan }}</p>
                    <p><strong>Nama Transaksi:</strong> {{ $nibs->nama }}</p>
                    <p><strong>Nilai Transaksi:</strong> Rp. {{ number_format((float) $nibs->nomor, 0, ',', '.') }}</p>
                    <p><strong>Tanggal:</strong> {{ $nibs->tanggal }}</p>
                    <p><strong>Keterangan:</strong> {{ $nibs->keterangan }}</p>
                    <p><strong>Dokumen:</strong> <a href="{{ url('uploads/' . $dpaId . '/' . basename($nibs->upload_dokumen)) }}" download>View Dokumen</a></p>
                    <p><strong>Status Persetujuan:</strong>
                        @if ($nibs->approval === 1)
                            <span class="text-success">Dokumen Disetujui</span>
                        @elseif ($nibs->approval === 2)
                            <span class="text-danger">Dokumen Ditolak</span>
                        @else
                            <span class="text-warning">Dokumen Belum Disetujui</span>
                        @endif
                    </p>
                    <p><strong>Alasan:</strong> {{ $nibs->alasan }}</p>
                </div>
            @else
                <p>No NIB available</p>
            @endif
        </div>
        <div class="card-footer">
            @if ($nibs)
                <a href="{{ route('PembantuPPTKView.nib.edit', ['id' => $nibs->id]) }}" class="btn btn-primary">Edit</a>
            @endif
        </div>
    </div>
</div>
@endsection
