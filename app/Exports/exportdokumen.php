<?php

namespace App\Exports;

use App\Models\DPA;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class exportdokumen implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DPA::select(
            'id as Nomor',
            'id_dpa as ID DPA',
            'tahun as Tahun',
            'daerah as Daerah',
            'kode_urusan as Kode Urusan',
            'nama_urusan as Nama Urusan',
            'kode_bidang_urusan as Kode Bidang Urusan',
            'nama_bidang_urusan as Nama Bidang Urusan',
            'kode_skpd as Kode SKPD',
            'nama_skpd as Nama SKPD',
            'kode_sub_skpd as Kode Sub SKPD',
            'nama_sub_skpd as Nama Sub SKPD',
            'kode_program as Kode Program',
            'nama_program as Nama Program',
            'kode_kegiatan as Kode Kegiatan',
            'nama_kegiatan as Nama Kegiatan',
            'kode_sub_kegiatan as Kode Sub Kegiatan',
            'nama_sub_kegiatan as Nama Sub Kegiatan',
            'kode_akun as Kode Akun',
            'nama_akun as Nama Akun',
            'sumber_dana as Sumber Dana',
            'nilai_rincian as Nilai Rincian',
            'total_rak as Total Rincian Anggaran Kegiatan',
            'bulan_1 as Bulan 1',
            'bulan_2 as Bulan 2',
            'bulan_3 as Bulan 3',
            'bulan_4 as Bulan 4',
            'bulan_5 as Bulan 5',
            'bulan_6 as Bulan 6',
            'bulan_7 as Bulan 7',
            'bulan_8 as Bulan 8',
            'bulan_9 as Bulan 9',
            'bulan_10 as Bulan 10',
            'bulan_11 as Bulan 11',
            'bulan_12 as Bulan 12',
            'tipe as Tipe Dokumen'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Nomor',
            'ID DPA',
            'Tahun',
            'Daerah',
            'Kode Urusan',
            'Nama Urusan',
            'Kode Bidang Urusan',
            'Nama Bidang Urusan',
            'Kode SKPD',
            'Nama SKPD',
            'Kode Sub SKPD',
            'Nama Sub SKPD',
            'Kode Program',
            'Nama Program',
            'Kode Kegiatan',
            'Nama Kegiatan',
            'Kode Sub Kegiatan',
            'Nama Sub Kegiatan',
            'Kode Akun',
            'Nama Akun',
            'Sumber Dana',
            'Nilai Rincian',
            'Total Rincian Anggaran Kegiatan',
            'Bulan 1',
            'Bulan 2',
            'Bulan 3',
            'Bulan 4',
            'Bulan 5',
            'Bulan 6',
            'Bulan 7',
            'Bulan 8',
            'Bulan 9',
            'Bulan 10',
            'Bulan 11',
            'Bulan 12',
            'Tipe Dokumen',
        ];
    }
}
