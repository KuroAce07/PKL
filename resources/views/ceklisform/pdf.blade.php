{{-- <!DOCTYPE html>
<html>
<head>
    <title>PDF</title>
    <style>
        /* Define your PDF styling here */
        body {
            font-family: Arial, sans-serif;
        }
        /* Add more styling as needed */
    </style>
<h2>Hasil Ceklis Form</h2>
@foreach ($ceklisForms as $ceklisForm)
<table class="table">
    <thead>
        <tr>
            <th>Nama berkas</th>
                <th>Check</th>
            <!-- Add headers for other fields -->
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Kwitansi</td>
            <td class="{{ $ceklisForm->kwitansi ? 'text-success' : 'text-danger' }}">{{ $ceklisForm->kwitansi ? 'Ada' : 'Tidak Ada' }}</td>
        </tr>
        <tr>
            <td>Nota Bukti Invoice</td>
            <td class="{{ $ceklisForm->nota_bukti_invoice ? 'text-success' : 'text-danger' }}">{{ $ceklisForm->nota_bukti_invoice ? 'Ada' : 'Tidak Ada' }}</td>
        </tr>
        <tr>
            <td>Surat Pemesanan</td>
            <td class="{{ $ceklisForm->surat_pemesanan ? 'text-success' : 'text-danger' }}">{{ $ceklisForm->surat_pemesanan ? 'Ada' : 'Tidak Ada' }}</td>
        </tr>
        <tr>
            <td>Dokumen Kontrak</td>
            <td class="{{ $ceklisForm->dok_kontrak ? 'text-success' : 'text-danger' }}">{{ $ceklisForm->dok_kontrak ? 'Ada' : 'Tidak Ada' }}</td>
        </tr>
        <tr>
            <td>Surat Perjanjian</td>
            <td class="{{ $ceklisForm->surat_perjanjiann ? 'text-success' : 'text-danger' }}">{{ $ceklisForm->surat_perjanjiann ? 'Ada' : 'Tidak Ada' }}</td>
        </tr>
        <tr>
            <td>Dokumen E-Purchasing</td>
            <td class="{{ $ceklisForm->dok_epurchasing ? 'text-success' : 'text-danger' }}">{{ $ceklisForm->dok_epurchasing ? 'Ada' : 'Tidak Ada' }}</td>
        </tr>
        <tr>
            <td>Risalah/Ringkasan Kontrak</td>
            <td class="{{ $ceklisForm->ringkasan_kontrak ? 'text-success' : 'text-danger' }}">{{ $ceklisForm->ringkasan_kontrak ? 'Ada' : 'Tidak Ada' }}</td>
        </tr>
        <tr>
            <td>Dokumen Pendukung</td>
            <td class="{{ $ceklisForm->dok_pendukung ? 'text-success' : 'text-danger' }}">{{ $ceklisForm->dok_pendukung ? 'Ada' : 'Tidak Ada' }}</td>
        </tr>
        <tr>
            <td>Tabel Barang jika Komposisi TKDN < 40%</td>
            <td class="{{ $ceklisForm->tkdn ? 'text-success' : 'text-danger' }}">{{ $ceklisForm->tkdn ? 'Ada' : 'Tidak Ada' }}</td>
        </tr>
        <tr>
            <td>Berita Acara Serah Terima Hasil Pekerjaan</td>
            <td class="{{ $ceklisForm->berita_serah_terima ? 'text-success' : 'text-danger' }}">{{ $ceklisForm->berita_serah_terima ? 'Ada' : 'Tidak Ada' }}</td>
        </tr>
        <tr>
            <td>Berita Acara Pembayaran</td>
            <td class="{{ $ceklisForm->berita_pembayaran ? 'text-success' : 'text-danger' }}">{{ $ceklisForm->berita_pembayaran ? 'Ada' : 'Tidak Ada' }}</td>
        </tr>
        <tr>
            <td>Berita_pemeriksaan</td>
            <td class="{{ $ceklisForm->berita_pemeriksaan ? 'text-success' : 'text-danger' }}">{{ $ceklisForm->berita_pemeriksaan ? 'Ada' : 'Tidak Ada' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
<style>
.text-success {
color: green;
}

.text-danger {
color: red;
}
</style>
</html> --}}




<!DOCTYPE html>
<html>
<head>
    <title>PDF</title>
    <style>
        /* Define your PDF styling here */
        body {
            font-family: Arial, sans-serif;
        }
        /* Add more styling as needed */
        table {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid black; /* Add border to the table */
        }
        th, td {
            border: 1px solid black; /* Add border to table cells */
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Hasil Ceklis Form</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nama berkas</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ceklisForms as $ceklisForm)
                <tr>
                    <td>Kwitansi</td>
                    <td class="{{ $ceklisForm->kwitansi ? 'text-success' : 'text-danger' }}">{{ $ceklisForm->kwitansi ? 'Ada' : 'Tidak Ada' }}</td>
                </tr>
                <tr>
                    <td>Nota Bukti Invoice</td>
                    <td class="{{ $ceklisForm->nota_bukti_invoice ? 'text-success' : 'text-danger' }}">{{ $ceklisForm->nota_bukti_invoice ? 'Ada' : 'Tidak Ada' }}</td>
                </tr>
                <tr>
                    <td>Surat Pemesanan</td>
                    <td class="{{ $ceklisForm->surat_pemesanan ? 'text-success' : 'text-danger' }}">{{ $ceklisForm->surat_pemesanan ? 'Ada' : 'Tidak Ada' }}</td>
                </tr>
                <tr>
                    <td>Dokumen Kontrak</td>
                    <td class="{{ $ceklisForm->dok_kontrak ? 'text-success' : 'text-danger' }}">{{ $ceklisForm->dok_kontrak ? 'Ada' : 'Tidak Ada' }}</td>
                </tr>
                <tr>
                    <td>Surat Perjanjian</td>
                    <td class="{{ $ceklisForm->surat_perjanjiann ? 'text-success' : 'text-danger' }}">{{ $ceklisForm->surat_perjanjiann ? 'Ada' : 'Tidak Ada' }}</td>
                </tr>
                <tr>
                    <td>Dokumen E-Purchasing</td>
                    <td class="{{ $ceklisForm->dok_epurchasing ? 'text-success' : 'text-danger' }}">{{ $ceklisForm->dok_epurchasing ? 'Ada' : 'Tidak Ada' }}</td>
                </tr>
                <tr>
                    <td>Risalah/Ringkasan Kontrak</td>
                    <td class="{{ $ceklisForm->ringkasan_kontrak ? 'text-success' : 'text-danger' }}">{{ $ceklisForm->ringkasan_kontrak ? 'Ada' : 'Tidak Ada' }}</td>
                </tr>
                <tr>
                    <td>Dokumen Pendukung</td>
                    <td class="{{ $ceklisForm->dok_pendukung ? 'text-success' : 'text-danger' }}">{{ $ceklisForm->dok_pendukung ? 'Ada' : 'Tidak Ada' }}</td>
                </tr>
                <tr>
                    <td>Tabel Barang jika Komposisi TKDN < 40%</td>
                    <td class="{{ $ceklisForm->tkdn ? 'text-success' : 'text-danger' }}">{{ $ceklisForm->tkdn ? 'Ada' : 'Tidak Ada' }}</td>
                </tr>
                <tr>
                    <td>Berita Acara Serah Terima Hasil Pekerjaan</td>
                    <td class="{{ $ceklisForm->berita_serah_terima ? 'text-success' : 'text-danger' }}">{{ $ceklisForm->berita_serah_terima ? 'Ada' : 'Tidak Ada' }}</td>
                </tr>
                <tr>
                    <td>Berita Acara Pembayaran</td>
                    <td class="{{ $ceklisForm->berita_pembayaran ? 'text-success' : 'text-danger' }}">{{ $ceklisForm->berita_pembayaran ? 'Ada' : 'Tidak Ada' }}</td>
                </tr>
                <tr>
                    <td>Berita_pemeriksaan</td>
                    <td class="{{ $ceklisForm->berita_pemeriksaan ? 'text-success' : 'text-danger' }}">{{ $ceklisForm->berita_pemeriksaan ? 'Ada' : 'Tidak Ada' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
<style>
    .text-success {
    color: green;
    }
    
    .text-danger {
    color: red;
    }
    </style>
</html>
