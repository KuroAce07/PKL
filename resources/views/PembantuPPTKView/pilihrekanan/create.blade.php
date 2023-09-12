@extends('layouts.app')

@section('title', 'Pilihan Rekanan - Create')

@section('content')
<div class="container-fluid">
    <h1>Create Pilihan Rekanan</h1>
    
    <!-- Display session success message if available -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <form action="{{ route('PembantuPPTKView.pilihrekanan.store') }}" method="post">
        @csrf
        <div class="form-group">
<div class="form-group">
    <label for="dpa_id">DPA:</label>
    <select name="dpa_id" id="dpa_id" class="form-control" required readonly>
        @foreach($dpas as $dpa)
            <option value="{{ $dpa->id }}" {{ request()->query('dpaId') == $dpa->id ? 'selected' : '' }}>
                {{ $dpa->kode_sub_kegiatan }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="jenis_kontrak">Nama Kegiatan/Sub Kegiatan:</label>
    <select name="dpa_id" id="dpa_id" class="form-control" required readonly>
        @foreach($dpas as $dpa)
            <option value="{{ $dpa->id }}" {{ request()->query('dpaId') == $dpa->id ? 'selected' : '' }}>
                {{ $dpa->nama_sub_kegiatan }}
            </option>
        @endforeach
    </select>
</div>
        <div class="form-group">
            <label for="pilih">Pilih:</label>
            <select name="pilih" class="form-control" required>
                @foreach ($rekanans as $rekanan)
                    <option value="{{ $rekanan->nama_rekanan }}">{{ $rekanan->nama_rekanan }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="jenis_pengadaan">Jenis Pengadaan:</label>
            <select name="jenis_pengadaan" class="form-control" required>
                <option value="NPWP">NPWP</option>
                <option value="Buku Rekening Bank">Buku Rekening Bank</option>
                <option value="NIB">NIB</option>
            </select>
        </div>
        <div class="form-group">
            <label for="detail">Detail:</label>
            <textarea name="detail" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan:</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </div>
    </form>
</div>
@endsection
