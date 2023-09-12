@extends('layouts.app')

@section('content')
    <h1>Assign Pengadaan</h1>

    @if ($pengadaan)
        <p>Dokumen Pemilihan sudah ada.</p>
        <a href="{{ route('pengadaan.assign', ['dpa_id' => $pengadaan->dpa_id]) }}" class="btn btn-primary edit-btn">Assign</a>
    @else
        <p>Dokumen Pemilihan belum ada.</p>
        <a href="{{ route('pengadaan.create_pengadaan', ['dpa_id' => $dpa_id]) }}" class="btn btn-primary edit-btn">Buat Dokumen Pemilihan</a>
    @endif
@endsection
