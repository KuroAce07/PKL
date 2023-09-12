<?php

namespace App\Exports;

use App\Models\ArsipLama;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class exportdokumenpencairan implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ArsipLama::all();
    }

    /**
     * Specify the headers for the Excel export.
     *
     * @return array
     */
    public function headings(): array
    {
        // Define your headers here
        return [
            'ID',
            'Nomor SPM',
            'Tanggal SPM',
            'Nilai Rincian',
            'Terbilang',
            'Sumber Dana',
            'Uraian Belanja',
            'Sub Kegiatan',
            'Kegiatan',
            'Nama',
            'pph 21',
            'pph 22',
            'pph 23',
            'ppn',
            'ppnd',
            'lain-lain',
            'Tanggal SP2D',
            'Nomor SP2D',
            'Created By',
            'Updated By',
        ];
    }
}
