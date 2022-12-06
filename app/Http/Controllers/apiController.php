<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Models\PPKS;
use Illuminate\Http\Request;

class apiController extends Controller
{
    // LLDIKTI
    // A4
    public function a4_rekap(Request $request)
    {
        $query = DB::select("SELECT m.id_sp, m.id_sms, m.prodi, m.jenjang, n.a1, n.a2, n.a3, n.a4,
        (CONVERT(FLOAT,IIF(a1>0,1,0)+IIF(a2>0,1,0)+IIF(a3>0,1,0)+IIF(a4>0,1,0)))/4*100 [persen] FROM 
        (SELECT id_sp, id_sms,kode_prodi,nm_lemb [prodi], nm_jenj_didik [jenjang]
        FROM pddikti.dbo.sms s 
        INNER JOIN pddikti.[ref].jenjang_pendidikan jp
        ON jp.id_jenj_didik = s.id_jenj_didik 
        WHERE s.soft_delete = 0 
        AND s.id_jns_sms = 3 
        AND s.stat_prodi IN ('A', 'N')
        AND s.id_jenj_didik IN (20,21,22,23,30)
        AND s.id_sp = '" . $request->id_sp . "') m
        LEFT JOIN (SELECT 
        id_sms, SUM(IIF(jenis_a4=1,1,0)) [a1], SUM(IIF(jenis_a4=2,1,0)) [a2],
        SUM(IIF(jenis_a4=3,1,0)) [a3], SUM(IIF(jenis_a4=4,1,0)) [a4] 
        FROM lldikti9dev.dbo.a4_laporan al 
        WHERE soft_delete = 0
        AND " . $request->year . " BETWEEN YEAR (tgl_berlaku) AND YEAR (tgl_kadaluarsa)
        AND status_a4 in (" . $request->valid . ") GROUP BY id_sms) n ON m.id_sms = n.id_sms");

        $query_kedua = DB::select("SELECT * FROM (SELECT * FROM lldikti9dev.dbo.a4_laporan
        WHERE status_a4 in (" . $request->valid . ") AND " . $request->year . " BETWEEN YEAR (tgl_berlaku) AND YEAR(tgl_kadaluarsa)) m
        JOIN (SELECT s.id_sms, s.nm_lemb FROM pddikti.dbo.sms s
        INNER JOIN pddikti.ref.jenjang_pendidikan jp 
        ON jp.id_jenj_didik  = s.id_jenj_didik 
        WHERE s.soft_delete = 0
        AND s.id_jns_sms = 3
        AND s.stat_prodi IN ('A', 'N')
        AND s.id_jenj_didik IN (20, 21, 22, 23, 30)
        AND s.id_sp = '" . $request->id_sp . "') al ON al.id_sms = m.id_sms");

        $jumlah_laporan = collect($query_kedua)->count();
        $rata_capaian = collect($query)->sum('persen') / (collect($query)->count() * 100);
        $rata_capaian = number_format($rata_capaian, 2, '.', '');

        return response()->json([
            'data' => $query,
            'jumlah_laporan' => $jumlah_laporan,
            'rata_capaian' => $rata_capaian
        ]);
    }

    public function ppks_rekap(Request $request)
    {
        $query_kedua = DB::select("SELECT s.id_sp, s.npsn, s.nm_lemb, sum(r.terlapor) [instrumen_terlapor],
        count(r.id_inpp) [instrumen_jumlah], CONVERT(FLOAT,sum(r.terlapor))/CONVERT(FLOAT,count(r.id_inpp))*100 [capaian]
        FROM pddikti.dbo.satuan_pendidikan s
        INNER JOIN (select d.id_sp, d.id_inpp,iif(count(l.kegiatan_ppks)>0,1,0) [terlapor]
        FROM (select s.id_sp [id_sp],s.npsn [npsn],s.nm_lemb [nmpt],
        i.id_inpp [id_inpp],i.nama_inpp [nama_inpp], i.status_inpp [status_inpp]
        from pddikti.dbo.satuan_pendidikan s
        cross join lldikti9dev.dbo.ppks_instrumen i
        where status_inpp is null and soft_delete=0 and stat_sp in ('A','N')
        and id_pembina='FEA56735-4B0F-46A8-88B9-25A0D08C70E3' and id_sp = '" . $request->id_sp . "') d
        left join (select * from lldikti9dev.dbo.ppks_laporan
        where soft_delete=0
        and " . $request->year . " between year(tgl_berlaku) 
        and year(tgl_kadaluarsa) --filter tahun laporan
        and status_ppks in (" . $request->valid . ")) l on l.id_sp=d.id_sp and l.id_inpp=d.id_inpp
        group by d.id_sp,d.id_inpp) r ON r.id_sp=s.id_sp
        WHERE s.soft_delete=0 AND s.stat_sp in ('A','N') AND id_pembina='FEA56735-4B0F-46A8-88B9-25A0D08C70E3'
        GROUP BY s.id_sp,s.npsn,s.nm_lemb
        ORDER BY s.npsn");

        $rata_capaian = number_format($query_kedua[0]->capaian, 2, '.', '');

        $query = DB::select("SELECT * FROM (SELECT d.id_sp, d.npsn,d.nmpt, d.id_inpp,d.nama_inpp,d.status_inpp,count(l.kegiatan_ppks) [jumlah] from (
        select s.id_sp [id_sp],s.npsn [npsn],s.nm_lemb [nmpt], i.id_inpp [id_inpp],i.nama_inpp [nama_inpp], i.status_inpp [status_inpp] 
        from pddikti.dbo.satuan_pendidikan s
        cross join lldikti9dev.dbo.ppks_instrumen i 
        where status_inpp is null and soft_delete=0 and stat_sp in ('A','N') 
        and id_pembina='FEA56735-4B0F-46A8-88B9-25A0D08C70E3') d 
        left join (select * from lldikti9dev.dbo.ppks_laporan 
        where soft_delete=0 and " . $request->year . " BETWEEN year(tgl_berlaku) and year(tgl_kadaluarsa) 
        and status_ppks in (" . $request->valid . ")) l on l.id_sp=d.id_sp and l.id_inpp=d.id_inpp
        group by d.id_sp, d.npsn,d.nmpt, d.id_inpp,d.nama_inpp,d.status_inpp) m 
        WHERE m.id_sp = '" . $request->id_sp . "'");

        $jumlah_laporan = collect($query)->sum('jumlah');

        return response()->json([
            'data' => $query,
            'jumlah_laporan' => $jumlah_laporan,
            'rata_capaian' => $rata_capaian
        ]);
    }

    public function overview_4a(Request $request)
    {
        $query = DB::select("SELECT
        s.id_sp, s.npsn,s.nm_lemb,SUM(a1) [a1],SUM(a2) [a2],SUM(a3) [a3],SUM(a4) [a4],AVG(persen) [persen]
        FROM (SELECT m.id_sp [id_sp],m.kode_prodi,m.prodi,m.jenjang,a1,a2,a3,a4,
        (CONVERT(FLOAT,IIF(a1>0,1,0)+IIF(a2>0,1,0)+IIF(a3>0,1,0)+IIF(a4>0,1,0)))/4*100 [persen]
        FROM (SELECT id_sp,id_sms,kode_prodi,nm_lemb [prodi], nm_jenj_didik [jenjang] FROM pddikti.dbo.sms mx
        INNER JOIN pddikti.ref.jenjang_pendidikan jx ON jx.id_jenj_didik=mx.id_jenj_didik
        WHERE mx.soft_delete=0 AND mx. id_jns_sms=3 AND mx.stat_prodi IN ('A','N')
        AND mx.id_jenj_didik IN (20,21,22,23,30)) m
        LEFT JOIN
        (SELECT	id_sms, SUM(IIF(jenis_a4=1,1,0)) [a1], SUM(IIF(jenis_a4=2,1,0)) [a2],
        SUM(IIF(jenis_a4=3,1,0)) [a3], SUM(IIF(jenis_a4=4,1,0)) [a4]
        FROM lldikti9dev.dbo.a4_laporan
        WHERE soft_delete=0 
        and " . $request->year . " between year(tgl_berlaku) and year(tgl_kadaluarsa)
        and status_a4 in (" . $request->valid . ")
        GROUP BY id_sms) a ON a.id_sms=m.id_sms) l
        JOIN (SELECT * FROM pddikti.dbo.satuan_pendidikan
        WHERE soft_delete=0 AND stat_sp IN ('A','N') AND
        id_pembina='FEA56735-4B0F-46A8-88B9-25A0D08C70E3') s ON s.id_sp=l.id_sp
        GROUP BY s.npsn,s.nm_lemb, s.id_sp
        ORDER BY s.npsn");

        // $total_institusi = collect($query)->count();
        $a1 = collect($query)->sum('a1');
        $a2 = collect($query)->sum('a2');
        $a3 = collect($query)->sum('a3');
        $a4 = collect($query)->sum('a4');

        $jumlah_laporan = $a1 + $a2 + $a3 + $a4;
        $rata_capaian = collect($query)->avg('persen');
        $rata_capaian = number_format($rata_capaian, 2, '.', '');
        // return $jumlah_laporan;
        return response()->json([
            'data' => $query,
            'jumlah_laporan' => $jumlah_laporan,
            'rata_capaian' => $rata_capaian
        ]);
    }

    public function overview_ppks(Request $request)
    {
        $query = DB::select("SELECT s.id_sp,s.npsn,s.nm_lemb,
        sum(r.terlapor) [instrumen_terlapor],
        count(r.id_inpp) [instrumen_jumlah],
        CONVERT(FLOAT,sum(r.terlapor))/CONVERT(FLOAT,count(r.id_inpp))*100 [capaian]
        FROM pddikti.dbo.satuan_pendidikan s
        INNER JOIN
        (select	d.id_sp, d.id_inpp,iif(count(l.kegiatan_ppks)>0,1,0) [terlapor]
        from (select s.id_sp [id_sp],s.npsn [npsn],s.nm_lemb [nmpt],
        i.id_inpp [id_inpp],i.nama_inpp [nama_inpp], i.status_inpp [status_inpp]
        from pddikti.dbo.satuan_pendidikan s
        cross join lldikti9dev.dbo.ppks_instrumen i
        where
        status_inpp is null and soft_delete=0 and stat_sp in ('A','N')
        and id_pembina='FEA56735-4B0F-46A8-88B9-25A0D08C70E3') d
        left join (select * from lldikti9dev.dbo.ppks_laporan
        where soft_delete=0
        and " . $request->year . " between year(tgl_berlaku) and year(tgl_kadaluarsa) --filter tahun laporan
        and status_ppks in (" . $request->valid . ") --filter validasi 
        ) l on l.id_sp=d.id_sp and l.id_inpp=d.id_inpp
        group by d.id_sp,d.id_inpp
        ) r ON r.id_sp=s.id_sp
        WHERE s.soft_delete=0 AND s.stat_sp in ('A','N') AND id_pembina='FEA56735-4B0F-46A8-88B9-25A0D08C70E3'
        GROUP BY s.id_sp,s.npsn,s.nm_lemb
        ORDER BY s.npsn");

        $jumlah_laporan = collect($query)->sum('instrumen_terlapor');
        $rata_capaian = collect($query)->avg('capaian');
        $rata_capaian = number_format($rata_capaian, 2, '.', '');

        return response()->json([
            'data' => $query,
            'jumlah_laporan' => $jumlah_laporan,
            'rata_capaian' => $rata_capaian
        ]);
    }
}
