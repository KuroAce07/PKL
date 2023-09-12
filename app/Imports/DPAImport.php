<?php
// app/Imports/DPAImport.php

namespace App\Imports;

use App\Models\DPA;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class DPAImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        // Skip the first row (header)
        $dataRows = $rows->slice(1);

        
        foreach ($dataRows as $row)
        {
            // Check if the row has all required values
            if (count($row) < 30) {
                continue;
            }

            $duplicate = DPA::where([
                'tahun' => $row[0],
                'daerah' => $row[1],
                'kode_urusan' => $row[2],
                'nama_urusan' => $row[3],
                'kode_bidang_urusan' => $row[4],
                'nama_bidang_urusan' => $row[5],
                'kode_skpd' => $row[6],
                'nama_skpd' => $row[7],
                'kode_sub_skpd' => $row[8],
                'nama_sub_skpd' => $row[9],
                'kode_program' => $row[10],
                'nama_program' => $row[11],
                'kode_kegiatan' => $row[12],
                'nama_kegiatan' => $row[13],
                'kode_sub_kegiatan' => $row[14],
                'nama_sub_kegiatan' => $row[15],
                'kode_akun' => $row[16],
                'nama_akun' => $row[17],
            ])->first();
            if ($duplicate) {
            DPA::create([        
                'id_dpa' => $duplicate->id_dpa,        
                'tahun' => $row[0],
                'daerah' => $row[1],
                'kode_urusan' => $row[2],
                'nama_urusan' => $row[3],
                'kode_bidang_urusan' => $row[4],
                'nama_bidang_urusan' => $row[5],
                'kode_skpd' => $row[6],
                'nama_skpd' => $row[7],
                'kode_sub_skpd' => $row[8],
                'nama_sub_skpd' => $row[9],
                'kode_program' => $row[10],
                'nama_program' => $row[11],
                'kode_kegiatan' => $row[12],
                'nama_kegiatan' => $row[13],
                'kode_sub_kegiatan' => $row[14],
                'nama_sub_kegiatan' => $row[15],
                'kode_akun' => $row[16],
                'nama_akun' => $row[17],
                'nilai_rincian' => $row[18],
                'total_rak' => $row[19],
                'bulan_1' => $row[20],
                'bulan_2' => $row[21],
                'bulan_3' => $row[22],
                'bulan_4' => $row[23],
                'bulan_5' => $row[24],
                'bulan_6' => $row[25],
                'bulan_7' => $row[26],
                'bulan_8' => $row[27],
                'bulan_9' => $row[28],
                'bulan_10' => $row[29],
                'bulan_11' => $row[30],
                'bulan_12' => $row[31],
                'tipe' => "DPPA",
            ]);
        }
        else{
            $newDpa = new DPA([
                'tahun' => $row[0],
                'daerah' => $row[1],
                'kode_urusan' => $row[2],
                'nama_urusan' => $row[3],
                'kode_bidang_urusan' => $row[4],
                'nama_bidang_urusan' => $row[5],
                'kode_skpd' => $row[6],
                'nama_skpd' => $row[7],
                'kode_sub_skpd' => $row[8],
                'nama_sub_skpd' => $row[9],
                'kode_program' => $row[10],
                'nama_program' => $row[11],
                'kode_kegiatan' => $row[12],
                'nama_kegiatan' => $row[13],
                'kode_sub_kegiatan' => $row[14],
                'nama_sub_kegiatan' => $row[15],
                'kode_akun' => $row[16],
                'nama_akun' => $row[17],
                'nilai_rincian' => $row[18],
                'total_rak' => $row[19],
                'bulan_1' => $row[20],
                'bulan_2' => $row[21],
                'bulan_3' => $row[22],
                'bulan_4' => $row[23],
                'bulan_5' => $row[24],
                'bulan_6' => $row[25],
                'bulan_7' => $row[26],
                'bulan_8' => $row[27],
                'bulan_9' => $row[28],
                'bulan_10' => $row[29],
                'bulan_11' => $row[30],
                'bulan_12' => $row[31],
                'tipe' => "DPA",
        ]);
        $newDpa->save();
                // Update the created record with the generated id
                $newDpa->update([
                    'id_dpa' => $newDpa->id,
                ]);
        }
        }
    }
}
