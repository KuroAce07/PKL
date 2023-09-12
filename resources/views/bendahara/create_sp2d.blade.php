@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <form action="{{ route('bendahara.store_sp2d') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="dpa_id" value="{{ $dpa_id }}">

        <div class="form-group">
            <label for="no_sp2d">Nomor SP2D:</label>
            <input type="text" class="form-control" id="no_sp2d" name="no_sp2d" required>
        </div>

        <div class="form-group">
            <label for="tanggal">Tanggal:</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
        </div>

        <div class="form-group">
            <label for="ket_sp2d">Keterangan:</label>
            <textarea class="form-control" id="ket_sp2d" name="ket_sp2d" rows="4"></textarea>
        </div>

        <div class="form-group">
            <label for="sp2d">Upload SP2D:</label>
            <input type="file" class="form-control-file" id="sp2d" name="sp2d" accept=".pdf, .doc, .docx" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
