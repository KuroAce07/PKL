@extends('layouts.app')

@section('title', 'Edit Dokumen Pendukung')

@section('content')
<div class="container-fluid">
    <h1>Edit Dokumen Pendukung</h1>
    <form action="{{ route('PembantuPPTKView.dokumenpendukung.update', ['id' => $dokumenPendukung->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="dpa_id">DPA:</label>
            <select name="dpa_id" id="dpa_id" class="form-control" required>
                @foreach ($dpas as $dpa)
                    <option value="{{ $dpa->id }}" {{ $dpa->id == $dokumenPendukung->dpa_id ? 'selected' : '' }}>{{ $dpa->kode_sub_kegiatan }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" class="form-control" value="{{ $dokumenPendukung->nama }}" required>
        </div>
        <div class="form-group">
            <label for="tanggal">Tanggal:</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $dokumenPendukung->tanggal }}" required>
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan:</label>
            <textarea name="keterangan" class="form-control">{{ $dokumenPendukung->keterangan }}</textarea>
        </div>
        <div class="form-group">
            <label for="upload_dokumen">Upload Dokumen:</label>
            <input type="file" name="upload_dokumen" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
