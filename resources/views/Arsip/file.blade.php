@extends('layouts.app')

@section('title', 'Edit File')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Lihat File</h1>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- Form to Edit Arsip -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit File</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('bendahara.store_sp2d') }}" method="post" enctype="multipart/form-data">

                    <!-- Form fields here -->
                    <form action="{{ route('bendahara.store_spp') }}" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="spp">Upload SPP:</label>
                            <input type="file" class="form-control-file" id="spp" name="spp" accept=".pdf, .doc, .docx" required>
                        </div>
                
                        <div class="form-group">
                            <label for="sptjmspp">Upload SPTJM SPP:</label>
                            <input type="file" class="form-control-file" id="sptjmspp" name="sptjmspp" accept=".pdf, .doc, .docx" required>
                        </div>
                
                        <div class="form-group">
                            <label for="verif_spp">Upload Verifikasi SPP:</label>
                            <input type="file" class="form-control-file" id="verif_spp" name="verif_spp" accept=".pdf, .doc, .docx" required>
                        </div>
                    </form>
                        <form action="{{ route('bendahara.store_spm') }}" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="spm">Upload SPM:</label>
                                <input type="file" class="form-control-file" id="spm" name="spm" accept=".pdf, .doc, .docx" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="sptjmspm">Upload SPTJM SPM:</label>
                                <input type="file" class="form-control-file" id="sptjmspm" name="sptjmspm" accept=".pdf, .doc, .docx" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="lampiran_sumber_dana">Upload Lampiran Sumber Dana:</label>
                                <input type="file" class="form-control-file" id="lampiran_sumber_dana" name="lampiran_sumber_dana" accept=".pdf, .doc, .docx" required>
                            </div>
                        </form>

                        <form action="{{ route('bendahara.store_sp2d') }}" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="sp2d">Upload SP2D:</label>
                        <input type="file" class="form-control-file" id="sp2d" name="sp2d" accept=".pdf, .doc, .docx" required>
                    </div>
                </form>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <!-- Add any required scripts here -->
@endsection
