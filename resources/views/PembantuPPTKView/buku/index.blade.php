@extends('layouts.app')

@section('title', 'Buku Rekening Bank - View')

@section('content')
<div class="container-fluid">
    <h1>Buku Rekening Bank</h1>
    <div class="card">
        <div class="card-header">
        Buku Rekening Bank Details
        </div>
        <div class="card-body">
            @if ($bukus)
                <div class="mb-3">
                    <p><strong>Nomor DPA:</strong> {{ $bukus->dpa->kode_sub_kegiatan }}</p>
                    <p><strong>Nama Kegiatan:</strong> {{ $bukus->dpa->nama_sub_kegiatan }}</p>
                    <p><strong>Nama Transaksi:</strong> {{ $bukus->nama }}</p>
                    <p><strong>Nilai Transaksi:</strong> Rp. {{ number_format((float) $bukus->nomor, 0, ',', '.') }}</p>
                    <p><strong>Tanggal:</strong> {{ $bukus->tanggal }}</p>
                    <p><strong>Keterangan:</strong> {{ $bukus->keterangan }}</p>
                    <p><strong>Dokumen:</strong> <a href="{{ url('uploads/' . $dpaId . '/' . basename($bukus->upload_dokumen)) }}" download>View Dokumen</a></p>
                    <p><strong>Status Persetujuan:</strong>
                        @if ($bukus->approval === 1)
                            <span class="text-success">Dokumen Disetujui</span>
                        @elseif ($bukus->approval === 2)
                            <span class="text-danger">Dokumen Ditolak</span>
                        @else
                            <span class="text-warning">Dokumen Belum Disetujui</span>
                        @endif
                    </p>
                    <p><strong>Alasan:</strong> {{ $bukus->alasan }}</p>
                </div>
            @else
                <p>No NPWP available</p>
            @endif
        </div>
        <div class="card-footer">
            @if ($bukus)
                <a href="{{ route('PembantuPPTKView.buku.edit', ['id' => $bukus->id]) }}" class="btn btn-primary">Edit</a>
            @endif
        </div>
    </div>
</div>
@endsection
