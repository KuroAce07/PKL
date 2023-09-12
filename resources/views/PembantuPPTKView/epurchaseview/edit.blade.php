@extends('layouts.app')

@section('title', 'Update E-Purchasing')

@section('content')
    <div class="container-fluid">
        <h1>Edit E-Purchasing</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('PembantuPPTKView.epurchaseview.update', ['id' => $ePurchasing->id]) }}">
            @csrf
            @method('PUT')

            <div class="row">
                <!-- First Column -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="dpa_id">DPA:</label>
                        <input type="hidden" name="dpa_id" value="{{ $ePurchasing->dpa_id }}">
                        <select class="form-control" disabled>
                            <option>{{ $ePurchasing->dpa->kode_sub_kegiatan }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="jenis_kontrak">Nama Kegiatan/Sub Kegiatan:</label>
                        <input type="hidden" name="dpa_id" value="{{ $ePurchasing->dpa_id }}">
                        <select class="form-control" disabled>
                            <option>{{ $ePurchasing->dpa->nama_sub_kegiatan }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="e_commerce">E-commerce:</label>
                        <input type="text" name="e_commerce" class="form-control" value="{{ $ePurchasing->e_commerce }}" @if(Auth::user()->hasRole('PPTK')) disabled @endif>
                    </div>

                    <div class="form-group">
                        <label for="harga_total">Harga Total:</label>
                        <input type="text" name="harga_total" class="form-control" value="{{ $ePurchasing->harga_total }}" @if(Auth::user()->hasRole('PPTK')) disabled @endif>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_buat">Tanggal Buat:</label>
                        <input type="date" name="tanggal_buat" class="form-control" value="{{ $ePurchasing->tanggal_buat }}" @if(Auth::user()->hasRole('PPTK')) disabled @endif>
                    </div>

                    <div class="form-group">
                    <label for="keterangan">Keterangan:</label>
                    <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" @if(Auth::user()->hasRole('PPTK')) disabled @endif>{{ old('keterangan', $ePurchasing->keterangan) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="upload_dokumen">Upload Dokumen</label>
                    @if($ePurchasing->upload_dokumen)
                        <p>Current file: {{ $ePurchasing->upload_dokumen }}</p>
                    @endif
                    <input type="file" class="form-control-file @error('upload_dokumen') is-invalid @enderror" id="upload_dokumen" name="upload_dokumen" @if(Auth::user()->hasRole('PPTK')) disabled @endif>
                    @error('upload_dokumen')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                </div>

                <!-- Second Column -->
                <div class="col-md-6">

                <div class="form-group">
                        <label for="id_paket">ID Paket/Pemesanan/No.PO:</label>
                        <input type="text" name="id_paket" class="form-control" value="{{ $ePurchasing->id_paket }}" @if(Auth::user()->hasRole('PPTK')) disabled @endif>
                    </div>

                    <div class="form-group">
                        <label for="jumlah">Jumlah:</label>
                        <input type="text" name="jumlah" class="form-control" value="{{ $ePurchasing->jumlah }}" @if(Auth::user()->hasRole('PPTK')) disabled @endif>
                    </div>

                    <div class="form-group">
                        <label for="nama_pejabat_pengadaan">Nama Pejabat Pengadaan:</label>
                        <select name="nama_pejabat_pengadaan" id="nama_pejabat_pengadaan" class="form-control" value="{{ $ePurchasing->jumlah }}" @if(Auth::user()->hasRole('PPTK')) disabled @endif required readonly>
                            @foreach($pejabatPengadaanUsers as $user)
                                <option value="{{ $user->id }}" {{ request()->query('dpaId') == $user->id ? 'selected' : '' }}>
                                    {{ $user->first_name }} {{ $user->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nama_penyedia">Nama Penyedia:</label>
                        <input type="text" name="nama_penyedia" class="form-control" value="{{ $ePurchasing->nama_penyedia }}" @if(Auth::user()->hasRole('PPTK')) disabled @endif>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_ubah">Tanggal Ubah:</label>
                        <input type="date" name="tanggal_ubah" class="form-control" value="{{ $ePurchasing->tanggal_ubah }}" @if(Auth::user()->hasRole('PPTK')) disabled @endif>
                    </div>

                </div>
            </div>

            @if (auth()->user()->hasRole('Pembantu PPTK'))
                <input type="hidden" name="alasan" value=" ">
                <input type="hidden" name="approval" value="0">
                <input type="hidden" name="reject" value="0">
            @else
                <!-- Additional Fields for Roles Other Than 'Pembantu PPTK' -->
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="approval" name="approval">
                    <label class="form-check-label" for="approval">Approve</label>
                </div>

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="reject" name="reject">
                    <label class="form-check-label" for="reject">Reject</label>
                </div>

                <div class="form-group">
                    <label for="alasan">Alasan:</label>
                    <textarea name="alasan" class="form-control">{{ $ePurchasing->alasan }}</textarea>
                </div>
            @endif

            <button type="submit" class="btn btn-primary">Update Dokumen Kontrak Data</button>
            
        </form>
    </div>
@endsection
