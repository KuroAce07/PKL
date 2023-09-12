@extends('layouts.app')

@section('title', 'Risalah Kontrak - View')

@section('content')
<div class="container-fluid">
    <h1>Risalah Kontrak</h1>
    <div class="card">
        <div class="card-header">
        Risalah Kontrak Details
        </div>
        <div class="card-body">
            @if ($risalahkontraks)
                <div class="mb-3">
                    <!-- Displaying Information -->
                    <p><strong>Kode Program/Kegiatan:</strong> {{ $risalahkontraks->kode_program_kegiatan }}</p>
                    <p><strong>Nama Program:</strong> {{ $risalahkontraks->nama_program }}</p>
                    <p><strong>Nama Kegiatan:</strong> {{ $risalahkontraks->nama_kegiatan }}</p>
                    <p><strong>Nama atau Judul dari Paket Pengadaan / Pekerjaan:</strong> {{ $risalahkontraks->nama_paket_pekerjaan }}</p>
                    <p><strong>Lokasi Pekerjaan:</strong> {{ $risalahkontraks->lokasi_pekerjaan }}</p>
                    <p><strong>Sumber Dana:</strong> {{ $risalahkontraks->sumber_dana }}</p>
                    <p><strong>Nama Pelaksana Pekerjaan:</strong> {{ $risalahkontraks->nama_pelaksana_pekerjaan }}</p>
                    <p><strong>Jenis Usaha:</strong> {{ $risalahkontraks->jenis_usaha }}</p>
                    <p><strong>Alamat Pelaksana Pekerjaan:</strong> {{ $risalahkontraks->alamat_pelaksana_pekerjaan }}</p>
                    <p><strong>Nama Pimpinan/Direktur:</strong> {{ $risalahkontraks->nama_pimpinan_direktur }}</p>
                    <p><strong>NPWP:</strong> {{ $risalahkontraks->npwp }}</p>
                    <p><strong>Nomor Kontrak:</strong> {{ $risalahkontraks->nomor_kontrak }}</p>
                    <p><strong>Tanggal Kontrak:</strong> {{ $risalahkontraks->tanggal_kontrak }}</p>
                    <p><strong>Nilai Kontrak:</strong> Rp. {{ number_format((float) $risalahkontraks->nilai_kontrak, 0, ',', '.') }}</p>
                    <p><strong>Nomor Rekening BANK:</strong> {{ $risalahkontraks->nomor_rekening_bank }}</p>
                    <p><strong>Nama Rekening:</strong> {{ $risalahkontraks->nama_rekening }}</p>
                    <p><strong>Metode Pengadaan:</strong> {{ $risalahkontraks->metode_pengadaan }}</p>
                    <p><strong>Adendum Kontrak:</strong> {{ $risalahkontraks->adendum_kontrak }}</p>
                    <p><strong>Keterangan:</strong> {{ $risalahkontraks->keterangan }}</p>

                    @if ($risalahkontraks->upload_dokumen)
                        <p><strong>Dokumen:</strong> <a href="{{ url('uploads/' . $risalahkontraks->dpa_id . '/' . basename($risalahkontraks->upload_dokumen)) }}" download>View Dokumen</a></p>
                    @else
                        <p><strong>Dokumen:</strong> No Dokumen Uploaded</p>
                    @endif

                    <p><strong>Status Persetujuan:</strong>
                        @if ($risalahkontraks->approval === 1)
                            <span class="text-success">Dokumen Disetujui</span>
                        @elseif ($risalahkontraks->approval === 2)
                            <span class="text-danger">Dokumen Ditolak</span>
                        @else
                            <span class="text-warning">Dokumen Belum Disetujui</span>
                        @endif
                    </p>

                    <p><strong>Alasan:</strong> {{ $risalahkontraks->alasan }}</p>
                </div>
            @else
                <p>No Risalah Kontrak available</p>
            @endif
        </div>
        <div class="card-footer">
            @if ($risalahkontraks)
                <a href="{{ route('PembantuPPTKView.risalahkontrak.edit', ['id' => $risalahkontraks->id]) }}" class="btn btn-primary">Edit</a>
            @endif
        </div>
    </div>
</div>
@endsection
