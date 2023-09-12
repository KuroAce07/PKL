@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h2>Edit Form</h2>
    <form action="{{ route('ceklisform.update', ['id' => $dpa_id]) }}" method="post">
        @csrf
        @method('PUT')
        
        <table class="table">
            <thead>
                <tr>
                    <th>Nama berkas</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Kwitansi</td>
                    <td><input type="checkbox" name="kwitansi" value="1" @if($ceklis->kwitansi) checked @endif></td>
                </tr>
                <tr>
                    <td>Nota/Bukti Pembelian/Invoice</td>
                    <td><input type="checkbox" name="nota_bukti_invoice" value="1" @if($ceklis->nota_bukti_invoice) checked @endif></td>
                </tr>
                <tr>
                    <td>Surat Pemesanan</td>
                    <td><input type="checkbox" name="surat_pemesanan" value="1" @if($ceklis->surat_pemesanan) checked @endif></td>
                </tr>
                <tr>
                    <td>Dokumen Kontrak</td>
                    <td><input type="checkbox" name="dok_kontrak" value="1" @if($ceklis->dok_kontrak) checked @endif></td>
                </tr>
                <tr>
                    <td>Surat Perjanjian</td>
                    <td><input type="checkbox" name="surat_perjanjian" value="1" @if($ceklis->surat_perjanjian) checked @endif></td>
                </tr>
                <tr>
                    <td>Dokumen E-Purchasing</td>
                    <td><input type="checkbox" name="dok_epurchasing" value="1" @if($ceklis->dok_epurchasing) checked @endif></td>
                </tr>
                <tr>
                    <td>Risalah/Ringkasan Kontrak</td>
                    <td><input type="checkbox" name="ringkasan_kontrak" value="1" @if($ceklis->ringkasan_kontrak) checked @endif></td>
                </tr>
                <tr>
                    <td>Dokumen Pendukung</td>
                    <td><input type="checkbox" name="dok_pendukung" value="1" @if($ceklis->dok_pendukung) checked @endif></td>
                </tr>
                <tr>
                    <td>Tabel Barang jika Komposisi TKDN &lt; 40%</td>
                    <td><input type="checkbox" name="tkdn" value="1" @if($ceklis->tkdn) checked @endif></td>
                </tr>
                <tr>
                    <td>Berita Acara Serah Terima Hasil Pekerjaan</td>
                    <td><input type="checkbox" name="berita_serah_terima" value="1" @if($ceklis->berita_serah_terima) checked @endif></td>
                </tr>
                <tr>
                    <td>Berita Acara Pembayaran</td>
                    <td><input type="checkbox" name="berita_pembayaran" value="1" @if($ceklis->berita_pembayaran) checked @endif></td>
                </tr>
                <tr>
                    <td>Berita Pemeriksaan</td>
                    <td><input type="checkbox" name="berita_pemeriksaan" value="1" @if($ceklis->berita_pemeriksaan) checked @endif></td>
                </tr>
                <!-- Lanjutkan dengan bagian lainnya -->
            </tbody>
        </table>
        
        <input type="hidden" name="dpa_id" value="{{ $dpa_id }}">
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
