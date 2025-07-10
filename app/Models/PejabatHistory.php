<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PejabatHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori',
        'nama',
        'jabatan',
        'posisi',
        'nik',
        'awal',
        'akhir',
    ];

    protected $casts = [
        'awal' => 'date',
        'akhir' => 'date',
    ];
}
