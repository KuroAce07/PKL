@extends('layouts.app')

@section('title', 'Pilihan Rekanan - List')

@section('content')
<div class="container-fluid">
    <h1>List of Pilihan Rekanan</h1>
        <div class="card">
            <div class="card-header">
                Pilihan Rekanan Details
            </div>
            <div class="card-body">
            @if ($pilihanRekanan)
                <div class="mb-3">
                <p><strong>Nomor DPA:</strong> {{ $pilihanRekanan->dpa->kode_sub_kegiatan }}</p>
                <p><strong>Nama Kegiatan:</strong> {{ $pilihanRekanan->dpa->nama_sub_kegiatan }}</p>
                <p><strong>Pilih:</strong> {{ $pilihanRekanan->first()->pilih }}</p>
                <p><strong>Detail:</strong> {{ $pilihanRekanan->first()->detail }}</p>
                <p><strong>Jenis Pengadaan:</strong> {{ $pilihanRekanan->first()->jenis_pengadaan }}</p>
                <p><strong>Keterangan:</strong> {{ $pilihanRekanan->first()->keterangan }}</p>
                <p><strong>Status Persetujuan:</strong>
                        @if ($pilihanRekanan->approval === 1)
                            <span class="text-success">Dokumen Disetujui</span>
                        @elseif ($pilihanRekanan->approval === 2)
                            <span class="text-danger">Dokumen Ditolak</span>
                        @else
                            <span class="text-warning">Dokumen Belum Disetujui</span>
                        @endif
                </p>
                <p><strong>Alasan:</strong> {{ $pilihanRekanan->alasan }}</p>
            </div>
            @else
                <p>No Pilihan Rekanan available</p>
            @endif
            </div>
            <div class="card-footer">
            @if ($pilihanRekanan)
                <a href="{{ route('PembantuPPTKView.pilihrekanan.edit', ['id' => $pilihanRekanan->id]) }}" class="btn btn-primary">Edit</a>
            @endif
            </div>
        </div>
    </div>
@endsection
