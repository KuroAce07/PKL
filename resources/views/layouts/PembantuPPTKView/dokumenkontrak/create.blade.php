@extends('layouts.app')

@section('title', 'Dokumen Kontrak')

@section('content')
<div class="container-fluid">
    <h1>Dokumen Kontrak</h1>
    <form action="{{ route('PembantuPPTKView.dokumenkontrak.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="dpa_id">DPA:</label>
        <select name="dpa_id" id="dpa_id" class="form-control" required>
            <option value="" disabled selected>Select DPA</option>
            @foreach($dpas as $dpa)
                <option value="{{ $dpa->id }}">{{ $dpa->kode_sub_kegiatan }}</option>
            @endforeach
        </select>
        <label for="jenis_kontrak">Jenis Kontrak:</label>
        <select name="jenis_kontrak" id="jenis_kontrak" class="form-control" required>
            <option value="Kwitansi">Kwitansi</option>
            <option value="Nota/Bukti Pembelian/Invoice">Nota/Bukti Pembelian/Invoice</option>
            <option value="Surat Pemesanan">Surat Pemesanan</option>
            <option value="Dokumen Kontrak (SPK)">Dokumen Kontrak (SPK)</option>
            <option value="Surat Perjanjian">Surat Perjanjian</option>
        </select>
        <label for="nama_kegiatan_transaksi">Nama Kegiatan Transaksi:</label>
        <input type="text" name="nama_kegiatan_transaksi" class="form-control" required>
        <label for="tanggal_kontrak">Tanggal Kontrak:</label>
        <input type="date" name="tanggal_kontrak" class="form-control" required>
        <label for="jumlah_uang">Jumlah Uang:</label>
        <input type="number" name="jumlah_uang" class="form-control" step="0.01" required>
        <label for="ppn">PPN:</label>
        <input type="number" name="ppn" class="form-control" step="0.01">
        <label for="pph">PPH:</label>
        <input type="number" name="pph" class="form-control" step="0.01">
        <label for="potongan_lain">Potongan Lain:</label>
        <input type="number" name="potongan_lain" class="form-control" step="0.01">
        <label for="jumlah_potongan">Jumlah Potongan:</label>
        <input type="number" name="jumlah_potongan" class="form-control" step="0.01">
        <label for="jumlah_total">Jumlah Total:</label>
        <input type="number" name="jumlah_total" class="form-control" step="0.01" required>
        <label for="keterangan">Keterangan:</label>
        <textarea name="keterangan" class="form-control"></textarea>
        <label for="upload_dokumen">Upload Dokumen:</label>
        <input type="file" name="upload_dokumen" class="form-control-file">
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>
@endsection
