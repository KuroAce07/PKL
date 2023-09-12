@extends('layouts.app')

@section('title', 'View E-Purchasing')

@section('content')
<div class="container-fluid">
    <h1>View E-Purchasing</h1>

    <div class="card">
        <div class="card-header">
            E-Purchasing Data
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>E-commerce:</strong> {{ $ePurchasing->e_commerce }}</p>
                    <p><strong>ID Paket:</strong> {{ $ePurchasing->id_paket }}</p>
                    <p><strong>Jumlah:</strong> {{ $ePurchasing->jumlah }}</p>
                    <p><strong>Harga Total:</strong> {{ $ePurchasing->harga_total }}</p>
                    <p><strong>Tanggal Buat:</strong> {{ $ePurchasing->tanggal_buat }}</p>
                    <p><strong>Tanggal Ubah:</strong> {{ $ePurchasing->tanggal_ubah }}</p>
                    <p><strong>Nama Pejabat Pengadaan:</strong> {{ $ePurchasing->nama_pejabat_pengadaan }}</p>
                    <p><strong>Nama Penyedia:</strong> {{ $ePurchasing->nama_penyedia }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('PembantuPPTKView.epurchaseview.edit', ['id' => $ePurchasing->id]) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
</div>
@endsection
