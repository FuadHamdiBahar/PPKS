<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class A4 extends Model
{
    use HasFactory;

    // menghubungkan ke table a4_laporan
    protected $table = 'lldikti9dev.dbo.a4_laporan';

    // mendifiniskan variabel yang menggunakan timestamps
    public const CREATED_AT = 'created_on';
    public const UPDATED_AT = 'updated_on';

    // memilih data yang tidak boleh diisi secara mass
    protected $fillable = [
        'jenis_a4', 'kegiatan_a4', 'tgl_berlaku', 'tgl_kadaluarsa', 'noreg_pj', 'nama_pj', 'nohp_pj', 'file_a4', 'id_a4',
        'id_sms', 'id_kurikulum', 'id_matkul', 'status_a4', 'soft_delete', 'created_by', 'updated_by', 'updated_on', 'created_on'
    ];
}
