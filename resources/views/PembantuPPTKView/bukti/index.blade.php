@extends('layouts.app')

@section('title', 'Nota/Bukti Pembelian/Invoice - View')

@section('content')
<div class="container-fluid">
    <h1>View Nota/Bukti Pembelian/Invoice</h1>
    <div class="card">
        <div class="card-header">
        Nota/Bukti Pembelian/Invoice Details
        </div>
        <div class="card-body">
            @if ($buktis)
                <div class="mb-3">
                    <p><strong>Nomor DPA:</strong> {{ $buktis->dpa->kode_sub_kegiatan }}</p>
                    <p><strong>Nama Kegiatan:</strong> {{ $buktis->dpa->nama_sub_kegiatan }}</p>
                    <p><strong>Nama Transaksi:</strong> {{ $buktis->nama }}</p>
                    <p><strong>Nilai Transaksi:</strong> Rp. {{ number_format((float) $buktis->nomor, 0, ',', '.') }}</p>
                    <p><strong>Tanggal:</strong> {{ $buktis->tanggal }}</p>
                    <p><strong>Keterangan:</strong> {{ $buktis->keterangan }}</p>
                    <p><strong>Dokumen:</strong> <a href="{{ url('uploads/' . $dpaId . '/' . basename($buktis->upload_dokumen)) }}" download>View Dokumen</a></p>
                    <p><strong>Status Persetujuan:</strong>
                        @if ($buktis->approval === 1)
                            <span class="text-success">Dokumen Disetujui</span>
                        @elseif ($buktis->approval === 2)
                            <span class="text-danger">Dokumen Ditolak</span>
                        @else
                            <span class="text-warning">Dokumen Belum Disetujui</span>
                        @endif
                    </p>
                    <p><strong>Alasan:</strong> {{ $buktis->alasan }}</p>
                </div>
            @else
                <p>No BAST available</p>
            @endif
        </div>
        <div class="card-footer">
            @if ($buktis)
                <a href="{{ route('PembantuPPTKView.bukti.edit', ['id' => $buktis->id]) }}" class="btn btn-primary">Edit</a>
            @endif
        </div>
    </div>
</div>
@endsection
