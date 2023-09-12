@extends('layouts.app')

@section('title', 'Create E-Purchasing')

@section('content')
<div class="container-fluid">
    <h1>Create E-Purchasing</h1>

    <form action="{{ route('PembantuPPTKView.epurchaseview.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="dpa_id">DPA:</label>
            <select name="dpa_id" id="dpa_id" class="form-control" required>
                <option value="" disabled selected>Select DPA</option>
                @foreach($dpas as $dpa)
                    <option value="{{ $dpa->id }}">{{ $dpa->kode_sub_kegiatan }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="e_commerce">E-commerce:</label>
            <input type="text" name="e_commerce" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="id_paket">ID Paket/Pemesanan/No.PO:</label>
            <input type="text" name="id_paket" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="jumlah">Jumlah:</label>
            <input type="text" name="jumlah" class="form-control" required>
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
            <label for="tanggal_ubah">Tanggal Ubah:</label>
            <input type="date" name="tanggal_ubah" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="nama_pejabat_pengadaan">Nama Pejabat Pengadaan:</label>
            <input type="text" name="nama_pejabat_pengadaan" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="nama_penyedia">Nama Penyedia:</label>
            <input type="text" name="nama_penyedia" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
