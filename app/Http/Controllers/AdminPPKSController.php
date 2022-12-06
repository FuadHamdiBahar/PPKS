<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PPKS;
use Illuminate\Support\Facades\DB;

class AdminPPKSController extends Controller
{
    public function laporanPPKS(Request $request)
    {
        // personID adalah id_sp
        $personid = $request->session()->get('personid');


        // $semua_laporan = PPKS::where('soft_delete', 0)->orderBy('updated_on', 'desc')->get();
        $semua_laporan = DB::select(
            'SELECT pl.id_ppks, pl.kegiatan_ppks, pl.status_ppks, pl.tgl_berlaku, pl.tgl_kadaluarsa, pl.updated_on, sp.nm_lemb, pl.nama_pj, pl.file_dok, pl.catatan_revisi FROM lldikti9dev.dbo.ppks_laporan pl, pddikti.dbo.satuan_pendidikan sp WHERE pl.id_sp = sp.id_sp'
        );
        $semua_laporan = collect($semua_laporan);

        $laporan_disetujui = $semua_laporan->where('status_ppks', 1);
        $laporan_ditolak = $semua_laporan->where('status_ppks', 3);
        $ajuan_laporan = $semua_laporan->where('status_ppks', 4);
        // return $ajuan_laporan;
        return view('admin.indexPPKS', [
            'tab_name' => 'Admin PPKS',
            'main_menu' => 'PPKS',
            'sub_menu' => 'Admin',
            'semua_laporan' => $semua_laporan,
            'laporan_disetujui' => $laporan_disetujui,
            'laporan_ditolak' => $laporan_ditolak,
            'ajuan_laporan' => $ajuan_laporan
        ]);
    }

    public function show($id_ppks)
    {
        $semua_laporan = DB::select('SELECT pl.id_ppks , pi2.nama_inpp , sp.nm_lemb , pl.kegiatan_ppks , pl.tgl_berlaku , pl.tgl_kadaluarsa , pl.noreg_pj , pl.nama_pj , pl.nohp_pj ,
        pl.file_dok , pl.status_ppks, pl.created_on , pl.updated_on 
        FROM lldikti9dev.dbo.ppks_laporan pl 
        INNER JOIN pddikti.dbo.satuan_pendidikan sp ON pl.id_sp=sp.id_sp
        INNER JOIN lldikti9dev.dbo.ppks_instrumen pi2 ON pl.id_inpp=pi2.id_inpp 
        WHERE pl.soft_delete = 0');

        $item = collect($semua_laporan)->where('id_ppks', $id_ppks)->first();

        return view('admin.showPPKS', [
            'tab_name' => 'Validasi PPKS',
            'main_menu' => 'PPKS',
            'sub_menu' => 'Validasi',
            'item' => $item
        ]);
    }

    public function validPPKS($id_ppks)
    {
        PPKS::where('id_ppks', $id_ppks)->update(['status_ppks' => 1]);
        return redirect('/admin/ppks')->with('success', 'Laporan Berhasil Divalidasi');
    }

    public function tolakPPKS(Request $request, $id_ppks)
    {
        PPKS::where('id_ppks', $id_ppks)->update([
            'status_ppks' => 3,
            'catatan_revisi' => $request->catatan,
        ]);
        return redirect('/admin/ppks')->with('success', 'Laporan Berhasil Ditolak');
    }

    public function show2($id_ppks)
    {
        $semua_laporan = DB::select('SELECT pl.id_ppks , pi2.nama_inpp , sp.nm_lemb , pl.kegiatan_ppks , pl.tgl_berlaku , pl.tgl_kadaluarsa , pl.noreg_pj , pl.nama_pj , pl.nohp_pj ,
        pl.file_dok , pl.status_ppks, pl.created_on , pl.updated_on 
        FROM lldikti9dev.dbo.ppks_laporan pl 
        INNER JOIN pddikti.dbo.satuan_pendidikan sp ON pl.id_sp=sp.id_sp
        INNER JOIN lldikti9dev.dbo.ppks_instrumen pi2 ON pl.id_inpp=pi2.id_inpp 
        WHERE pl.soft_delete = 0');

        $item = collect($semua_laporan)->where('id_ppks', $id_ppks)->first();

        return view('admin.validPPKS', [
            'tab_name' => 'Validasi PPKS',
            'main_menu' => 'PPKS',
            'sub_menu' => 'Validasi',
            'item' => $item
        ]);
    }
}
