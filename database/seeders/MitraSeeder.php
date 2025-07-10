<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mitra;
use PhpOffice\PhpSpreadsheet\IOFactory;

class MitraSeeder extends Seeder
{
    public function run(): void
    {
        $filePath = storage_path('app/public/data_mitra.xlsx');

        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        foreach (array_slice($rows, 2) as $row) { 
            if (empty($row[1])) continue; 

            Mitra::updateOrCreate(
                ['nama_mitra' => $row[1]],
                [
                    'no_khs_mitra'    => $row[2] ?? null,
                    'amd_khs_mitra_1' => $row[3] ?? null,
                    'amd_khs_mitra_2' => $row[4] ?? null,
                    'direktur_mitra'  => $row[5] ?? null,
                    'jabatan_mitra'   => $row[6] ?? null,
                    'alamat_kantor'   => $row[7] ?? null,
                    'amd_khs_mitra_3' => $row[8] ?? null,
                    'amd_khs_mitra_4' => $row[9] ?? null,
                    'amd_khs_mitra_5' => $row[10] ?? null,
                ]
            );
            
        }
    }
}
