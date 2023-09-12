<?php
// app/Imports/ArsipLamaImport.php

namespace App\Imports;
use Carbon\Carbon;
use App\Models\ArsipLama;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ArsipLamaImport implements ToCollection
{
    private $importCounter = 1; // Initialize the counter

    public function collection(Collection $rows)
    {
        // Skip the first row (header)
        $dataRows = $rows->slice(1)->map(function ($row) {
            return array_slice($row->toArray(), 1); // Exclude the first column
        });
        
        foreach ($dataRows as $row)
        {
            // Check if the row has all required values (assuming it starts from index 0)
            if (count($row) < 17) {
                continue;
            }
    
            ArsipLama::create([
                'no_spm' => (string) $row[0],
                'tanggal_spm' => is_numeric($row[1]) ? Date::excelToDateTimeObject($row[1])->format('Y-m-d') : null,
                'nilai_spm' => (string) $row[2],
                'terbilang' => (string) $row[3],
                'sumber_dana' => (string) $row[4],
                'uraian_belanja' => (string) $row[5],
                'sub_kegiatan' => (string) $row[6],
                'nama_sub_kegiatan' => (string) $row[7],
                'nama' => (string) $row[8],
                'pph_21' => (string) $row[9],
                'pph_22' => (string) $row[10],
                'pph_23' => (string) $row[11],
                'ppn' => (string) $row[12],
                'ppnd' => (string) $row[13],
                'lain_lain' => (string) $row[14],
                'tanggal_sp2d' => (string) $row[15],
                'no_sp2d' => (string) $row[16],
                'tipe' => 'import' . $this->importCounter++, // Increment the counter
            ]);
        }
    }
}
