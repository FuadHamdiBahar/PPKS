<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPKS extends Model
{
    use HasFactory;

    // menghubungkan ke table ppks_laporan
    protected $table = 'lldikti9dev.dbo.ppks_laporan';

    // mendifiniskan variabel yang menggunakan timestamps
    public const CREATED_AT = 'created_on';
    public const UPDATED_AT = 'updated_on';

    // memilih data yang tidak boleh diisi secara mass
    protected $fillable = [
        'id_ppks', 'id_inpp', 'id_sp', 'kegiatan_ppks', 'tgl_berlaku', 'tgl_kadaluarsa', 'noreg_pj', 'nama_pj',
        'nohp_pj', 'file_dok',  'status_ppks', 'soft_delete', 'created_by', 'updated_by', 'updated_on', 'created_on'
    ];
}
