@extends('layouts.app')

@section('title', 'Edit Arsip')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Dokumen</h1>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- Form to Edit Arsip -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Dokumen</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('Arsip.update', $arsip->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <!-- Form fields here -->
                    <div class="form-group">
                        <label for="no_spm">No SPM</label>
                        <input type="text" class="form-control" id="no_spm" name="no_spm" value="{{ $arsip->no_spm }}" required>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_spm">Tanggal SPM</label>
                        <input type="date" class="form-control" id="tanggal_spm" name="tanggal_spm" value="{{ $arsip->tanggal_spm }}" required>
                    </div>

                    <div class="form-group">
                        <label for="nilai_spm">Nilai SPM</label>
                        <input type="text" class="form-control" id="nilai_spm" name="nilai_spm" value="{{ $arsip->nilai_spm }}">
                    </div>

                    <div class="form-group">
                        <label for="sumber_dana">Sumber Dana</label>
                        <input type="text" class="form-control" id="sumber_dana" name="sumber_dana" value="{{ $arsip->sumber_dana }}">
                    </div>

                    <div class="form-group">
                        <label for="uraian_belanja">Uraian Belanja</label>
                        <input type="text" class="form-control" id="uraian_belanja" name="uraian_belanja" value="{{ $arsip->uraian_belanja }}">
                    </div>

                    <div class="form-group">
                        <label for="sub_kegiatan">Sub Kegiatan</label>
                        <input type="text" class="form-control" id="sub_kegiatan" name="sub_kegiatan" value="{{ $arsip->sub_kegiatan }}">
                    </div>

                    <div class="form-group">
                        <label for="nama_sub_kegiatan">Kegiatan</label>
                        <input type="text" class="form-control" id="nama_sub_kegiatan" name="nama_sub_kegiatan" value="{{ $arsip->nama_sub_kegiatan }}">
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $arsip->nama }}">
                    </div>

                    <div class="form-group">
                        <label for="pph_21">PPH 21</label>
                        <input type="text" class="form-control" id="pph_21" name="pph_21" value="{{ $arsip->pph_21 }}">
                    </div>

                    <div class="form-group">
                        <label for="pph_22">PPH 22</label>
                        <input type="text" class="form-control" id="pph_22" name="pph_22" value="{{ $arsip->pph_22 }}">
                    </div>

                    <div class="form-group">
                        <label for="pph_23">PPH 23</label>
                        <input type="text" class="form-control" id="pph_23" name="pph_23" value="{{ $arsip->pph_23 }}">
                    </div>

                    <div class="form-group">
                        <label for="ppn">PPN</label>
                        <input type="text" class="form-control" id="ppn" name="ppn" value="{{ $arsip->ppn }}">
                    </div>

                    <div class="form-group">
                        <label for="ppnd">PPND</label>
                        <input type="text" class="form-control" id="ppnd" name="ppnd" value="{{ $arsip->ppnd }}">
                    </div>

                    <div class="form-group">
                        <label for="lain_lain">Lain Lain</label>
                        <input type="text" class="form-control" id="lain_lain" name="lain_lain" value="{{ $arsip->lain_lain }}">
                    </div>

                    <div class="form-group">
                        <label for="tanggal_sp2d">Tanggal SP2D</label>
                        <input type="date" class="form-control" id="tanggal_sp2d" name="tanggal_sp2d" value="{{ $arsip->tanggal_sp2d }}">
                    </div>

                    <div class="form-group">
                        <label for="no_sp2d">No SP2D</label>
                        <input type="text" class="form-control" id="no_sp2d" name="no_sp2d" value="{{ $arsip->no_sp2d }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <!-- Add any required scripts here -->
@endsection
