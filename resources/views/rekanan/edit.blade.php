@extends('layouts.app')

@section('title', 'Edit Rekanan')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Rekanan</h1>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- Edit Form -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('rekanan.update', $rekanan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="kode_rekanan">Kode Rekanan:</label>
                        <input type="text" name="kode_rekanan" value="{{ $rekanan->kode_rekanan }}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="jenis_rekanan">Jenis Rekanan:</label>
                        <select name="jenis_rekanan" class="form-control" required>
                            <option value="Perorangan" {{ $rekanan->jenis_rekanan === 'Perorangan' ? 'selected' : '' }}>Perorangan</option>
                            <option value="Perusahaan" {{ $rekanan->jenis_rekanan === 'Perusahaan' ? 'selected' : '' }}>Perusahaan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nik_rekanan">NIK Rekanan:</label>
                        <input type="text" name="nik_rekanan" value="{{ $rekanan->nik_rekanan }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="nomor_npwp">Nomor NPWP:</label>
                        <input type="text" name="nomor_npwp" value="{{ $rekanan->nomor_npwp }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="nama_rekanan">Nama Rekanan:</label>
                        <input type="text" name="nama_rekanan" value="{{ $rekanan->nama_rekanan }}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="nama_instansi">Nama Instansi:</label>
                        <input type="text" name="nama_instansi" value="{{ $rekanan->nama_instansi }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="jenis_usaha">Jenis Usaha:</label>
                        <input type="text" name="jenis_usaha" value="{{ $rekanan->jenis_usaha }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="nama_bank">Nama Bank:</label>
                        <input type="text" name="nama_bank" value="{{ $rekanan->nama_bank }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="nama_cabang">Nama Cabang:</label>
                        <input type="text" name="nama_cabang" value="{{ $rekanan->nama_cabang }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="nomor_rekening">Nomor Rekening:</label>
                        <input type="text" name="nomor_rekening" value="{{ $rekanan->nomor_rekening }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="nama_rekening">Nama Rekening:</label>
                        <input type="text" name="nama_rekening" value="{{ $rekanan->nama_rekening }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="telepon">Telepon:</label>
                        <input type="text" name="telepon" value="{{ $rekanan->telepon }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat:</label>
                        <textarea name="alamat" class="form-control">{{ $rekanan->alamat }}</textarea>
                    </div>

                    <!-- Add other form fields here -->
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <!-- Add any required scripts here -->
@endsection
