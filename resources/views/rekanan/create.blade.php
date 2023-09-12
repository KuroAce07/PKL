@extends('layouts.app')

@section('title', 'Create New Rekanan')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Create New Rekanan</h1>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- Form to Create New Rekanan -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create New Rekanan</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('rekanan.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="kode_rekanan">Kode Rekanan</label>
                        <input type="text" class="form-control" id="kode_rekanan" name="kode_rekanan" required>
                    </div>

                    <div class="form-group">
                        <label for="jenis_rekanan">Jenis Rekanan</label>
                        <select class="form-control" id="jenis_rekanan" name="jenis_rekanan" required>
                            <option value="Perorangan">Perorangan</option>
                            <option value="Perusahaan">Perusahaan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nik_rekanan">NIK Rekanan</label>
                        <input type="text" class="form-control" id="nik_rekanan" name="nik_rekanan">
                    </div>

                    <div class="form-group">
                        <label for="nomor_npwp">Nomor NPWP</label>
                        <input type="text" class="form-control" id="nomor_npwp" name="nomor_npwp">
                    </div>

                    <div class="form-group">
                        <label for="nama_rekanan">Nama Rekanan</label>
                        <input type="text" class="form-control" id="nama_rekanan" name="nama_rekanan" required>
                    </div>

                    <div class="form-group">
                        <label for="nama_instansi">Nama Instansi</label>
                        <input type="text" class="form-control" id="nama_instansi" name="nama_instansi">
                    </div>

                    <div class="form-group">
                        <label for="jenis_usaha">Jenis Usaha</label>
                        <input type="text" class="form-control" id="jenis_usaha" name="jenis_usaha">
                    </div>

                    <div class="form-group">
                        <label for="nama_bank">Nama Bank</label>
                        <input type="text" class="form-control" id="nama_bank" name="nama_bank">
                    </div>

                    <div class="form-group">
                        <label for="nama_cabang">Nama Cabang</label>
                        <input type="text" class="form-control" id="nama_cabang" name="nama_cabang">
                    </div>

                    <div class="form-group">
                        <label for="nomor_rekening">Nomor Rekening</label>
                        <input type="text" class="form-control" id="nomor_rekening" name="nomor_rekening">
                    </div>

                    <div class="form-group">
                        <label for="nama_rekening">Nama Rekening</label>
                        <input type="text" class="form-control" id="nama_rekening" name="nama_rekening">
                    </div>

                    <div class="form-group">
                        <label for="telepon">Telepon</label>
                        <input type="text" class="form-control" id="telepon" name="telepon">
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <!-- Add any required scripts here -->
@endsection
