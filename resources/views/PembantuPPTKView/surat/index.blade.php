@extends('layouts.app')

@section('title', 'Surat Pemesanan - View')

@section('content')
<div class="container-fluid">
    <h1>Surat Pemesanan</h1>
    <div class="card">
        <div class="card-header">
        Surat Pemesanan Details
        </div>
        <div class="card-body">
            @if ($surats)
                <div class="mb-3">
                    <p><strong>Nomor DPA:</strong> {{ $surats->dpa->kode_sub_kegiatan }}</p>
                    <p><strong>Nama Kegiatan:</strong> {{ $surats->dpa->nama_sub_kegiatan }}</p>
                    <p><strong>Nama Transaksi:</strong> {{ $surats->nama }}</p>
                    <p><strong>Nilai Transaksi:</strong> Rp. {{ number_format((float) $surats->nomor, 0, ',', '.') }}</p>
                    <p><strong>Tanggal:</strong> {{ $surats->tanggal }}</p>
                    <p><strong>Keterangan:</strong> {{ $surats->keterangan }}</p>
                    <p><strong>Dokumen:</strong> <a href="{{ url('uploads/' . $dpaId . '/' . basename($surats->upload_dokumen)) }}" download>View Dokumen</a></p>
                    <p><strong>Status Persetujuan:</strong>
                        @if ($surats->approval === 1)
                            <span class="text-success">Dokumen Disetujui</span>
                        @elseif ($surats->approval === 2)
                            <span class="text-danger">Dokumen Ditolak</span>
                        @else
                            <span class="text-warning">Dokumen Belum Disetujui</span>
                        @endif
                    </p>
                    <p><strong>Alasan:</strong> {{ $surats->alasan }}</p>
                </div>
            @else
                <p>No BAST available</p>
            @endif
        </div>
        <div class="card-footer">
            @if ($surats)
                <a href="{{ route('PembantuPPTKView.surat.edit', ['id' => $surats->id]) }}" class="btn btn-primary">Edit</a>
            @endif
        </div>
    </div>
</div>
@endsection
