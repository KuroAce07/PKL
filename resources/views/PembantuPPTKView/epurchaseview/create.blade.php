@extends('layouts.app')

@section('title', 'Create E-Purchasing')

@section('content')
<div class="container-fluid">
    <h1>Create E-Purchasing</h1>
    <!-- Display session success message if available -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <form action="{{ route('PembantuPPTKView.epurchaseview.store') }}" method="post" enctype="multipart/form-data">
        @csrf
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
                    <input type="hidden" name="hidden_dpa_id" id="hidden_dpa_id" value="{{ request()->query('dpaId') }}">
                </div>

                <div class="form-group">
                    <label for="jenis_kontrak">Nama Kegiatan/Sub Kegiatan:</label>
                    <select name="dpa_id" id="dpa_id" class="form-control" required readonly>
                        @foreach($dpas as $dpa)
                        <option value="{{ $dpa->id }}" {{ request()->query('dpaId') == $dpa->id ? 'selected' : '' }}>
                            {{ $dpa->nama_sub_kegiatan }}
                        </option>
                        @endforeach
                    </select>
                    <input type="hidden" name="hidden_dpa_id" id="hidden_dpa_id" value="{{ request()->query('dpaId') }}">
                </div>          

                <div class="form-group">
                    <label for="e_commerce">E-commerce:</label>
                    <input type="text" name="e_commerce" class="form-control" required>
                </div>

            <div class="form-group">
                <label for="harga_total">Harga Total:</label>
                <input type="text" name="harga_total" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="tanggal_buat">Tanggal Buat:</label>
                <input type="date" name="tanggal_buat" class="form-control" required>
            </div>

        <div class="form-group">
            <label for="keterangan">Keterangan:</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>

        </div>

            <div class="col-md-6">

                <div class="form-group">
                    <label for="id_paket">ID Paket/Pemesanan/No.PO:</label>
                    <input type="text" name="id_paket" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="jumlah">Jumlah:</label>
                    <input type="text" name="jumlah" class="form-control" required>
                </div>

            <div class="form-group">
                <label for="nama_pejabat_pengadaan">Nama Pejabat Pengadaan:</label>
                <select name="nama_pejabat_pengadaan" id="nama_pejabat_pengadaan" class="form-control" required readonly>
                    @foreach($pejabatPengadaanUsers as $user)
                        <option value="{{ $user->id }}" {{ request()->query('dpaId') == $user->id ? 'selected' : '' }}>
                            {{ $user->first_name }} {{ $user->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

        <div class="form-group">
            <label for="nama_penyedia">Nama Penyedia:</label>
            <input type="text" name="nama_penyedia" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="tanggal_ubah">Tanggal Ubah:</label>
            <input type="date" name="tanggal_ubah" class="form-control" required>
        </div>

        </div>
    </div>
    <label for="upload_dokumen">Upload Dokumen:</label>
        <input type="file" name="upload_dokumen" class="form-control-file">
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>
@endsection
