@extends('layouts.app')

@section('title', 'Add New Arsip')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dokumen Keuangan</h1>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- Form to Add New Arsip -->
        <div class="card shadow mb-4">
        <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambahkan Dokumen Baru</h6>
                </div>
                <div class="card-body">
                <form action="{{ route('Arsip.store') }}" method="POST">
                    @csrf

                    <!-- Form fields here -->
                    <div class="form-group">
                        <label for="no_spm">No SPM</label>
                        <input type="text" class="form-control" id="no_spm" name="no_spm" required>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_spm">Tanggal SPM</label>
                        <input type="date" class="form-control" id="tanggal_spm" name="tanggal_spm" required>
                    </div>

                    <div class="form-group">
                        <label for="nilai_spm">Nilai SPM</label>
                        <input type="text" class="form-control" id="nilai_spm" name="nilai_spm">
                    </div>

                    <div class="form-group">
                        <label for="sumber_dana">Sumber Dana</label>
                        <input type="text" class="form-control" id="sumber_dana" name="sumber_dana">
                    </div>

                    <div class="form-group">
                        <label for="uraian_belanja">Uraian Belanja</label>
                        <input type="text" class="form-control" id="uraian_belanja" name="uraian_belanja">
                    </div>

                    <div class="form-group">
                        <label for="sub_kegiatan">Sub Kegiatan</label>
                        <input type="text" class="form-control" id="sub_kegiatan" name="sub_kegiatan">
                    </div>

                    <div class="form-group">
                        <label for="nama_sub_kegiatan">Kegiatan</label>
                        <input type="text" class="form-control" id="nama_sub_kegiatan" name="nama_sub_kegiatan">
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>

                    <div class="form-group">
                        <label for="pph_21">PPH 21</label>
                        <input type="text" class="form-control" id="pph_21" name="pph_21">
                    </div>

                    <div class="form-group">
                        <label for="pph_22">PPH 22</label>
                        <input type="text" class="form-control" id="pph_22" name="pph_22">
                    </div>

                    <div class="form-group">
                        <label for="pph_23">PPH 23</label>
                        <input type="text" class="form-control" id="pph_23" name="pph_23">
                    </div>

                    <div class="form-group">
                        <label for="ppn">PPN</label>
                        <input type="text" class="form-control" id="ppn" name="ppn">
                    </div>

                    <div class="form-group">
                        <label for="ppnd">PPND</label>
                        <input type="text" class="form-control" id="ppnd" name="ppnd">
                    </div>

                    <div class="form-group">
                        <label for="lain_lain">Lain Lain</label>
                        <input type="text" class="form-control" id="lain_lain" name="lain_lain">
                    </div>

                    <div class="form-group">
                        <label for="tanggal_sp2d">Tanggal SP2D</label>
                        <input type="date" class="form-control" id="tanggal_sp2d" name="tanggal_sp2d">
                    </div>

                    <div class="form-group">
                        <label for="no_sp2d">No SP2D</label>
                        <input type="text" class="form-control" id="no_sp2d" name="no_sp2d">
                    </div>

                    <!-- Add more fields as needed -->

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <!-- Add any required scripts here -->
@endsection
