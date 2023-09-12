@extends('layouts.app')

@section('title', 'Dokumen Pembantu PPTK')

@section('content')
<div class="container-fluid">
    <h1>Dokumen Pembantu PPTK</h1>

    <div class="card mb-3">
        <div class="card-header">
            Dokumen Pembantu Menu
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Uraian</th>
                    <th colspan="5">Action</th>
                    <th rowspan="2">Status</th>
                </tr>
                <tr>
                    @hasrole('Pembantu PPTK')
                    <th>Create Dokumen</th>
                    @endhasrole
                    <th>View Dokumen</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Dokumen Kwitansi</td>
                        @hasrole('Pembantu PPTK')
                        <td><a class="btn btn-primary btn-block" href="{{ route('PembantuPPTKView.dokumenkontrak.create', ['dpaId' => request()->query('dpaId')]) }}"> Tambah Dokumen Kwitansi </a></td>
                        @endhasrole
                        <td><a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.dokumenkontrak.show', ['dpaId' => request()->query('dpaId')]) }}"> View Dokumen Kwitansi </a></td>
                        <td colspan="7">
                        @if($dokumenKontrak)
                        <span style="color: green;">Selesai</span>
                        @else
                            <span style="color: red;">Belum</span>
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Nota/Bukti Pembelian/Invoice</td>
                        @hasrole('Pembantu PPTK')
                        <td><a class="btn btn-primary btn-block" href="{{ route('PembantuPPTKView.bukti.create', ['dpaId' => request()->query('dpaId')]) }}"> Tambah Dokumen Nota/Bukti Pembelian/Invoice </a></td>
                        @endhasrole
                        <td><a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.bukti.index', ['dpaId' => request()->query('dpaId')]) }}"> View Dokumen Nota/Bukti Pembelian/Invoice </a></td>
                        <td colspan="7">
                        @if($buktis)
                        <span style="color: green;">Selesai</span>
                        @else
                            <span style="color: red;">Belum</span>
                        @endif
                        </td>
                    </tr>

                    <tr>
                        <td>3</td>
                        <td>Surat Pemesanan</td>
                        @hasrole('Pembantu PPTK')
                        <td><a class="btn btn-primary btn-block" href="{{ route('PembantuPPTKView.surat.create', ['dpaId' => request()->query('dpaId')]) }}"> Tambah Dokumen Surat Pemesanan </a></td>
                        @endhasrole
                        <td><a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.surat.index', ['dpaId' => request()->query('dpaId')]) }}"> View Dokumen Surat Pemesanan </a></td>
                        <td colspan="7">
                        @if($surats)
                        <span style="color: green;">Selesai</span>
                        @else
                            <span style="color: red;">Belum</span>
                        @endif
                        </td>
                    </tr>

                    <tr>
                        <td>4</td>
                        <td>Dokumen Kontrak (SPK)</td>
                        @hasrole('Pembantu PPTK')
                        <td><a class="btn btn-primary btn-block" href="{{ route('PembantuPPTKView.dokumenkontrakspk.create', ['dpaId' => request()->query('dpaId')]) }}"> Tambah Dokumen Dokumen Kontrak (SPK) </a></td>
                        @endhasrole
                        <td><a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.dokumenkontrakspk.index', ['dpaId' => request()->query('dpaId')]) }}"> View Dokumen Dokumen Kontrak (SPK) </a></td>
                        <td colspan="7">
                        @if($dokumenKontrakSPK)
                        <span style="color: green;">Selesai</span>
                        @else
                            <span style="color: red;">Belum</span>
                        @endif
                        </td>
                    </tr>

                    <tr>
                        <td>5</td>
                        <td>Surat Perjanjian</td>
                        @hasrole('Pembantu PPTK')
                        <td><a class="btn btn-primary btn-block" href="{{ route('PembantuPPTKView.suratperjanjian.create', ['dpaId' => request()->query('dpaId')]) }}"> Tambah Dokumen Surat Perjanjian </a></td>
                        @endhasrole
                        <td><a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.suratperjanjian.index', ['dpaId' => request()->query('dpaId')]) }}"> View Dokumen Surat Perjanjian </a></td>
                        <td colspan="7">
                        @if($suratperjanjians)
                        <span style="color: green;">Selesai</span>
                        @else
                            <span style="color: red;">Belum</span>
                        @endif
                        </td>
                    </tr>

                    <tr>
                        <td>6</td>
                        <td>Risalah Kontrak</td>
                        @hasrole('Pembantu PPTK')
                        <td><a class="btn btn-primary btn-block" href="{{ route('PembantuPPTKView.risalahkontrak.create', ['dpaId' => request()->query('dpaId')]) }}"> Tambah Dokumen Risalah Kontrak </a></td>
                        @endhasrole
                        <td><a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.risalahkontrak.index', ['dpaId' => request()->query('dpaId')]) }}"> View Dokumen Risalah Kontrak </a></td>
                        <td colspan="7">
                        @if($risalahkontrak)
                        <span style="color: green;">Selesai</span>
                        @else
                            <span style="color: red;">Belum</span>
                        @endif
                        </td>
                    </tr>

                    <tr>
                        <td>7</td>
                        <td>Dokumen E-Purchasing</td>
                        @hasrole('Pembantu PPTK')
                        <td><a class="btn btn-primary btn-block" href="{{ route('PembantuPPTKView.epurchaseview.create', ['dpaId' => request()->query('dpaId')]) }}"> Tambah E-Purchasing </td>
                        @endhasrole
                        <td><a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.epurchaseview.index', ['dpaId' => request()->query('dpaId')]) }}"> View E-Purchasing</td>
                        <td colspan="7">
                            @if($dokumenEpurchasing)
                            <span style="color: green;">Selesai</span>
                        @else
                            <span style="color: red;">Belum</span>
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Dokumen Pendukung</td>
                        @hasrole('Pembantu PPTK')
                        <td><a class="btn btn-primary btn-block" href="{{ route('PembantuPPTKView.dokumenpendukung.create', ['dpaId' => request()->query('dpaId')]) }}"> Tambah Dokumen Pendukung </td>
                        @endhasrole
                        <td><a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.dokumenpendukung.index', ['dpaId' => request()->query('dpaId')]) }}"> View Dokumen Pendukung </td>
                        <td colspan="7">
                            @if($dokumenPendukung)
                            <span style="color: green;">Selesai</span>
                            @else
                                <span style="color: red;">Belum</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Dokumen Justifikasi</td>
                        @hasrole('Pembantu PPTK')
                        <td><a class="btn btn-primary btn-block" href="{{ route('PembantuPPTKView.dokumenjustifikasi.create', ['dpaId' => request()->query('dpaId')]) }}"> Tambah Dokumen Justifikasi </td>
                        @endhasrole
                        <td><a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.dokumenjustifikasi.index', ['dpaId' => request()->query('dpaId')]) }}"> View Dokumen Justifikasi </td>
                        <td colspan="7">
                            @if($dokumenjustifikasi)
                            <span style="color: green;">Selesai</span>
                            @else
                                <span style="color: red;">Belum</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>Berita Acara Serah Terima Hasil Pekerjaan (BAST) </td>
                        @hasrole('Pembantu PPTK')
                        <td><a class="btn btn-primary btn-block" href="{{ route('PembantuPPTKView.bast.create', ['dpaId' => request()->query('dpaId')]) }}"> Tambah Dokumen BAST</td>
                        @endhasrole
                        <td><a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.bast.index', ['dpaId' => request()->query('dpaId')]) }}"> View Dokumen BAST </td>
                        <td colspan="7">
                            @if($bast)
                            <span style="color: green;">Selesai</span>
                            @else
                                <span style="color: red;">Belum</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>Berita Acara Pembayaran (BAP)</td>
                        @hasrole('Pembantu PPTK')
                        <td><a class="btn btn-primary btn-block" href="{{ route('PembantuPPTKView.bap.create', ['dpaId' => request()->query('dpaId')]) }}"> Tambah Dokumen BAP </a></td>
                        @endhasrole
                        <td><a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.bap.index', ['dpaId' => request()->query('dpaId')]) }}"> View Dokumen BAP </a></td>
                        <td colspan="7">
                            @if($bap)
                            <span style="color: green;">Selesai</span>
                            @else
                                <span style="color: red;">Belum</span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>12</td>
                        <td>Berita Acara Pemeriksaan Hasil Pekerjaan (BAPH)</td>
                        @hasrole('Pembantu PPTK')
                        <td><a class="btn btn-primary btn-block" href="{{ route('PembantuPPTKView.baph.create', ['dpaId' => request()->query('dpaId')]) }}"> Tambah Dokumen BAPH </td>
                        @endhasrole
                        <td><a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.baph.index', ['dpaId' => request()->query('dpaId')]) }}"> View Dokumen BAPH </td>
                        <td colspan="7">
                            @if($baph)
                            <span style="color: green;">Selesai</span>
                            @else
                                <span style="color: red;">Belum</span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>13</td>
                        <td>NPWP</td>
                        @hasrole('Pembantu PPTK')
                        <td><a class="btn btn-primary btn-block" href="{{ route('PembantuPPTKView.npwp.create', ['dpaId' => request()->query('dpaId')]) }}"> Tambah Dokumen NPWP </td>
                        @endhasrole
                        <td><a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.npwp.index', ['dpaId' => request()->query('dpaId')]) }}"> View Dokumen NPWP </td>
                        <td colspan="7">
                            @if($npwp)
                            <span style="color: green;">Selesai</span>
                            @else
                                <span style="color: red;">Belum</span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>14</td>
                        <td>Buku Rekening Bank</td>
                        @hasrole('Pembantu PPTK')
                        <td><a class="btn btn-primary btn-block" href="{{ route('PembantuPPTKView.buku.create', ['dpaId' => request()->query('dpaId')]) }}"> Tambah Dokumen Buku Rekening Bank </td>
                        @endhasrole
                        <td><a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.buku.index', ['dpaId' => request()->query('dpaId')]) }}"> View Dokumen Buku Rekening Bank </td>
                        <td colspan="7">
                            @if($buku)
                            <span style="color: green;">Selesai</span>
                            @else
                                <span style="color: red;">Belum</span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>15</td>
                        <td>NIB</td>
                        @hasrole('Pembantu PPTK')
                        <td><a class="btn btn-primary btn-block" href="{{ route('PembantuPPTKView.nib.create', ['dpaId' => request()->query('dpaId')]) }}"> Tambah Dokumen NIB </td>
                        @endhasrole
                        <td><a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.nib.index', ['dpaId' => request()->query('dpaId')]) }}"> View Dokumen NIB </td>
                        <td colspan="7">
                            @if($nib)
                            <span style="color: green;">Selesai</span>
                            @else
                                <span style="color: red;">Belum</span>
                            @endif
                        </td>
                    </tr>
                    <!-- Repeat rows for other submenus -->
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection




