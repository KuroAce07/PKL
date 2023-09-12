@extends('layouts.app')

@section('title', 'Pilihan Rekanan - List')

@section('content')
<div class="container-fluid">
    <h1>List of Pilihan Rekanan</h1>
    @if ($pilihanRekanan->count() > 0)
        <div class="card">
            <div class="card-header">
                Pilihan Rekanan Details
            </div>
            <div class="card-body">
                <p><strong>Pilih:</strong> {{ $pilihanRekanan->first()->pilih }}</p>
                <p><strong>Detail:</strong> {{ $pilihanRekanan->first()->detail }}</p>
                <p><strong>Jenis Pengadaan:</strong> {{ $pilihanRekanan->first()->jenis_pengadaan }}</p>
                <p><strong>Keterangan:</strong> {{ $pilihanRekanan->first()->keterangan }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('PembantuPPTKView.pilihrekanan.edit', ['id' => $pilihanRekanan->first()->id]) }}" class="btn btn-primary">Edit</a>
            </div>
        </div>
    @else
        <p>No Pilihan Rekanan available</p>
    @endif
</div>
@endsection
