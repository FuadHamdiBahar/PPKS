<?php

namespace App\Http\Controllers;

use App\Models\PPKS;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

class PPKSController extends Controller
{
    public function rekap(Request $request)
    {
        // personID adalah id_sp
        $personid = $request->session()->get('id_sp');

        $semua_laporan = DB::select("SELECT d.id_sp, d.npsn,d.nmpt, d.id_inpp,d.nama_inpp,d.status_inpp,count(l.kegiatan_ppks) [jumlah]
        from (select s.id_sp [id_sp],s.npsn [npsn],s.nm_lemb [nmpt], i.id_inpp [id_inpp],i.nama_inpp [nama_inpp], i.status_inpp [status_inpp] 
        from pddiktidev.dbo.satuan_pendidikan s cross join lldikti9dev.dbo.ppks_instrumen i where status_inpp is null and soft_delete=0 and stat_sp in ('A','N') 
        and id_pembina='FEA56735-4B0F-46A8-88B9-25A0D08C70E3') d 
        left join (select * from lldikti9dev.dbo.ppks_laporan where soft_delete=0 and year(tgl_berlaku)>=year(getdate()) and year(tgl_kadaluarsa)<=year(getdate())) l on l.id_sp=d.id_sp and l.id_inpp=d.id_inpp
        group by d.id_sp, d.npsn,d.nmpt, d.id_inpp,d.nama_inpp,d.status_inpp");

        $semua_laporan = collect($semua_laporan)->where('id_sp', $personid);
        // return $semua_laporan;
        return view('ppks.rekapitulasi', [
            'tab_name' => 'Rekapitulasi PPKS',
            'main_menu' => 'PPKS',
            'sub_menu' => 'Rekapitulasi',
            'data' => $semua_laporan,
            'id' => $personid
        ]);
    }

    public function show(Request $request, $id_inpp)
    {
        // personID adalah id_sp
        $personid = $request->session()->get('id_sp');

        $query = "SELECT pl.*, pi2.nama_inpp  FROM lldikti9dev.dbo.ppks_laporan pl, lldikti9dev.dbo.ppks_instrumen pi2  
        WHERE pl.id_inpp = pi2.id_inpp and pl.soft_delete = 0 and pl.id_sp = '" . $personid . "' and pl.id_inpp = " . $id_inpp;
        $data = DB::select($query);

        // return $data;
        // $data = collect($data)->where('id_sp', $personid)->where('id_inpp', $id_inpp)->where('soft_delete', 0);


        // return $data;
        return view('ppks.show', [
            'tab_name' => 'Detail PPKS',
            'main_menu' => 'PPKS',
            'sub_menu' => 'Detail',
            'semua_laporan' => $data
        ]);
    }

    public function index(Request $request)
    {
        // personID adalah id_sp
        $personid = $request->session()->get('id_sp');
        // return $personid;

        $semua_laporan = DB::select("select s.id_sp, a.id_ppks, s.npsn, s.nm_lemb [nmpt], i.nama_inpp, i.id_inpp, 
        a.status_ppks, a.updated_on, a.nama_pj, a.file_dok, a.kegiatan_ppks, a.tgl_berlaku, a.tgl_kadaluarsa, a.catatan_revisi
        from (select * from pddikti.dbo.satuan_pendidikan where soft_delete=0 and stat_sp in ('A','N')) s 
        left join (select * from lldikti9dev.dbo.ppks_laporan where soft_delete=0) a on a.id_sp=s.id_sp 
        left join lldikti9dev.dbo.ppks_instrumen i on i.id_inpp=a.id_inpp 
        where s.id_pembina='FEA56735-4B0F-46A8-88B9-25A0D08C70E3'");

        $semua_laporan = collect($semua_laporan)->where('id_sp', $personid)->sortByDesc('updated_on');
        // 1,3,4 = valid tolak pengajuan
        $laporan_disetujui = $semua_laporan->where('status_ppks', 1);
        $ajuan_laporan = $semua_laporan->where('status_ppks', 4);
        $laporan_ditolak = $semua_laporan->where('status_ppks', 3);

        return view('ppks.pelaporan', [
            'tab_name' => 'Pelaporan PPKS',
            'main_menu' => 'PPKS',
            'sub_menu' => 'Pelaporan',
            'laporan_disetujui' => $laporan_disetujui,
            'ajuan_laporan' => $ajuan_laporan,
            'laporan_ditolak' => $laporan_ditolak
        ]);
    }

    public function create()
    {
        $instrumen = DB::select("SELECT * FROM lldikti9dev.dbo.ppks_instrumen;");
        return view('ppks.form', [
            'tab_name' => 'Form PPKS',
            'main_menu' => 'PPKS',
            'sub_menu' => 'Form',
            'instrumen' => $instrumen
        ]);
    }

    public function store(Request $request)
    {
        // return $request->file_dok->store('ppks');
        // personID adalah id_sp
        $personid = $request->session()->get('id_sp');
        $validData = $request->validate([
            'id_inpp' => 'required',
            'kegiatan_ppks' => 'required',
            'tgl_berlaku' => 'required',
            'tgl_kadaluarsa' => 'required',
            'noreg_pj' => 'required|max:12',
            'nama_pj' => 'required|max:100',
            'nohp_pj' => 'required|max:12',
            'file_dok' => 'required|mimes:pdf|max:512'
        ]);

        // valid data dibuat diawal untuk digunakan penamaan folder
        $validData['id_ppks'] = strtoupper(Str::uuid());

        // membuat nama file berdasarkan waktu agar ketika melakukan upload kembali
        // file sebelumnya tidak terhapus karena waktu berjalan terus
        $nama_file = date('Y-m-d H:i:s') . '_' . $request->file_dok->getClientOriginalName();
        $nama_folder = 'ppks/' . $validData['id_ppks'];

        // menggantin nama file dengan yang didefiniskan ($nama_file) agar mudah saat pemanggilan di view
        $validData['file_dok'] = $nama_file;
        $validData['id_sp'] = $personid;
        $validData['status_ppks'] = 4;
        $validData['soft_delete'] = 0;
        $validData['created_by'] = $personid;
        $validData['updated_by'] = $personid;


        PPKS::create($validData);

        // menyimpan file ke storage/app/public
        $request->file_dok->storeAs($nama_folder, $nama_file);

        return redirect('/ppks')->with('success', 'Laporan Berhasil Ditambahkan!');
    }

    public function destroy($id_ppks)
    {
        PPKS::where('id_ppks', $id_ppks)->update(['soft_delete' => 1]);
        return redirect('/ppks')->with('success', 'Laporan Berhasil Dihapus!');
    }

    public function edit($id_ppks)
    {
        // mengambul seluruh instrumen
        $instrumen = DB::select("SELECT * FROM lldikti9dev.dbo.ppks_instrumen;");

        // mengambul 1 data
        $item = DB::table('ppks_laporan')->where('id_ppks', $id_ppks)->first();

        return view('ppks.edit', [
            'tab_name' => 'Edit PPKS',
            'main_menu' => 'PPKS',
            'sub_menu' => 'Edit',
            'instrumen' => $instrumen,
            'data' => $item
        ]);
    }

    public function update(Request $request, $id_ppks)
    {
        // mengambil person untuk eksekusi mata kuliah berdasarkan prodi
        $personid = $request->session()->get('id_sp');

        $rules = [
            'id_inpp' => 'required',
            'kegiatan_ppks' => 'required',
            'tgl_berlaku' => 'required',
            'tgl_kadaluarsa' => 'required',
            'noreg_pj' => 'required|max:12',
            'nama_pj' => 'required|max:100',
            'nohp_pj' => 'required|max:12',
        ];

        if ($request->file_dok) {
            $rules['file_dok'] = 'required|mimes:pdf|max:512';
        }

        $validData = $request->validate($rules);

        $nama_folder = '';
        if ($request->file_dok) {
            // membuat nama file berdasarkan waktu agar ketika melakukan upload kembali
            // file sebelumnya tidak terhapus karena waktu berjalan terus
            $nama_file = date('Y-m-d H:i:s') . '_' . $request->file_dok->getClientOriginalName();
            $nama_folder = 'ppks/' . $id_ppks;

            $validData['file_dok'] = $nama_file;
        }

        $validData['updated_by'] = $personid;

        PPKS::where('id_ppks', $id_ppks)->update($validData);

        if ($request->file_dok) {
            // menyimpan file ke storage/app/public
            $request->file_dok->storeAs($nama_folder, $nama_file);
        }

        return redirect('/ppks')->with('success', 'Laporan Berhasil Diperbarui!');
    }


    public function ajukan_kembali($id_ppks)
    {
        PPKS::where('id_ppks', $id_ppks)->update(['status_ppks' => 4]);
        return redirect('/ppks')->with('success', 'Laporan Berhasil Diajukan Kembali!');
    }

    public function preview($id_ppks)
    {
        $semua_laporan = DB::select("SELECT pl.id_ppks , pi2.nama_inpp , sp.nm_lemb , pl.kegiatan_ppks , pl.tgl_berlaku , pl.tgl_kadaluarsa , pl.noreg_pj , pl.nama_pj , pl.nohp_pj ,
        pl.file_dok , pl.status_ppks, pl.created_on , pl.updated_on 
        FROM lldikti9dev.dbo.ppks_laporan pl 
        INNER JOIN pddikti.dbo.satuan_pendidikan sp ON pl.id_sp=sp.id_sp
        INNER JOIN lldikti9dev.dbo.ppks_instrumen pi2 ON pl.id_inpp=pi2.id_inpp 
        WHERE pl.soft_delete = 0");

        $item = collect($semua_laporan)->where('id_ppks', $id_ppks)->first();
        return view('ppks.preview', [
            'tab_name' => 'Preview PPKS',
            'main_menu' => 'PPKS',
            'sub_menu' => 'Preview',
            'item' => $item,
        ]);
    }

    public function cetak(Request $request)
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
        and " . $request->tahun . " between year(tgl_berlaku) 
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
        where soft_delete=0 and " . $request->tahun . " BETWEEN year(tgl_berlaku) and year(tgl_kadaluarsa) 
        and status_ppks in (" . $request->valid . ")) l on l.id_sp=d.id_sp and l.id_inpp=d.id_inpp
        group by d.id_sp, d.npsn,d.nmpt, d.id_inpp,d.nama_inpp,d.status_inpp) m 
        WHERE m.id_sp = '" . $request->id_sp . "'");

        $jumlah_laporan = collect($query)->sum('jumlah');

        $nama_institusi = DB::select("SELECT TOP 1 nm_lemb FROM pddikti.dbo.satuan_pendidikan WHERE id_sp = '" . $request->id_sp . "'");
        $nama_institusi = collect($nama_institusi)->first()->nm_lemb;

        return view('ppks.cetak', [
            'nama_institusi' => $nama_institusi,
            'data' => $query,
            'jumlah_laporan' => $jumlah_laporan,
            'rata_capaian' => $rata_capaian
        ]);
    }
}
