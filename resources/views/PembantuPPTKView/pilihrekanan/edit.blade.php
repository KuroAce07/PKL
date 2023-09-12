@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Pilihan Rekanan</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('PembantuPPTKView.pilihrekanan.update', ['id' => $pilihanRekanan->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="dpa_id">DPA:</label>
                <select name="dpa_id" id="dpa_id" class="form-control" required>
                    @foreach($dpas as $dpa)
                        <option value="{{ $dpa->id }}" {{ $pilihanRekanan->dpa_id == $dpa->id ? 'selected' : '' }}>{{ $dpa->kode_sub_kegiatan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="pilih">Pilih Rekanan:</label>
                <select name="pilih" class="form-control" required @if(Auth::user()->hasRole('PPTK')) disabled @endif>
                    @foreach ($rekanans as $rekanan)
                        <option value="{{ $rekanan->nama_rekanan }}" {{ $pilihanRekanan->pilih == $rekanan->nama_rekanan ? 'selected' : '' }}>{{ $rekanan->nama_rekanan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="jenis_pengadaan">Jenis Pengadaan:</label>
                <select name="jenis_pengadaan" class="form-control" required @if(Auth::user()->hasRole('PPTK')) disabled @endif>
                    <option value="NPWP" {{ $pilihanRekanan->jenis_pengadaan == 'NPWP' ? 'selected' : '' }}>NPWP</option>
                    <option value="Buku Rekening Bank" {{ $pilihanRekanan->jenis_pengadaan == 'Buku Rekening Bank' ? 'selected' : '' }}>Buku Rekening Bank</option>
                    <option value="NIB" {{ $pilihanRekanan->jenis_pengadaan == 'NIB' ? 'selected' : '' }}>NIB</option>
                </select>
            </div>

            <div class="form-group">
                <label for="detail">Detail:</label>
                <textarea name="detail" class="form-control" @if(Auth::user()->hasRole('PPTK')) disabled @endif>{{ $pilihanRekanan->detail }}</textarea>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan:</label>
                <textarea name="keterangan" class="form-control" @if(Auth::user()->hasRole('PPTK')) disabled @endif>{{ $pilihanRekanan->keterangan }}</textarea>
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
                <label for="alasan">Alasan:</label><textarea name="alasan" class="form-control">{{ $pilihanRekanan->alasan }}</textarea>
                </div>
            @endif

            <button type="submit" class="btn btn-primary">Update Dokumen Kontrak Data</button>
        </form>
    </div>
@endsection
