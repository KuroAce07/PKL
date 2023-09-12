@extends('layouts.app')

@section('title', 'NPWP - View')

@section('content')
<div class="container-fluid">
    <h1>NPWP</h1>
    <div class="card">
        <div class="card-header">
        NPWP Details
        </div>
        <div class="card-body">
            @if ($npwps)
                <div class="mb-3">
                    <p><strong>Nomor DPA:</strong> {{ $npwps->dpa->kode_sub_kegiatan }}</p>
                    <p><strong>Nama Kegiatan:</strong> {{ $npwps->dpa->nama_sub_kegiatan }}</p>
                    <p><strong>Nama Transaksi:</strong> {{ $npwps->nama }}</p>
                    <p><strong>Nilai Transaksi:</strong> Rp. {{ number_format((float) $npwps->nomor, 0, ',', '.') }}</p>
                    <p><strong>Tanggal:</strong> {{ $npwps->tanggal }}</p>
                    <p><strong>Keterangan:</strong> {{ $npwps->keterangan }}</p>
                    <p><strong>Dokumen:</strong> <a href="{{ url('uploads/' . $dpaId . '/' . basename($npwps->upload_dokumen)) }}" download>View Dokumen</a></p>
                    <p><strong>Status Persetujuan:</strong>
                        @if ($npwps->approval === 1)
                            <span class="text-success">Dokumen Disetujui</span>
                        @elseif ($npwps->approval === 2)
                            <span class="text-danger">Dokumen Ditolak</span>
                        @else
                            <span class="text-warning">Dokumen Belum Disetujui</span>
                        @endif
                    </p>
                    <p><strong>Alasan:</strong> {{ $npwps->alasan }}</p>
                </div>
            @else
                <p>No NPWP available</p>
            @endif
        </div>
        <div class="card-footer">
            @if ($npwps)
                <a href="{{ route('PembantuPPTKView.npwp.edit', ['id' => $npwps->id]) }}" class="btn btn-primary">Edit</a>
            @endif
        </div>
    </div>
</div>
@endsection
