@extends('layouts.app')

@section('title', 'Edit Berita Acara Pembayaran (BAP)')

@section('content')
<div class="container-fluid">
    <h1>Edit Berita Acara Pembayaran (BAP)</h1>
    <form action="{{ route('PembantuPPTKView.bap.update', ['id' => $bap->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="dpa_id">Choose DPA:</label>
            <select name="dpa_id" class="form-control" required>
                @foreach ($dpas as $dpa)
                    <option value="{{ $dpa->id }}" @if ($dpa->id === $bap->dpa_id) selected @endif>{{ $dpa->kode_sub_kegiatan }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nomor">Nomor:</label>
            <input type="text" name="nomor" class="form-control" value="{{ $bap->nomor }}" required>
        </div>
        <div class="form-group">
            <label for="tanggal">Tanggal:</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $bap->tanggal }}" required>
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan:</label>
            <textarea name="keterangan" class="form-control">{{ $bap->keterangan }}</textarea>
        </div>
        <div class="form-group">
            <label for="upload_dokumen">Upload Dokumen:</label>
            <input type="file" name="upload_dokumen" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
