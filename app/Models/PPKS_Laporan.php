<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPKS_Laporan extends Model
{
    use HasFactory;

    // menghubungkan ke table ppks_laporan
    protected $table = 'lldikti9dev.dbo.ppks_laporan';

    // mendifiniskan variabel yang menggunakan timestamps
    public const CREATED_AT = null;
    public const UPDATED_AT = null;

    // memilih data yang tidak boleh diisi secara mass
    protected $guard = [];
}
