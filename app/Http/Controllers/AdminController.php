<?php

namespace App\Http\Controllers;

use App\Models\A4;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function overview4A()
    {
        $nama_institusi = DB::select("SELECT id_sp, nm_lemb FROM pddikti.dbo.satuan_pendidikan WHERE id_pembina = 'FEA56735-4B0F-46A8-88B9-25A0D08C70E3'");

        return view('admin.overview', [
            'tab_name' => 'Validasi PPKS',
            'main_menu' => 'PPKS',
            'sub_menu' => 'Validasi',
            'nama_institusi' => $nama_institusi,
        ]);
    }

    public function detailOverview4A(Request $request)
    {
        $id = $request->id_sp;
        return view('admin.detailOverview4A', [
            'tab_name' => 'Validasi PPKS',
            'main_menu' => 'PPKS',
            'sub_menu' => 'Validasi',
            'id' => $id,
        ]);
    }

    public function overviewPPKS()
    {

        return view('admin.overviewPPKS', [
            'tab_name' => 'Validasi PPKS',
            'main_menu' => 'PPKS',
            'sub_menu' => 'Validasi',
        ]);
    }

    public function detailOverviewPPKS(Request $request)
    {
        $id = $request->id_sp;
        $data_universitas =  collect(DB::select("SELECT nm_lemb FROM pddikti.dbo.satuan_pendidikan WHERE id_sp = '" . $id . "'"))->first();

        return view('admin.detailOverviewPPKS', [
            'tab_name' => 'Validasi PPKS',
            'main_menu' => 'PPKS',
            'sub_menu' => 'Validasi',
            'id' => $id,
            'data_universitas' => $data_universitas
        ]);
    }

    public function cascadePPKS()
    {
        return view('admin.cascadePPKS', [
            'tab_name' => 'Validasi PPKS',
            'main_menu' => 'PPKS',
            'sub_menu' => 'Validasi',
        ]);
    }


    // API PANAS
    public function a4Api(Request $request)
    {
        if ($request->valid == 1) {
            $query = DB::select("SELECT m.kode_prodi, m.prodi, m.jenjang, a1, a2, a3, a4, 
            (CONVERT(FLOAT,IIF(a1>0,1,0)+IIF(a2>0,1,0)+IIF(a3>0,1,0)+IIF(a4>0,1,0)))/4*100 [persen]
            FROM (SELECT id_sms, kode_prodi, nm_lemb [prodi], s.id_jenj_didik [jenjang]
            FROM pddikti.dbo.sms s INNER JOIN pddikti.[ref].jenjang_pendidikan jp on jp.id_jenj_didik = s.id_jenj_didik
            WHERE s.soft_delete = 0
                AND s.id_jns_sms = 3
                AND s.stat_prodi IN ('A', 'N')
                AND s.id_jenj_didik IN (20, 21, 22, 23, 30)
                AND s.id_sp = '" . $request->id_sp . "') m
            LEFT JOIN
            (SELECT id_sms,
                SUM(IIF(jenis_a4=1,1,0)) [a1],
                SUM(IIF(jenis_a4=2,1,0)) [a2],
                SUM(IIF(jenis_a4=3,1,0)) [a3],
                SUM(IIF(jenis_a4=4,1,0)) [a4]
            FROM lldikti9dev.dbo.a4_laporan al
            WHERE soft_delete = 0
                AND " . $request->tahun . " BETWEEN YEAR (tgl_berlaku) AND YEAR (tgl_kadaluarsa)
                AND status_a4 = " . $request->valid . "
            GROUP BY id_sms) n ON m.id_sms = n.id_sms");
        } else {
            $query = DB::select("SELECT m.kode_prodi, m.prodi, m.jenjang, a1, a2, a3, a4, 
            (CONVERT(FLOAT,IIF(a1>0,1,0)+IIF(a2>0,1,0)+IIF(a3>0,1,0)+IIF(a4>0,1,0)))/4*100 [persen]
            FROM (SELECT id_sms, kode_prodi, nm_lemb [prodi], s.id_jenj_didik [jenjang]
            FROM pddikti.dbo.sms s INNER JOIN pddikti.[ref].jenjang_pendidikan jp on jp.id_jenj_didik = s.id_jenj_didik
            WHERE s.soft_delete = 0
                AND s.id_jns_sms = 3
                AND s.stat_prodi IN ('A', 'N')
                AND s.id_jenj_didik IN (20, 21, 22, 23, 30)
                AND s.id_sp = '" . $request->id_sp . "') m
            LEFT JOIN
            (SELECT id_sms,
                SUM(IIF(jenis_a4=1,1,0)) [a1],
                SUM(IIF(jenis_a4=2,1,0)) [a2],
                SUM(IIF(jenis_a4=3,1,0)) [a3],
                SUM(IIF(jenis_a4=4,1,0)) [a4]
            FROM lldikti9dev.dbo.a4_laporan al
            WHERE soft_delete = 0
                AND " . $request->tahun . " BETWEEN YEAR (tgl_berlaku) AND YEAR (tgl_kadaluarsa)
                AND status_a4 != 5 GROUP BY id_sms) n ON m.id_sms = n.id_sms");
        }

        $total_institusi = collect($query)->count();

        return response()->json([
            'data' => $query,
            'total_institusi' => $total_institusi
        ]);
    }

    public function someData(Request $request)
    {
        $query = DB::select("SELECT m.kode_prodi, m.prodi, m.jenjang, a1, a2, a3, a4, 
        (CONVERT(FLOAT,IIF(a1>0,1,0)+IIF(a2>0,1,0)+IIF(a3>0,1,0)+IIF(a4>0,1,0)))/4*100 [persen]
        FROM (SELECT id_sms, kode_prodi, nm_lemb [prodi], s.id_jenj_didik [jenjang]
        FROM pddikti.dbo.sms s INNER JOIN pddikti.[ref].jenjang_pendidikan jp on jp.id_jenj_didik = s.id_jenj_didik
        WHERE s.soft_delete = 0
            AND s.id_jns_sms = 3
            AND s.stat_prodi IN ('A', 'N')
            AND s.id_jenj_didik IN (20, 21, 22, 23, 30)) m
        LEFT JOIN
        (SELECT id_sms,
            SUM(IIF(jenis_a4=1,1,0)) [a1],
            SUM(IIF(jenis_a4=2,1,0)) [a2],
            SUM(IIF(jenis_a4=3,1,0)) [a3],
            SUM(IIF(jenis_a4=4,1,0)) [a4]
        FROM lldikti9dev.dbo.a4_laporan al
        WHERE soft_delete = 0
            AND 2022 BETWEEN YEAR (tgl_berlaku) AND YEAR (tgl_kadaluarsa)
        GROUP BY id_sms) n ON m.id_sms = n.id_sms");

        $total_lldikti = A4::all()->count();
        $rata_capaian_lldikti = collect($query)->avg('persen');
        $rata_capaian_lldikti = number_format($rata_capaian_lldikti, 2, '.', '');
        return response()->json([
            'total_lldikti' => $total_lldikti,
            'rata_capaian_lldikti' => $rata_capaian_lldikti
        ]);
    }

    public function ppksApi(Request $request)
    {
        $query = null;
        if ($request->valid == 1) {
            $query = DB::select("SELECT
            s.id_sp,s.npsn,s.nm_lemb,
            sum(r.terlapor) [instrumen_terlapor],
            count(r.id_inpp) [instrumen_jumlah],
            CONVERT(FLOAT,sum(r.terlapor))/CONVERT(FLOAT,count(r.id_inpp))*100 [capaian]
            FROM pddikti.dbo.satuan_pendidikan s
            INNER JOIN
                    (
                    select
                        d.id_sp, d.id_inpp,iif(count(l.kegiatan_ppks)>0,1,0) [terlapor]
                    from
                        (
                        select s.id_sp [id_sp],s.npsn [npsn],s.nm_lemb [nmpt],
                                    i.id_inpp [id_inpp],i.nama_inpp [nama_inpp], i.status_inpp [status_inpp]
                        from pddikti.dbo.satuan_pendidikan s
                        cross join lldikti9dev.dbo.ppks_instrumen i
                        where
                        status_inpp is null and soft_delete=0 and stat_sp in ('A','N')
                        and id_pembina='FEA56735-4B0F-46A8-88B9-25A0D08C70E3'
                        ) d
                    left join (select * from lldikti9dev.dbo.ppks_laporan
                                        where soft_delete=0
                                                    and " . $request->tahun . " between year(tgl_berlaku) and year(tgl_kadaluarsa) --filter tahun laporan
                                                    and status_ppks=" . $request->valid . " --filter validasi
                                        ) l on l.id_sp=d.id_sp and l.id_inpp=d.id_inpp
                    group by d.id_sp,d.id_inpp
                    ) r ON r.id_sp=s.id_sp
            WHERE
                s.soft_delete=0 AND s.stat_sp in ('A','N') AND id_pembina='FEA56735-4B0F-46A8-88B9-25A0D08C70E3'
            GROUP BY s.id_sp,s.npsn,s.nm_lemb
            ORDER BY s.npsn");
        } else {
            $query = DB::select("SELECT
            s.id_sp,s.npsn,s.nm_lemb,
            sum(r.terlapor) [instrumen_terlapor],
            count(r.id_inpp) [instrumen_jumlah],
            CONVERT(FLOAT,sum(r.terlapor))/CONVERT(FLOAT,count(r.id_inpp))*100 [capaian]
            FROM pddikti.dbo.satuan_pendidikan s
            INNER JOIN
                    (
                    select
                        d.id_sp, d.id_inpp,iif(count(l.kegiatan_ppks)>0,1,0) [terlapor]
                    from
                        (
                        select s.id_sp [id_sp],s.npsn [npsn],s.nm_lemb [nmpt],
                                    i.id_inpp [id_inpp],i.nama_inpp [nama_inpp], i.status_inpp [status_inpp]
                        from pddikti.dbo.satuan_pendidikan s
                        cross join lldikti9dev.dbo.ppks_instrumen i
                        where
                        status_inpp is null and soft_delete=0 and stat_sp in ('A','N')
                        and id_pembina='FEA56735-4B0F-46A8-88B9-25A0D08C70E3'
                        ) d
                    left join (select * from lldikti9dev.dbo.ppks_laporan
                                        where soft_delete=0
                                                    and " . $request->tahun . " between year(tgl_berlaku) and year(tgl_kadaluarsa) --filter tahun laporan
                                                    and status_ppks != 5 --filter validasi
                                        ) l on l.id_sp=d.id_sp and l.id_inpp=d.id_inpp
                    group by d.id_sp,d.id_inpp
                    ) r ON r.id_sp=s.id_sp
            WHERE
                s.soft_delete=0 AND s.stat_sp in ('A','N') AND id_pembina='FEA56735-4B0F-46A8-88B9-25A0D08C70E3'
            GROUP BY s.id_sp,s.npsn,s.nm_lemb
            ORDER BY s.npsn");
        }

        $jumlah_laporan = 0;
        if ($request->valid == 1) {
            $jumlah_laporan = collect(DB::select("SELECT * FROM lldikti9dev.dbo.ppks_laporan WHERE 
            status_ppks = " . $request->valid . " AND " . $request->tahun . " BETWEEN YEAR (tgl_berlaku) AND YEAR (tgl_kadaluarsa)"))->count();
        } else {
            $jumlah_laporan = collect(DB::select("SELECT * FROM lldikti9dev.dbo.ppks_laporan WHERE 
            status_ppks != 5 AND " . $request->tahun . " BETWEEN YEAR (tgl_berlaku) AND YEAR (tgl_kadaluarsa)"))->count();
        }

        $rata_capaian = collect($query)->avg('capaian');
        $rata_capaian = number_format($rata_capaian, 2, '.', '');
        return response()->json([
            'data' => $query,
            'jumlah_laporan' => $jumlah_laporan,
            'rata_capaian' => $rata_capaian
        ]);
    }
}
