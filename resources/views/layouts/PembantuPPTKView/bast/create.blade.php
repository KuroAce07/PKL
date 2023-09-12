@extends('layouts.app')

@section('title', 'Berita Acara Serah Terima Hasil Pekerjaan (BAST)')

@section('content')
<div class="container-fluid">
    <h1>Berita Acara Serah Terima Hasil Pekerjaan (BAST)</h1>
    <form action="{{ route('PembantuPPTKView.bast.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="dpa_id">DPA:</label>
            <select name="dpa_id" class="form-control">
                @foreach ($dpas as $dpa)
                    <option value="{{ $dpa->id }}">{{ $dpa->kode_sub_kegiatan }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nomor">Nomor:</label>
            <input type="text" name="nomor" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="tanggal">Tanggal:</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan:</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="upload_dokumen">Upload Dokumen:</label>
            <input type="file" name="upload_dokumen" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>
@endsection
