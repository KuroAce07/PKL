@extends('layouts.app')

@section('title', 'Dokumen Kwitansi')

@section('content')
<div class="container-fluid">
    <h1>Dokumen Kwitansi</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('PembantuPPTKView.dokumenkontrak.store') }}" method="post" enctype="multipart/form-data">
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
                    <label for="no_bukti">No Bukti:</label>
                    <input type="number" name="no_bukti" class="form-control" step="1">
                </div>

                <div class="form-group">
                    <label for="nama_kegiatan_transaksi">Nama Kegiatan Transaksi:</label>
                    <input type="text" name="nama_kegiatan_transaksi" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="tanggal_kontrak">Tanggal Kontrak:</label>
                    <input type="date" name="tanggal_kontrak" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan:</label>
                    <textarea name="keterangan" class="form-control"></textarea>
                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">
                    <label for="ppn">PPN:</label>
                    <input type="number" name="ppn" class="form-control" step="1">
                </div>

                <div class="form-group">
                    <label for="pph">PPH:</label>
                    <input type="number" name="pph" class="form-control" step="1">
                </div>

                <div class="form-group">
                    <label for="potongan_lain">Potongan Lain:</label>
                    <input type="number" name="potongan_lain" class="form-control" step="1">
                </div>

                <div class="form-group">
                    <label for="jumlah_potongan">Jumlah Potongan:</label>
                    <input type="number" name="jumlah_potongan" class="form-control" step="1">
                </div>

                <div class="form-group">
                    <label for="jumlah_uang">Jumlah Uang:</label>
                    <input type="number" name="jumlah_uang" class="form-control" step="1">
                </div>

                <div class="form-group">
                    <label for="jumlah_total">Jumlah Total:</label>
                    <input type="number" name="jumlah_total" class="form-control" step="1" required>
                </div>
                
            </div>
        </div>
        <label for="upload_dokumen">Upload Dokumen:</label>
        <input type="file" name="upload_dokumen" class="form-control-file">
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    let ppnInput = document.querySelector('input[name="ppn"]');
    let pphInput = document.querySelector('input[name="pph"]');
    let potonganLainInput = document.querySelector('input[name="potongan_lain"]');
    let jumlahPotonganInput = document.querySelector('input[name="jumlah_potongan"]');
    let jumlahUangInput = document.querySelector('input[name="jumlah_uang"]');
    let jumlahTotalInput = document.querySelector('input[name="jumlah_total"]');

    function updateJumlahPotongan() {
        let ppn = parseInt(ppnInput.value) || 0;
        let pph = parseInt(pphInput.value) || 0;
        let potonganLain = parseInt(potonganLainInput.value) || 0;
        jumlahPotonganInput.value = ppn + pph + potonganLain;
    }

    ppnInput.addEventListener('input', updateJumlahPotongan);
    pphInput.addEventListener('input', updateJumlahPotongan);
    potonganLainInput.addEventListener('input', updateJumlahPotongan);

    function updateJumlahTotal() {
        let jumlahUang = parseInt(jumlahUangInput.value) || 0;
        let jumlahPotongan = parseInt(jumlahPotonganInput.value) || 0;
        jumlahTotalInput.value = jumlahUang - jumlahPotongan;
    }

    jumlahUangInput.addEventListener('input', updateJumlahTotal);
    jumlahPotonganInput.addEventListener('input', updateJumlahTotal);
});
</script>
@endsection
