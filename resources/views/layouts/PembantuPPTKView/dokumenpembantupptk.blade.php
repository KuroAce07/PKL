@extends('layouts.app')

@section('title', 'Dokumen Pembantu PPTK')

@section('content')
<div class="container-fluid">
    <h1>Dokumen Pembantu PPTK</h1>

    <!-- Dokumen Kontrak Menu -->
    <div class="card mb-3">
        <div class="card-header">
            Dokumen Kontrak Menu
        </div>
        <div class="card-body">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('PembantuPPTKView.dokumenkontrak.create') }}">
                        <i class="fas fa-file-alt"></i>
                        Tambah Dokumen Kontrak
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('PembantuPPTKView.dokumenkontrak.show', ['id' => 1]) }}">
                        <i class="fas fa-eye"></i>
                        View Dokumen Kontrak
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- E-Purchasing Menu -->
    <div class="card mb-3">
        <div class="card-header">
            E-Purchasing Menu
        </div>
        <div class="card-body">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('PembantuPPTKView.epurchaseview.create') }}">
                        <i class="fas fa-file-alt"></i>
                        Tambah E-Purchasing
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('PembantuPPTKView.epurchaseview.index') }}">
                        <i class="fas fa-eye"></i>
                        View E-Purchasing
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Dokumen Pendukung Menu -->
    <div class="card mb-3">
        <div class="card-header">
            Dokumen Pendukung Menu
        </div>
        <div class="card-body">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('PembantuPPTKView.dokumenpendukung.create') }}">
                        <i class="fas fa-file-alt"></i>
                        Tambah Dokumen Pendukung
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('PembantuPPTKView.dokumenpendukung.index', ['id' => 1]) }}">
                        <i class="fas fa-eye"></i>
                        View Dokumen Pendukung
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Dokumen Justifikasi Menu -->
    <div class="card mb-3">
        <div class="card-header">
            Dokumen Justifikasi Menu
        </div>
        <div class="card-body">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('PembantuPPTKView.dokumenjustifikasi.create') }}">
                        <i class="fas fa-file-alt"></i>
                        Tambah Dokumen Justifikasi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('PembantuPPTKView.dokumenjustifikasi.index', ['id' => 1]) }}">
                        <i class="fas fa-eye"></i>
                        View Dokumen Justifikasi
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Berita Acara Serah Terima Hasil Pekerjaan Menu -->
    <div class="card mb-3">
        <div class="card-header">
            Berita Acara Serah Terima Hasil Pekerjaan (BAST) Menu
        </div>
        <div class="card-body">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('PembantuPPTKView.bast.create') }}">
                        <i class="fas fa-file-alt"></i>
                        Tambah Dokumen BAST
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('PembantuPPTKView.bast.index', ['id' => 1]) }}">
                        <i class="fas fa-eye"></i>
                        View Dokumen BAST
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Berita Acara Pembayaran (BAP) Menu -->
    <div class="card mb-3">
        <div class="card-header">
            Berita Acara Pembayaran (BAP) Menu
        </div>
        <div class="card-body">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('PembantuPPTKView.bap.create') }}">
                        <i class="fas fa-file-alt"></i>
                        Tambah Dokumen BAP
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('PembantuPPTKView.bap.index') }}">
                        <i class="fas fa-eye"></i>
                        View Dokumen BAP
                    </a>
                </li>
            </ul>
        </div>
    </div>

        <!-- Dokumen BAPH Menu -->
        <div class="card mb-3">
        <div class="card-header">
            Dokumen Berita Acara Pemeriksaan Hasil Pekerjaan (BAPH) Menu
        </div>
        <div class="card-body">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('PembantuPPTKView.baph.create') }}">
                        <i class="fas fa-file-alt"></i>
                        Tambah Dokumen BAPH
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('PembantuPPTKView.baph.index', ['id' => 1]) }}">
                        <i class="fas fa-eye"></i>
                        View Dokumen BAPH
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Pilih Rekanan Menu -->
    <div class="card mb-3">
        <div class="card-header">
            Pilih Rekanan Menu
        </div>
        <div class="card-body">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('PembantuPPTKView.pilihrekanan.create') }}">
                        <i class="fas fa-file-alt"></i>
                        Tambah Pilihan Rekanan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('PembantuPPTKView.pilihrekanan.index') }}">
                        <i class="fas fa-eye"></i>
                        View Pilihan Rekanan
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
