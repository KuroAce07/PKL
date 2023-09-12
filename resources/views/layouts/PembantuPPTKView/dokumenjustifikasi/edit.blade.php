@extends('layouts.app')

@section('title', 'Edit Dokumen Justifikasi')

@section('content')
<div class="container-fluid">
    <h1>Edit Dokumen Justifikasi</h1>

    <div class="card">
        <div class="card-header">
            Edit Dokumen Justifikasi
        </div>
        <div class="card-body">
            <form action="{{ route('PembantuPPTKView.dokumenjustifikasi.update', ['id' => $dokumenJustifikasi->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" name="nama" class="form-control" value="{{ $dokumenJustifikasi->nama }}" required>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal:</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ $dokumenJustifikasi->tanggal }}" required>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan:</label>
                    <textarea name="keterangan" class="form-control">{{ $dokumenJustifikasi->keterangan }}</textarea>
                </div>
                <div class="form-group">
                    <label for="upload_dokumen">Upload Dokumen:</label>
                    <input type="file" name="upload_dokumen" class="form-control-file">
                </div>
                <button type="submit" class="btn btn-primary mt-3">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
