@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h2>Ceklis Form</h2>
    <form action="{{ route('ceklisform.store') }}" method="post">
        @csrf
        
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
                    <td><input type="checkbox" name="kwitansi" value="1"></td>
                </tr>
                <tr>
                    <td>Nota/Bukti Pembelian/Invoice</td>
                    <td><input type="checkbox" name="nota_bukti_invoice" value="1"></td>
                </tr>
                <tr>
                    <td>Surat Pemesanan</td>
                    <td><input type="checkbox" name="surat_pemesanan" value="1"></td>
                </tr>
                <tr>
                    <td>Dokumen Kontrak</td>
                    <td><input type="checkbox" name="dok_kontrak" value="1"></td>
                </tr>
                <tr>
                    <td>Surat Perjanjian</td>
                    <td><input type="checkbox" name="surat_perjanjian" value="1"></td>
                </tr>
                <tr>
                    <td>Dokumen E-Purchasing</td>
                    <td><input type="checkbox" name="dok_epurchasing" value="1"></td>
                </tr>
                <tr>
                    <td>Risalah/Ringkasan Kontrak</td>
                    <td><input type="checkbox" name="ringkasan_kontrak" value="1"></td>
                </tr>
                <tr>
                    <td>Dokumen Pendukung</td>
                    <td><input type="checkbox" name="dok_pendukung" value="1"></td>
                </tr>
                <tr>
                    <td>Tabel Barang jika Komposisi TKDN &lt; 40%</td>
                    <td><input type="checkbox" name="tkdn" value="1"></td>
                </tr>
                <tr>
                    <td>Berita Acara Serah Terima Hasil Pekerjaan</td>
                    <td><input type="checkbox" name="berita_serah_terima" value="1"></td>
                </tr>
                <tr>
                    <td>Berita Acara Pembayaran</td>
                    <td><input type="checkbox" name="berita_pembayaran" value="1"></td>
                </tr>
                <tr>
                    <td>Berita Pemeriksaan</td>
                    <td><input type="checkbox" name="berita_pemeriksaan" value="1"></td>
                </tr>
            </tbody>
        </table>
        
        {{-- @php
        if (request()->route()->getName() === 'ceklisform.index') {
            $id = request()->route('id');
        } else {
            $id = null; // Handle other cases if needed
        }
    @endphp --}}
    
    <input type="hidden" name="dpa_id" value="{{ $dpa_id }}">
        <button type="submit" class="btn btn-success">Submit</button>
        
        @if (count($ceklisForms) > 0)
            <a href="{{ route('ceklisform.result', ['id' => $dpa_id]) }}" class="btn btn-success">Lihat Hasil</a>
        @endif
    </form>
</div>
@endsection
