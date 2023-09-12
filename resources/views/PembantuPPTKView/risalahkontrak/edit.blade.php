@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1>Edit Risalah Kontrak</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('PembantuPPTKView.risalahkontrak.update', ['id' => $risalahkontraks->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="dpa_id">DPA:</label>
                    <input type="hidden" name="dpa_id" value="{{ $risalahkontraks->dpa_id }}">
                    <select class="form-control" readonly>
                        <option>{{ $risalahkontraks->dpa->kode_sub_kegiatan }}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="jenis_kontrak">Nama Kegiatan/Sub Kegiatan:</label>
                    <input type="hidden" name="dpa_id" value="{{ $risalahkontraks->dpa_id }}">
                    <select class="form-control" readonly>
                        <option>{{ $risalahkontraks->dpa->nama_sub_kegiatan }}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="kode_program_kegiatan">Kode Program Kegiatan:</label>
                    <input type="text" name="kode_program_kegiatan" class="form-control" step="0.01" value="{{ $risalahkontraks->kode_program_kegiatan }}" @if(Auth::user()->hasRole('PPTK')) readonly @endif>
                </div>

                <div class="form-group">
                    <label for="nama_program">Nama Program:</label>
                    <input type="text" name="nama_program" class="form-control" value="{{ $risalahkontraks->nama_program }}" @if(Auth::user()->hasRole('PPTK')) readonly @endif>
                </div>

                <div class="form-group">
                    <label for="nama_kegiatan">Nama Kegiatan:</label>
                    <input type="text" name="nama_kegiatan" class="form-control" value="{{ $risalahkontraks->nama_kegiatan }}" @if(Auth::user()->hasRole('PPTK')) readonly @endif>
                </div>

                <div class="form-group">
                    <label for="nama_paket_pekerjaan">Nama Paket Pekerjaan:</label>
                    <input type="text" name="nama_paket_pekerjaan" class="form-control" value="{{ $risalahkontraks->nama_paket_pekerjaan }}" @if(Auth::user()->hasRole('PPTK')) readonly @endif>
                </div>

                <div class="form-group">
                    <label for="lokasi_pekerjaan">Lokasi Pekerjaan:</label>
                    <input type="text" name="lokasi_pekerjaan" class="form-control" value="{{ $risalahkontraks->lokasi_pekerjaan }}" @if(Auth::user()->hasRole('PPTK')) readonly @endif>
                </div>

                <div class="form-group">
                    <label for="sumber_dana">Sumber Dana:</label>
                    <input type="text" name="sumber_dana" class="form-control" value="{{ $risalahkontraks->sumber_dana }}" @if(Auth::user()->hasRole('PPTK')) readonly @endif>
                </div>

                <div class="form-group">
                    <label for="nama_pelaksana_pekerjaan">Nama Pelaksana Pekerjaan:</label>
                    <input type="text" name="nama_pelaksana_pekerjaan" class="form-control" value="{{ $risalahkontraks->nama_pelaksana_pekerjaan }}" @if(Auth::user()->hasRole('PPTK')) readonly @endif>
                </div>

                <div class="form-group">
                    <label for="jenis_usaha">Jenis Usaha:</label>
                    <input type="text" name="jenis_usaha" class="form-control" value="{{ $risalahkontraks->jenis_usaha }}" @if(Auth::user()->hasRole('PPTK')) readonly @endif>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan:</label>
                    <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" @if(Auth::user()->hasRole('PPTK')) readonly @endif>{{ old('keterangan', $risalahkontraks->keterangan) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="upload_dokumen">Upload Dokumen</label>
                    @if($risalahkontraks->upload_dokumen)
                        <p>Current file: {{ $risalahkontraks->upload_dokumen }}</p>
                    @endif
                    <input type="file" class="form-control-file @error('upload_dokumen') is-invalid @enderror" id="upload_dokumen" name="upload_dokumen" @if(Auth::user()->hasRole('PPTK')) readonly @endif>
                    @error('upload_dokumen')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

            @if (auth()->user()->hasRole('Pembantu PPTK'))
                <input type="hidden" name="alasan" value=" ">
                <input type="hidden" name="approval" value="0">
                <input type="hidden" name="reject" value="0">
            @else
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="approval" name="approval">
                    <label class="form-check-label" for="approval">Approve</label>
                </div>

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="reject" name="reject">
                    <label class="form-check-label" for="reject">Reject</label>
                </div>

            <div class="form-group">
                <label for="alasan">Alasan:</label><textarea name="alasan" class="form-control" value="{{ $risalahkontraks->alasan }}" >{{ $risalahkontraks->alasan }}</textarea>
                </div>
            @endif

            </div>

            <div class="col-md-6">
                <!-- Second column content -->
                <div class="form-group">
                <label for="alamat_pelaksana_pekerjaan">Alamat Pelaksana Pekerjaan:</label>
                    <input type="text" name="alamat_pelaksana_pekerjaan" class="form-control" step="0.01" value="{{ $risalahkontraks->alamat_pelaksana_pekerjaan }}" @if(Auth::user()->hasRole('PPTK')) readonly @endif>
                </div>

                <div class="form-group">
                    <label for="nama_pimpinan_direktur">Nama Pimpinan Direktur:</label>
                    <input type="text" name="nama_pimpinan_direktur" class="form-control" step="0.01" value="{{ $risalahkontraks->nama_pimpinan_direktur }}" @if(Auth::user()->hasRole('PPTK')) readonly @endif>
                </div>

                <div class="form-group">
                    <label for="npwp">NPWP:</label>
                    <input type="text" name="npwp" class="form-control" step="0.01" value="{{ $risalahkontraks->npwp }}" @if(Auth::user()->hasRole('PPTK')) readonly @endif>
                </div>

                <div class="form-group">
                <label for="nomor_kontrak">Nomor Kontrak:</label>
                    <input type="text" name="nomor_kontrak" class="form-control" step="0.01" value="{{ $risalahkontraks->nomor_kontrak }}" @if(Auth::user()->hasRole('PPTK')) readonly @endif>
                </div>

                <div class="form-group">
                    <label for="tanggal_kontrak">Tanggal Kontrak:</label>
                    <input type="date" name="tanggal_kontrak" class="form-control" step="0.01" value="{{ $risalahkontraks->tanggal_kontrak }}" @if(Auth::user()->hasRole('PPTK')) readonly @endif>
                </div>

                <div class="form-group">
                    <label for="nilai_kontrak">Nilai Kontrak:</label>
                    <input type="number" name="nilai_kontrak" class="form-control" step="0.01" value="{{ $risalahkontraks->nilai_kontrak }}" @if(Auth::user()->hasRole('PPTK')) readonly @endif>
                </div>

                <div class="form-group">
                    <label for="nomor_rekening_bank">Nomor Rekening Bank:</label>
                    <input type="text" name="nomor_rekening_bank" class="form-control" step="0.01" value="{{ $risalahkontraks->nomor_rekening_bank }}" @if(Auth::user()->hasRole('PPTK')) readonly @endif>
                </div>

                <div class="form-group">
                    <label for="nama_rekening">Nama Rekening:</label>
                    <input type="text" name="nama_rekening" class="form-control" step="0.01" value="{{ $risalahkontraks->nama_rekening }}" @if(Auth::user()->hasRole('PPTK')) readonly @endif>
                </div>

                <div class="form-group">
                    <label for="metode_pengadaan">Metode Pengadaan:</label>
                    <input type="text" name="metode_pengadaan" class="form-control" step="0.01" value="{{ $risalahkontraks->metode_pengadaan }}" @if(Auth::user()->hasRole('PPTK')) readonly @endif>
                </div>

                <div class="form-group">
                    <label for="adendum_kontrak">Adendum Kontrak:</label>
                    <input type="text" name="adendum_kontrak" class="form-control" step="0.01" value="{{ $risalahkontraks->adendum_kontrak }}" @if(Auth::user()->hasRole('PPTK')) readonly @endif>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Dokumen Risalah Kontrak</button>
    </form>
</div>

@endsection

