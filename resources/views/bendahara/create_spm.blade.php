@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <form action="{{ route('bendahara.store_spm') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="dpa_id" value="{{ $dpa_id }}">

        <div class="form-group">
            <label for="no_spm">Nomor SPM:</label>
            <input type="text" class="form-control" id="no_spm" name="no_spm" required>
        </div>

        <div class="form-group">
            <label for="no_sptjmspm">Nomor SPTJM SPM:</label>
            <input type="text" class="form-control" id="no_sptjmspm" name="no_sptjmspm" required>
        </div>

        <div class="form-group">
            <label for="spm">Upload SPM:</label>
            <input type="file" class="form-control-file" id="spm" name="spm" accept=".pdf, .doc, .docx" required>
        </div>

        <div class="form-group">
            <label for="sptjmspm">Upload SPTJM SPM:</label>
            <input type="file" class="form-control-file" id="sptjmspm" name="sptjmspm" accept=".pdf, .doc, .docx" required>
        </div>

        <div class="form-group">
            <label for="lampiran_sumber_dana">Upload Lampiran Sumber Dana:</label>
            <input type="file" class="form-control-file" id="lampiran_sumber_dana" name="lampiran_sumber_dana" accept=".pdf, .doc, .docx" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
