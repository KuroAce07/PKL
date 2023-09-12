@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <form action="{{ route('bendahara.store_spp') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="dpa_id" value="{{ $dpa_id }}">

        <div class="form-group">
            <label for="no_spp">Nomor SPP:</label>
            <input type="text" class="form-control" id="no_spp" name="no_spp" required>
        </div>

        <div class="form-group">
            <label for="no_sptjmspp">Nomor SPTJM SPP:</label>
            <input type="text" class="form-control" id="no_sptjmspp" name="no_sptjmspp" required>
        </div>

        <div class="form-group">
            <label for="ket_spp">Keterangan:</label>
            <textarea class="form-control" id="ket_spp" name="ket_spp" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="spp">Upload SPP:</label>
            <input type="file" class="form-control-file" id="spp" name="spp" accept=".pdf, .doc, .docx" required>
        </div>

        <div class="form-group">
            <label for="sptjmspp">Upload SPTJM SPP:</label>
            <input type="file" class="form-control-file" id="sptjmspp" name="sptjmspp" accept=".pdf, .doc, .docx" required>
        </div>

        <div class="form-group">
            <label for="verif_spp">Upload Verifikasi SPP:</label>
            <input type="file" class="form-control-file" id="verif_spp" name="verif_spp" accept=".pdf, .doc, .docx" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
