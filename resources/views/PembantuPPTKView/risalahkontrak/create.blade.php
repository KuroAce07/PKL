@extends('layouts.app')

@section('title', 'Dokumen Risalah Kontrak')

@section('content')
<div class="container-fluid">
    <h1>Dokumen Risalah Kontrak</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('PembantuPPTKView.risalahkontrak.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="dpa_id" value="{{ $dpaId }}">
        <div class="row">
            <div class="col-md-6">
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
                        <option value="{{ $dpa ->id }}" {{ request()->query('dpaId') == $dpa->id ? 'selected' : '' }}>{{ $dpa->nama_sub_kegiatan }}
                        @endforeach
                </select>
                </div>
                
                <div class="form-group">
                    <label for="kode_program_kegiatan">Kode Program Kegiatan:</label>
                    <input type="text" name="kode_program_kegiatan" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="nama_program">Nama Program:</label>
                    <input type="text" name="nama_program" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="nama_kegiatan">Nama Kegiatan:</label>
                    <input type="text" name="nama_kegiatan" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="nama_paket_pekerjaan">Nama Paket Pekerjaan:</label>
                    <input type="text" name="nama_paket_pekerjaan" class="form-control">
                </div>

                <div class="form-group">
                    <label for="lokasi_pekerjaan">Lokasi Pekerjaan:</label>
                    <input type="text" name="lokasi_pekerjaan" class="form-control">
                </div>

                <div class="form-group">
                    <label for="sumber_dana">Sumber Dana:</label>
                    <input type="text" name="sumber_dana" class="form-control">
                </div>

                <div class="form-group">
                    <label for="nama_pelaksana_pekerjaan">Nama Pelaksana Pekerjaan:</label>
                    <input type="text" name="nama_pelaksana_pekerjaan" class="form-control">
                </div>

                <div class="form-group">
                    <label for="jenis_usaha">Jenis Usaha:</label>
                    <input type="text" name="jenis_usaha" class="form-control">
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan:</label>
                    <textarea name="keterangan" class="form-control"></textarea>
                </div>
            </div>

            <div class="col-md-6">

                <div class="form-group">
                    <label for="alamat_pelaksana_pekerjaan">Alamat Pelaksana Pekerjaan:</label>
                    <input type="text" name="alamat_pelaksana_pekerjaan" class="form-control">
                </div>

                <div class="form-group">
                    <label for="nama_pimpinan_direktur">Nama Pimpinan Direktur:</label>
                    <input type="text" name="nama_pimpinan_direktur" class="form-control">
                </div>

                <div class="form-group">
                    <label for="npwp">NPWP:</label>
                    <input type="text" name="npwp" class="form-control">
                </div>

                <div class="form-group">
                    <label for="nomor_kontrak">Nomor Kontrak:</label>
                    <input type="text" name="nomor_kontrak" class="form-control">
                </div>

                <div class="form-group">
                    <label for="tanggal_kontrak">Tanggal Kontrak:</label>
                    <input type="date" name="tanggal_kontrak" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="nilai_kontrak">Nilai Kontrak:</label>
                    <input type="number" name="nilai_kontrak" class="form-control">
                </div>

                <div class="form-group">
                    <label for="nomor_rekening_bank">Nomor Rekening Bank:</label>
                    <input type="text" name="nomor_rekening_bank" class="form-control">
                </div>

                <div class="form-group">
                    <label for="nama_rekening">Nama Rekening:</label>
                    <input type="text" name="nama_rekening" class="form-control">
                </div>

                <div class="form-group">
                    <label for="metode_pengadaan">Metode Pengadaan:</label>
                    <input type="text" name="metode_pengadaan" class="form-control">
                </div>

                <div class="form-group">
                    <label for="adendum_kontrak">Adendum Kontrak:</label>
                    <input type="text" name="adendum_kontrak" class="form-control">
                </div>

            </div>
        </div>
        <label for="upload_dokumen">Upload Dokumen:</label>
        <input type="file" name="upload_dokumen" class="form-control-file">
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>

@endsection