@extends('layouts.app')

@section('title', 'Update E-Purchasing')

@section('content')
<div class="container-fluid">
    <h1>Update E-Purchasing</h1>

    <form action="{{ route('PembantuPPTKView.epurchaseview.update', ['id' => $ePurchasing->id]) }}" method="post">
        @csrf
        @method('PUT')
    <div class="form-group">
        <label for="dpa_id">DPA:</label>
        <select name="dpa_id" id="dpa_id" class="form-control" required>
            <option value="{{ $ePurchasing->dpa_id }}" selected>{{ $ePurchasing->dpa->kode_sub_kegiatan }}</option>
            @foreach($dpas as $dpa)
                <option value="{{ $dpa->id }}">{{ $dpa->kode_sub_kegiatan }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
            <label for="e_commerce">E-commerce:</label>
            <input type="text" name="e_commerce" class="form-control" value="{{ $ePurchasing->e_commerce }}" required>
        </div>
        <div class="form-group">
            <label for="id_paket">ID Paket/Pemesanan/No.PO:</label>
            <input type="text" name="id_paket" class="form-control" value="{{ $ePurchasing->id_paket }}" required>
        </div>
        <div class="form-group">
            <label for="jumlah">Jumlah:</label>
            <input type="text" name="jumlah" class="form-control" value="{{ $ePurchasing->jumlah }}" required>
        </div>
        <div class="form-group">
            <label for="harga_total">Harga Total:</label>
            <input type="text" name="harga_total" class="form-control" value="{{ $ePurchasing->harga_total }}" required>
        </div>
        <div class="form-group">
            <label for="tanggal_buat">Tanggal Buat:</label>
            <input type="date" name="tanggal_buat" class="form-control" value="{{ $ePurchasing->tanggal_buat }}" required>
        </div>
        <div class="form-group">
            <label for="tanggal_ubah">Tanggal Ubah:</label>
            <input type="date" name="tanggal_ubah" class="form-control" value="{{ $ePurchasing->tanggal_ubah }}" required>
        </div>
        <div class="form-group">
            <label for="nama_pejabat_pengadaan">Nama Pejabat Pengadaan:</label>
            <input type="text" name="nama_pejabat_pengadaan" class="form-control" value="{{ $ePurchasing->nama_pejabat_pengadaan }}" required>
        </div>
        <div class="form-group">
            <label for="nama_penyedia">Nama Penyedia:</label>
            <input type="text" name="nama_penyedia" class="form-control" value="{{ $ePurchasing->nama_penyedia }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
