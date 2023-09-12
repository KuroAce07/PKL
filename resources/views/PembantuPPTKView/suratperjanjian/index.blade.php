@extends('layouts.app')

@section('title', 'Surat Perjanjian - View')

@section('content')
<div class="container-fluid">
    <h1>Surat Perjanjian</h1>
    <div class="card">
        <div class="card-header">
        Surat Perjanjian Details
        </div>
        <div class="card-body">
            @if ($suratperjanjians)
                <div class="mb-3">
                    <p><strong>Nomor DPA:</strong> {{ $suratperjanjians->dpa->kode_sub_kegiatan }}</p>
                    <p><strong>Nama Kegiatan:</strong> {{ $suratperjanjians->dpa->nama_sub_kegiatan }}</p>
                    <p><strong>Nama Transaksi:</strong> {{ $suratperjanjians->nama }}</p>
                    <p><strong>Nilai Transaksi:</strong> Rp. {{ number_format((float) $suratperjanjians->nomor, 0, ',', '.') }}</p>
                    <p><strong>Tanggal:</strong> {{ $suratperjanjians->tanggal }}</p>
                    <p><strong>Keterangan:</strong> {{ $suratperjanjians->keterangan }}</p>
                    <p><strong>Dokumen:</strong> <a href="{{ url('uploads/' . $dpaId . '/' . basename($suratperjanjians->upload_dokumen)) }}" download>View Dokumen</a></p>
                    <p><strong>Status Persetujuan:</strong>
                        @if ($suratperjanjians->approval === 1)
                            <span class="text-success">Dokumen Disetujui</span>
                        @elseif ($suratperjanjians->approval === 2)
                            <span class="text-danger">Dokumen Ditolak</span>
                        @else
                            <span class="text-warning">Dokumen Belum Disetujui</span>
                        @endif
                    </p>
                    <p><strong>Alasan:</strong> {{ $suratperjanjians->alasan }}</p>
                </div>
            @else
                <p>No BAST available</p>
            @endif
        </div>
        <div class="card-footer">
            @if ($suratperjanjians)
                <a href="{{ route('PembantuPPTKView.suratperjanjian.edit', ['id' => $suratperjanjians->id]) }}" class="btn btn-primary">Edit</a>
            @endif
        </div>
    </div>
</div>
@endsection
