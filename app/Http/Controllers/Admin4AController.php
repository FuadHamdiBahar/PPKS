<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\A4;

use Illuminate\Support\Facades\DB;

class Admin4AController extends Controller
{
    public function index()
    {
        $semua_laporan = DB::select("SELECT sp.nm_lemb, s.id_sms, al.* FROM (select * from pddikti.dbo.satuan_pendidikan where soft_delete=0 and stat_sp in ('A','N')) sp
        LEFT JOIN (select * from pddikti.dbo.sms where soft_delete=0 and stat_prodi in ('A','N') and id_jns_sms=3) s ON sp.id_sp = s.id_sp
        RIGHT JOIN (select * from dbo.a4_laporan where soft_delete=0) al ON s.id_sms = al.id_sms 
        WHERE  sp.id_pembina ='FEA56735-4B0F-46A8-88B9-25A0D08C70E3' 
        ORDER BY sp.nm_lemb");

        $semua_laporan = collect($semua_laporan);

        $laporan_disetujui = $semua_laporan->where('status_a4', 1)->all();
        $laporan_ditolak = $semua_laporan->where('status_a4', 3)->all();
        $ajuan_laporan = $semua_laporan->where('status_a4', 4)->all();

        // return $laporan_disetujui;
        return view('admin.index4A', [
            'tab_name' => 'Admin 4A',
            'main_menu' => '4A',
            'sub_menu' => 'Admin',
            'semua_laporan' => $semua_laporan,
            'laporan_disetujui' => $laporan_disetujui,
            'laporan_ditolak' => $laporan_ditolak,
            'ajuan_laporan' => $ajuan_laporan
        ]);
    }

    public function show($id_a4)
    {
        $semua_laporan = DB::select("SELECT m.kode_prodi, m.nm_lemb [prodi], j.nm_jenj_didik [jenjang], 
        k.nm_kurikulum_sp, l.kode_mk, l.nm_mk, l.sks_mk, a.*
        from (select * from lldikti9dev.dbo.a4_laporan where soft_delete=0) a 
        inner join (select * from pddikti.dbo.sms where soft_delete=0) m on m.id_sms=a.id_sms 
        inner join pddikti.ref.jenjang_pendidikan j on j.id_jenj_didik=m.id_jenj_didik 
        left join (select * from pddikti.dbo.kurikulum_sp where soft_delete=0) k on k.id_kurikulum_sp=a.id_kurikulum 
        left join (select * from pddikti.dbo.matkul where soft_delete=0) l on l.id_mk=a.id_matkul");

        $item = collect($semua_laporan)->where('id_a4', $id_a4)->first();

        // return $item;
        return view('admin.show4A', [
            'tab_name' => 'Validasi 4A',
            'main_menu' => '4A',
            'sub_menu' => 'Validasi',
            'item' => $item
        ]);
    }

    public function valid($id_a4)
    {
        A4::where('id_a4', $id_a4)->update(['status_a4' => 1]);
        return redirect('/admin/4a')->with('success', 'Laporan Berhasil Divalidasi');
    }
    public function tolak(Request $request, $id_a4)
    {
        A4::where('id_a4', $id_a4)->update([
            'status_a4' => 3,
            'catatan_revisi' => $request->catatan,
        ]);
        return redirect('/admin/4a')->with('success', 'Laporan Berhasil Ditolak');
    }

    public function show2($id_a4)
    {
        $semua_laporan = DB::select("SELECT m.kode_prodi, m.nm_lemb [prodi], j.nm_jenj_didik [jenjang], 
        k.nm_kurikulum_sp, l.kode_mk, l.nm_mk, l.sks_mk, a.*
        from (select * from lldikti9dev.dbo.a4_laporan where soft_delete=0) a 
        inner join (select * from pddikti.dbo.sms where soft_delete=0) m on m.id_sms=a.id_sms 
        inner join pddikti.ref.jenjang_pendidikan j on j.id_jenj_didik=m.id_jenj_didik 
        left join (select * from pddikti.dbo.kurikulum_sp where soft_delete=0) k on k.id_kurikulum_sp=a.id_kurikulum 
        left join (select * from pddikti.dbo.matkul where soft_delete=0) l on l.id_mk=a.id_matkul");

        $item = collect($semua_laporan)->where('id_a4', $id_a4)->first();

        return view('admin.valid4A', [
            'tab_name' => 'Validasi 4A',
            'main_menu' => '4A',
            'sub_menu' => 'Validasi',
            'item' => $item
        ]);
    }
}
