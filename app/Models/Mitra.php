<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_mitra',
        'no_khs_mitra',
        'amd_khs_mitra_1',
        'amd_khs_mitra_2',
        'amd_khs_mitra_3',
        'amd_khs_mitra_4',
        'amd_khs_mitra_5',
        'direktur_mitra',
        'jabatan_mitra',
        'alamat_kantor',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
