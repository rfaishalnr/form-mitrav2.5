<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PejabatHistory;
use Carbon\Carbon;

class PejabatHistorySeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Ahmad Hunen',
                'posisi' => 'Pejabat TA',
                'jabatan' => 'GM Area Cirebon & Tasikmalaya',
                'kategori' => 'GM Cirebon',
                'awal' => '2022-05-12',
                'akhir' => '2024-07-31',
            ],
            [
                'nama' => 'Henry Soedidarma',
                'posisi' => 'Pejabat TA',
                'jabatan' => 'GM Area Cirebon & Tasikmalaya',
                'kategori' => 'GM Cirebon',
                'awal' => '2024-08-01',
                'akhir' => '2025-02-28',
            ],
            [
                'nama' => 'Haris Setyawan',
                'nik' => '740288',
                'posisi' => 'Pejabat TA',
                'jabatan' => 'GM Area Cirebon',
                'kategori' => 'GM Cirebon',
                'awal' => '2025-03-01',
                'akhir' => null,
            ],
            // Manager Operation
            [
                'nama' => 'Henry Ariawan Suhardi',
                'posisi' => 'Manager Area',
                'jabatan' => 'Mgr. Wilayah Cirebon & Tasikmalaya',
                'kategori' => 'Manager Operation',
                'awal' => '2024-01-05',
                'akhir' => '2024-10-31',
            ],
            [
                'nama' => 'M. Chusnul Yaqin',
                'nik' => '885759',
                'posisi' => 'Manager Area',
                'jabatan' => 'POH Mgr Wilayah Cirebon & Tasikmalaya',
                'kategori' => 'Manager Operation',
                'awal' => '2024-11-01',
                'akhir' => '2024-12-31',
            ],
            [
                'nama' => 'Eka Gama Putra',
                'posisi' => 'Manager Area',
                'jabatan' => 'Mgr. Wilayah Cirebon & Tasikmalaya',
                'kategori' => 'Manager Operation',
                'awal' => '2025-01-01',
                'akhir' => '2025-02-28',
            ],
            [
                'nama' => 'Bayu Tomi Dewantara',
                'nik' => '896017',
                'posisi' => 'Manager Area',
                'jabatan' => 'Mgr. Wilayah Cirebon',
                'kategori' => 'Manager Operation',
                'awal' => '2025-03-01',
                'akhir' => null,
            ],
            // Manager Konstruksi Cirebon
            [
                'nama' => 'Nurindriyan Bintang Pamungkas',
                'posisi' => 'Manager Area',
                'jabatan' => 'POH Mgr. Construction TA Cirebon Tasikmalaya',
                'kategori' => 'Manager Konstruksi Cirebon',
                'awal' => '2024-01-06',
                'akhir' => '2024-12-01',
            ],
            [
                'nama' => 'Azmy Farhan',
                'posisi' => 'Manager Area',
                'jabatan' => 'POH Mgr. Construction TA Cirebon Tasikmalaya',
                'kategori' => 'Manager Konstruksi Cirebon',
                'awal' => '2024-12-02',
                'akhir' => '2025-02-28',
            ],
        ];

        foreach ($data as $item) {
            PejabatHistory::create([
                'kategori' => $item['kategori'],
                'nama' => $item['nama'],
                'jabatan' => $item['jabatan'],
                'awal' => Carbon::parse($item['awal']),
                'akhir' => $item['akhir'] ? Carbon::parse($item['akhir']) : null,
            ]);
        }
    }
}
