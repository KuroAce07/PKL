@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<form method="POST" action="{{ route('bendahara.store') }}" enctype="multipart/form-data">
  @csrf
  <div class="mb-3">
      <label for="formFile" class="form-label">Upload SPP</label>
      <input class="form-control" type="file" name="SPP" id="formFile">
    </div>
  <div class="mb-3">
      <label for="formFile" class="form-label">Upload SPTJM SPP</label>
      <input class="form-control" type="file" name="SPTJMSPP" id="formFile">
    </div>
  <div class="mb-3">
      <label for="formFile" class="form-label">Upload Dokumen Verifikasi SPP</label>
      <input class="form-control" type="file" name="VerifSPP" id="formFile">
    </div>
  <div class="mb-3">
      <label for="formFile" class="form-label">Upload SPM</label>
      <input class="form-control" type="file" name="SPM" id="formFile">
    </div>
  <div class="mb-3">
      <label for="formFile" class="form-label">Upload SPTJM SPM</label>
      <input class="form-control" type="file" name="SPTJMSPM" id="formFile">
    </div>
  <div class="mb-3">
      <label for="formFile" class="form-label">Upload Lampiran Sumber Dana</label>
      <input class="form-control" type="file" name="SumberDana" id="formFile">
    </div>
  <div class="mb-3">
      <label for="formFile" class="form-label">Upload Surat Pengantar</label>
      <input class="form-control" type="file" name="SuratPengantar" id="formFile">
    </div>
  <div class="mb-3">
      <label for="formFile" class="form-label">Upload Form Checklist</label>
      <input class="form-control" type="file" name="FormCheck" id="formFile">
    </div>
  <div style="display:flex; justify-content:center;" >
      <button type="submit" class="btn btn-primary">Kirim</button>
  </div>
</form>
  
@endsection




