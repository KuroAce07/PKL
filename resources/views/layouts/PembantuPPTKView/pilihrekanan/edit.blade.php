@extends('layouts.app')

@section('title', 'Pilihan Rekanan - Edit')

@section('content')
<div class="container-fluid">
    <h1>Edit Pilihan Rekanan</h1>
    <form action="{{ route('PembantuPPTKView.pilihrekanan.update', ['id' => $pilihanRekanan->id]) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="dpa_id">Choose DPA:</label>
            <select name="dpa_id" class="form-control" required>
                @foreach ($dpas as $dpa)
                    <option value="{{ $dpa->id }}" {{ $pilihanRekanan->dpa_id == $dpa->id ? 'selected' : '' }}>{{ $dpa->kode_sub_kegiatan }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="pilih">Pilih:</label>
            <select name="pilih" class="form-control" required>
                @foreach ($rekanans as $rekanan)
                    <option value="{{ $rekanan->nama_rekanan }}" {{ $pilihanRekanan->pilih == $rekanan->nama_rekanan ? 'selected' : '' }}>{{ $rekanan->nama_rekanan }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="jenis_pengadaan">Jenis Pengadaan:</label>
            <select name="jenis_pengadaan" class="form-control" required>
                <option value="NPWP" {{ $pilihanRekanan->jenis_pengadaan == 'NPWP' ? 'selected' : '' }}>NPWP</option>
                <option value="Buku Rekening Bank" {{ $pilihanRekanan->jenis_pengadaan == 'Buku Rekening Bank' ? 'selected' : '' }}>Buku Rekening Bank</option>
                <option value="NIB" {{ $pilihanRekanan->jenis_pengadaan == 'NIB' ? 'selected' : '' }}>NIB</option>
            </select>
        </div>
        <div class="form-group">
            <label for="detail">Detail:</label>
            <textarea name="detail" class="form-control">{{ $pilihanRekanan->detail }}</textarea>
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan:</label>
            <textarea name="keterangan" class="form-control">{{ $pilihanRekanan->keterangan }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
