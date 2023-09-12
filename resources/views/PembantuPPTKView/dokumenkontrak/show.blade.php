@extends('layouts.app')

@section('title', 'Dokumen Kwitansi')

@section('content')
<div class="container-fluid">
    <h1>Dokumen Kwitansi</h1>

    <!-- Display the details of a single Dokumen Kontrak entry -->
    <div class="card">
        <div class="card-header">
            Dokumen Kwitansi Details
        </div>
        <div class="card-body">
            <p><strong>Nomor DPA:</strong> {{ $dokumenKontrak->dpa->kode_sub_kegiatan }}</p>
            <p><strong>Nama Kegiatan:</strong> {{ $dokumenKontrak->dpa->nama_sub_kegiatan }}</p>
            <p><strong>No Bukti:</strong> {{ $dokumenKontrak->no_bukti }}</p>
            <p><strong>Nama Kegiatan Transaksi:</strong> {{ $dokumenKontrak->nama_kegiatan_transaksi }}</p>
            <p><strong>Tanggal Kontrak:</strong> {{ $dokumenKontrak->tanggal_kontrak }}</p>
            <p><strong>Jumlah Uang:</strong> Rp. {{ number_format($dokumenKontrak->jumlah_uang, 0, ',', '.') }}</p>
            <p><strong>PPN:</strong> Rp. {{ number_format($dokumenKontrak->ppn, 0, ',', '.') }}</p>
            <p><strong>PPH:</strong> Rp. {{ number_format($dokumenKontrak->pph, 0, ',', '.') }}</p>
            <p><strong>Potongan Lain:</strong> Rp. {{ number_format($dokumenKontrak->potongan_lain, 0, ',', '.') }}</p>
            <p><strong>Jumlah Potongan:</strong> Rp. {{ number_format($dokumenKontrak->jumlah_potongan, 0, ',', '.') }}</p>
            <p><strong>Jumlah Total:</strong> Rp. {{ number_format($dokumenKontrak->jumlah_total, 0, ',', '.') }}</p>
            <p><strong>Keterangan:</strong> {{ $dokumenKontrak->keterangan }}</p>
            <p><strong>Dokumen:</strong> <a href="{{ url('uploads/' . $dpaId . '/' . basename($dokumenKontrak->upload_dokumen)) }}" download>View Dokumen</a></p>
            <p><strong>Status Persetujuan:</strong>
                @if ($dokumenKontrak->approval === 1)
                    <span class="text-success">Dokumen Disetujui</span>
                @elseif ($dokumenKontrak->approval === 2)
                    <span class="text-danger">Dokumen Ditolak</span>
                @else
                    <span class="text-warning">Dokumen Belum Disetujui</span>
                @endif
            </p>
            <p><strong>Alasan:</strong> {{ $dokumenKontrak->alasan }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('PembantuPPTKView.dokumenkontrak.edit', ['id' => $dokumenKontrak->id]) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
</div>

<script>
  document.addEventListener("input", function(event) {
    if (event.target.matches(".number-input")) {
      const step = parseFloat(event.target.getAttribute("data-step")) || 1.0;
      const inputValue = event.target.value.replace(/\D/g, ''); // Remove non-numeric characters
      const formattedValue = inputValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
      event.target.value = formattedValue;
    }
  });
</script>

@endsection
