@extends('layouts.app')

@section('title', 'Daftar Dokumen Kontrak')

@section('content')
    <div class="container">
        <h1 class="mt-4 mb-4" style="font-size: 24px;">Daftar Dokumen Kontrak</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">NO</th>
                    <th rowspan="2">URAIAN</th>
                    <th colspan="5">Jumlah Nilai Kontrak</th>
                    <th rowspan="2">Jasa Konsultan s/d 100 jt</th>
                </tr>
                <tr>
                    <th>0-10 jt</th>
                    <th>10 jt s/d 50 jt</th>
                    <th>50 jt s/d 200 jt</th>
                    <th>>= 200 jt</th>
                    <th>Jasa Konsultan s/d 100 jt</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Dokumen Kontrak</td>
                    <td>Kwitansi</td>
                    <td>Nota/Bukti Pembelian/invoice</td>
                    <td>Surat Pemesanan</td>
                    <td>Dokumen Kontrak (SPK)</td>
                    <td>Surat Perjanjian</td>
                    <td></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Dokumen e purchasing</td>
                    <td colspan="6"></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Risalah/ Ringkasan Kontrak</td>
                    <td colspan="6"></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Dokumen Pendukung (Foto/ Notulen, Laporan dll)</td>
                    <td colspan="6"></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Tabel Identifikasi Barang jika komposisi TKDN < 40% (JUSTIFIKASI)</td>
                    <td colspan="6"></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Berita Acara Serah Terima Hasil Pekerjaan</td>
                    <td colspan="6"></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Berita Acara Pembayaran</td>
                    <td colspan="6"></td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Berita Acara Pemeriksaan Hasil Pekerjaan</td>
                    <td colspan="6"></td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>NPWP</td>
                    <td colspan="6"></td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>Buku Rekening Bank</td>
                    <td colspan="6"></td>
                </tr>
                <tr>
                    <td>11</td>
                    <td>NIB</td>
                    <td colspan="6"></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <!-- JavaScript code if needed -->
@endsection
