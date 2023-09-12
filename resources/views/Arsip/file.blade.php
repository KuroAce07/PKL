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
                <form action="{{ route('Arsip.storefile', ['id' => $arsip->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <!-- Form fields here -->
                    <div class="form-group">
                        <label for="spp">Upload SPP:</label>
                        <input type="file" class="form-control-file" id="spp" name="spp" accept=".pdf, .doc, .docx" >
                        <p>
                            @if ($indicators['spp'] === null)
                                Belum Terisi
                            @else
                                <a href="{{ asset('uploads/' . $indicators['spp']) }}" class="btn btn-primary" target="_blank">View PDF</a>
                            @endif
                        </p>
                    </div>
                
                    <div class="form-group">
                        <label for="sptjmspp">Upload SPTJM SPP:</label>
                        <input type="file" class="form-control-file" id="sptjmspp" name="sptjmspp" accept=".pdf, .doc, .docx" >
                        <p>
                            @if ($indicators['sptjmspp'] === null)
                                Belum Terisi
                            @else
                                <a href="{{ asset('uploads/' . $indicators['sptjmspp']) }}" class="btn btn-primary" target="_blank">View PDF</a>
                            @endif
                        </p>
                    </div>
                
                    <div class="form-group">
                        <label for="verif_spp">Upload Verifikasi SPP:</label>
                        <input type="file" class="form-control-file" id="verif_spp" name="verif_spp" accept=".pdf, .doc, .docx" >
                        <p>
                            @if ($indicators['verif_spp'] === null)
                                Belum Terisi
                            @else
                                <a href="{{ asset('uploads/' . $indicators['verif_spp']) }}" class="btn btn-primary" target="_blank">View PDF</a>
                            @endif
                        </p>
                    </div>

                    <!-- Repeat the following code for other file upload fields -->
                    
                    <div class="form-group">
                        <label for="spm">Upload SPM:</label>
                        <input type="file" class="form-control-file" id="spm" name="spm" accept=".pdf, .doc, .docx" >
                        <p>
                            @if ($indicators['spm'] === null)
                                Belum Terisi
                            @else
                                <a href="{{ asset('uploads/' . $indicators['spm']) }}" class="btn btn-primary" target="_blank">View PDF</a>
                            @endif
                        </p>
                    </div>
                    
                    <div class="form-group">
                        <label for="sptjmspm">Upload SPTJM SPM:</label>
                        <input type="file" class="form-control-file" id="sptjmspm" name="sptjmspm" accept=".pdf, .doc, .docx" >
                        <p>
                            @if ($indicators['sptjmspm'] === null)
                                Belum Terisi
                            @else
                                <a href="{{ asset('uploads/' . $indicators['sptjmspm']) }}" class="btn btn-primary" target="_blank">View PDF</a>
                            @endif
                        </p>
                    </div>
                    
                    <div class="form-group">
                        <label for="lampiran_sumber_dana">Upload Lampiran Sumber Dana:</label>
                        <input type="file" class="form-control-file" id="lampiran_sumber_dana" name="lampiran_sumber_dana" accept=".pdf, .doc, .docx" >
                        <p>
                            @if ($indicators['lampiran_sumber_dana'] === null)
                                Belum Terisi
                            @else
                                <a href="{{ asset('uploads/' . $indicators['lampiran_sumber_dana']) }}" class="btn btn-primary" target="_blank">View PDF</a>
                            @endif
                        </p>
                    </div>

                    <div class="form-group">
                        <label for="sp2d">Upload SP2D:</label>
                        <input type="file" class="form-control-file" id="sp2d" name="sp2d" accept=".pdf, .doc, .docx" >
                        <p>
                            @if ($indicators['sp2d'] === null)
                                Belum Terisi
                            @else
                                <a href="{{ asset('uploads/' . $indicators['sp2d']) }}" class="btn btn-primary" target="_blank">View PDF</a>
                            @endif
                        </p>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <!-- Add any required scripts here -->
@endsection
