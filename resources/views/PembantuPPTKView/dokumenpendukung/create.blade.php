@extends('layouts.app')

@section('title', 'Dokumen Pendukung')

@section('content')
<div class="container-fluid">
    <h1>Dokumen Pendukung</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('PembantuPPTKView.dokumenpendukung.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="dpa_id" value="{{ $dpaId }}">
        
        <div class="form-group">
            <label for="dpa_id">DPA:</label>
            <select name="dpa_id" id="dpa_id" class="form-control" required disabled>
                @foreach($dpas as $dpa)
                    <option value="{{ $dpa->id }}" {{ request()->query('dpaId') == $dpa->id ? 'selected' : '' }}>
                        {{ $dpa->kode_sub_kegiatan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="jenis_kontrak">Nama Kegiatan/Sub Kegiatan:</label>
            <select name="dpa_id" id="dpa_id" class="form-control" required disabled>
                @foreach($dpas as $dpa)
                    <option value="{{ $dpa->id }}" {{ request()->query('dpaId') == $dpa->id ? 'selected' : '' }}>
                        {{ $dpa->nama_sub_kegiatan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" class="form-control" required>
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

<script type="text/javascript">
var dataTransfer = new DataTransfer();

function addFiles(files) {
    for (var i = 0; i < files.length; i++) {
        dataTransfer.items.add(files[i]);
    }
    updateList();
}

function updateList() {
    var input = document.getElementById('hidden_upload_dokumen');
    input.files = dataTransfer.files;

    var output = document.getElementById('fileList');
    output.innerHTML = '<ul>';
    for (var i = 0; i < dataTransfer.files.length; ++i) {
        output.innerHTML += '<li>' + dataTransfer.files.item(i).name + '</li>';
    }
    output.innerHTML += '</ul>';
}

var dropZone = document.querySelector('.container-fluid');
dropZone.addEventListener('dragover', function(e) {
    e.stopPropagation();
    e.preventDefault();
    e.dataTransfer.dropEffect = 'copy';
});

dropZone.addEventListener('drop', function(e) {
    e.stopPropagation();
    e.preventDefault();
    var files = e.dataTransfer.files;
    
    addFiles(files);
});
</script>
@endsection
