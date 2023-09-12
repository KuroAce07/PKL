@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1>Edit Dokumen Kontrak (SPK)</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('PembantuPPTKView.dokumenkontrakspk.update', ['id' => $dokumenKontrakspk->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="dpa_id">DPA:</label>
                    <input type="hidden" name="dpa_id" value="{{ $dokumenKontrakspk->dpa_id }}">
                    <select class="form-control" disabled>
                        <option>{{ $dokumenKontrakspk->dpa->kode_sub_kegiatan }}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="jenis_kontrak">Nama Kegiatan/Sub Kegiatan:</label>
                    <input type="hidden" name="dpa_id" value="{{ $dokumenKontrakspk->dpa_id }}">
                    <select class="form-control" disabled>
                        <option>{{ $dokumenKontrakspk->dpa->nama_sub_kegiatan }}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="no_bukti">No Bukti:</label>
                    <input type="number" name="no_bukti" class="form-control" step="0.01" value="{{ $dokumenKontrakspk->no_bukti }}" @if(Auth::user()->hasRole('PPTK')) disabled @endif>
                </div>

                <div class="form-group">
                    <label for="nama_kegiatan_transaksi">Nama Kegiatan Transaksi:</label>
                    <input type="text" name="nama_kegiatan_transaksi" class="form-control" value="{{ $dokumenKontrakspk->nama_kegiatan_transaksi }}" @if(Auth::user()->hasRole('PPTK')) disabled @endif>
                </div>

                <div class="form-group">
                    <label for="tanggal_kontrak">Tanggal Kontrak:</label>
                    <input type="date" name="tanggal_kontrak" class="form-control" value="{{ $dokumenKontrakspk->tanggal_kontrak }}" @if(Auth::user()->hasRole('PPTK')) disabled @endif>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan:</label>
                    <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" @if(Auth::user()->hasRole('PPTK')) disabled @endif>{{ old('keterangan', $dokumenKontrakspk->keterangan) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="upload_dokumen">Upload Dokumen</label>
                    @if($dokumenKontrakspk->upload_dokumen)
                        <p>Current file: {{ $dokumenKontrakspk->upload_dokumen }}</p>
                    @endif
                    <input type="file" class="form-control-file @error('upload_dokumen') is-invalid @enderror" id="upload_dokumen" name="upload_dokumen" @if(Auth::user()->hasRole('PPTK')) disabled @endif>
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
                <label for="alasan">Alasan:</label><textarea name="alasan" class="form-control" value="{{ $dokumenKontrakspk->alasan }}" >{{ $dokumenKontrakspk->alasan }}</textarea>
                </div>
            @endif
            </div>

            <div class="col-md-6">
                <!-- Second column content -->
                <div class="form-group">
                    <label for="ppn">PPN:</label>
                    <input type="number" name="ppn" class="form-control" step="0.01" value="{{ $dokumenKontrakspk->ppn }}" @if(Auth::user()->hasRole('PPTK')) disabled @endif>
                </div>
                <div class="form-group">
                    <label for="pph">PPH:</label>
                    <input type="number" name="pph" class="form-control" step="0.01" value="{{ $dokumenKontrakspk->pph }}" @if(Auth::user()->hasRole('PPTK')) disabled @endif>
                </div>
                <div class="form-group">
                    <label for="potongan_lain">Potongan Lain:</label>
                    <input type="number" name="potongan_lain" class="form-control" step="0.01" value="{{ $dokumenKontrakspk->potongan_lain }}" @if(Auth::user()->hasRole('PPTK')) disabled @endif>
                </div>
                <div class="form-group">
                    <label for="jumlah_potongan">Jumlah Potongan:</label>
                    <input type="number" name="jumlah_potongan" class="form-control" step="0.01" value="{{ $dokumenKontrakspk->jumlah_potongan }}" @if(Auth::user()->hasRole('PPTK')) disabled @endif>
                </div>
                <div class="form-group">
                    <label for="jumlah_uang">Jumlah Uang:</label>
                    <input type="number" name="jumlah_uang" class="form-control" step="0.01" value="{{ $dokumenKontrakspk->jumlah_uang }}" @if(Auth::user()->hasRole('PPTK')) disabled @endif>
                </div>
                <div class="form-group">
                    <label for="jumlah_total">Jumlah Total:</label>
                    <input type="number" name="jumlah_total" class="form-control" step="0.01" value="{{ $dokumenKontrakspk->jumlah_total }}" @if(Auth::user()->hasRole('PPTK')) disabled @endif>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Dokumen Kontrak SPK Data</button>
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

