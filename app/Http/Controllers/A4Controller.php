<?php

namespace App\Http\Controllers;

use App\Models\A4;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

class A4Controller extends Controller
{
    public function rekap(Request $request)
    {
        // mengambil person untuk eksekusi mata kuliah berdasarkan prodi
        $personid = $request->session()->get('id_sp');

        // mengirim view dan data
        return view('4a.rekapitulasi', [
            'tab_name' => 'Rekapitulasi 4A',
            'main_menu' => '4A',
            'sub_menu' => 'Rekapitulasi',
            'id_sp' => $personid
        ]);
    }

    public function show($id_sms)
    {
        // mengambil semua laporan dari prodi tertentu
        $semua_laporan_prodi = A4::where('id_sms', $id_sms)->where('soft_delete', 0)->get();

        return view('4a.show', [
            'tab_name' => 'Detail 4A',
            'main_menu' => '4A',
            'sub_menu' => 'Detail',
            'semua_laporan' => $semua_laporan_prodi
        ]);
    }

    public function index(Request $request)
    {
        // mengambil person untuk eksekusi mata kuliah berdasarkan prodi
        $personid = $request->session()->get('id_sp');
        // mengambil semua laporan
        $semua_laporan = DB::select("SELECT s.id_sp, m.id_sms, a.id_a4, a.id_matkul, a.kegiatan_a4, s.npsn,
        s.nm_lemb [nmpt], m.nm_lemb [prodi],j.nm_jenj_didik, a.status_a4, a.updated_on, a.nama_pj, a.file_a4, a.tgl_berlaku, a.tgl_kadaluarsa, a.catatan_revisi
        from (select * from pddikti.dbo.sms where soft_delete=0 and stat_prodi in ('A','N') and id_jns_sms=3) m 
        left join pddikti.ref.jenjang_pendidikan j on j.id_jenj_didik=m.id_jenj_didik 
        left join (select * from pddikti.dbo.satuan_pendidikan where soft_delete=0 and stat_sp in ('A','N')) s on s.id_sp=m.id_sp 
        left join (select * from dbo.a4_laporan where soft_delete=0) a on a.id_sms=m.id_sms
        where s.id_pembina='FEA56735-4B0F-46A8-88B9-25A0D08C70E3'");

        // mengambil laporan pts tertentu
        $semua_laporan = collect($semua_laporan)->where('id_sp', $personid)->sortByDesc('updated_on');

        // 1,3,4 = valid tolak pengajuan
        $laporan_disetujui = $semua_laporan->where('status_a4', 1);
        $ajuan_laporan = $semua_laporan->where('status_a4', 4);
        $laporan_ditolak = $semua_laporan->where('status_a4', 3);

        // return $ajuan_laporan;
        return view('4a.pelaporan', [
            'tab_name' => 'Pelaporan 4A',
            'main_menu' => '4A',
            'sub_menu' => 'Pelaporan',
            'laporan_disetujui' => $laporan_disetujui,
            'ajuan_laporan' => $ajuan_laporan,
            'laporan_ditolak' => $laporan_ditolak
        ]);
    }

    public function create(Request $request)
    {
        // mengambil person untuk eksekusi mata kuliah berdasarkan prodi
        $personid = $request->session()->get('id_sp');
        // mengambil prodi semua pts
        $program_studi = DB::select("EXEC lldikti9dev.dbo.p_prodi_pt @id_sp = '" . $personid . "'");

        // mengirim view dan data
        return view('4a.form', [
            'tab_name' => 'Form 4A',
            'main_menu' => '4A',
            'sub_menu' => 'Form',
            'program_studi' => $program_studi,
        ]);
    }

    public function creates(Request $request)
    {
        // mengambil person untuk eksekusi mata kuliah berdasarkan prodi
        $personid = $request->session()->get('id_sp');
        // mengambil prodi semua pts
        $program_studi = DB::select("EXEC lldikti9dev.dbo.p_prodi_pt @id_sp = '" . $personid . "'");

        // mengirim view dan data
        return view('4a.forms', [
            'tab_name' => 'Form 4A',
            'main_menu' => '4A',
            'sub_menu' => 'Form',
            'program_studi' => $program_studi,
        ]);
    }

    public function store(Request $request)
    {
        // mengambil person untuk eksekusi mata kuliah berdasarkan prodi
        $personid = $request->session()->get('id_sp');

        // return $request;
        $rules = [
            'jenis_a4' => 'required',
            'id_sms' => 'required',
            'tgl_berlaku' => 'required',
            'tgl_kadaluarsa' => 'required',
            'noreg_pj' => 'required|max:12',
            'nama_pj' => 'required|max:100',
            'nohp_pj' => 'required|max:15',
            'file_a4' => 'required|mimes:pdf|max:512'
        ];

        if ($request->id_kurikulum) {
            $rules['id_kurikulum'] = 'required';
            $rules['id_matkul'] = 'required';
        } else {
            $rules['kegiatan_a4'] = 'required';
        }


        $validData = $request->validate($rules);


        // valid data dibuat diawal untuk digunakan penamaan folder
        $validData['id_a4'] = strtoupper(Str::uuid());

        // membuat nama file berdasarkan waktu agar ketika melakukan upload kembali
        // file sebelumnya tidak terhapus karena waktu berjalan terus
        $nama_file = date('Y-m-d H:i:s') . '_' . $request->file_a4->getClientOriginalName();
        $nama_folder = 'a4/' . $validData['id_a4'];

        // menggantin nama file dengan yang didefiniskan ($nama_file) agar mudah saat pemanggilan di view
        $validData['file_a4'] = $nama_file;

        // casting str to int
        $validData['jenis_a4'] = (int) $request->jenis_a4;

        // mengisi default value
        $validData['status_a4'] = 4;
        $validData['soft_delete'] = 0;
        $validData['created_by'] = $personid;
        $validData['updated_by'] = $personid;

        A4::create($validData);

        // menyimpan file ke storage/app/public
        $request->file_a4->storeAs($nama_folder, $nama_file);

        return redirect('/4a')->with('success', 'Laporan Berhasil Ditambahkan!');
    }

    public function destroy($id_a4)
    {
        A4::where('id_a4', $id_a4)->update(['soft_delete' => 1]);
        return redirect('/4a')->with('success', 'Laporan Berhasil Dihapus!');
    }

    public function edit(Request $request, $id_a4)
    {
        // mengambil person untuk eksekusi mata kuliah berdasarkan prodi
        $personid = $request->session()->get('id_sp');
        // mengambil prodi semua pts
        $program_studi = DB::select("EXEC lldikti9dev.dbo.p_prodi_pt @id_sp = '" . $personid . "'");
        // mengambil 1 data
        $item = DB::table('a4_laporan')->where('id_a4', $id_a4)->first();

        if ($item->id_kurikulum) {
            $kurikulum = DB::select("SELECT * FROM pddikti.dbo.kurikulum_sp WHERE soft_delete=0 AND id_sms='" . $item->id_sms . "'");
            $matkul = DB::select("SELECT k.id_kurikulum_sp, m.id_mk, m.kode_mk, m.nm_mk, k.smt, m.jns_mk, k.a_wajib 
            FROM pddikti.dbo.matkul_kurikulum k JOIN pddikti.dbo.matkul m 
            ON m.id_mk=k.id_mk 
            WHERE m.soft_delete=0 AND k.soft_delete=0 AND id_kurikulum_sp='" . $item->id_kurikulum . "'");
        }

        return view('4a.edit', [
            'tab_name' => 'Edit 4A',
            'main_menu' => '4A',
            'sub_menu' => 'Edit',
            'program_studi' => $program_studi,
            'kurikulum' => $kurikulum,
            'matkul' => $matkul,
            'data' => $item
        ]);
    }

    public function update(Request $request, $id_a4)
    {
        // mengambil person untuk eksekusi mata kuliah berdasarkan prodi
        $personid = $request->session()->get('id_sp');

        // inisialisasi rules
        $rules = [
            'kegiatan_a4' => 'required',
            'id_sms' => 'required',
            'tgl_berlaku' => 'required',
            'tgl_kadaluarsa' => 'required',
            'noreg_pj' => 'required|max:12',
            'nama_pj' => 'required|max:100',
            'nohp_pj' => 'required|max:15'
        ];

        // membedakan rules kegiatan dan mata kuliah
        if ($request->id_kurikulum) {
            $rules['id_kurikulum'] = 'required';
            $rules['id_matkul'] = 'required';
        } else {
            $rules['kegiatan_a4'] = 'required';
        }

        // kalau filenya diperbarui maka tambahkan rules untuk fila_a4
        if ($request->file_a4) {
            $rules['file_a4'] = 'required|mimes:pdf|max:512';
        }

        // validasi
        $validData = $request->validate($rules);

        // mengambil 1 data karena ada beberapa data yang tidak di ubah dan tidak ada input di requesy
        $item = DB::table('a4_laporan')->where('id_a4', $id_a4)->first();

        $nama_folder = '';
        if ($request->file_a4) {
            // membuat nama file berdasarkan waktu agar ketika melakukan upload kembali
            // file sebelumnya tidak terhapus karena waktu berjalan terus
            $nama_file = date('Y-m-d H:i:s') . '_' . $request->file_a4->getClientOriginalName();
            $nama_folder = 'a4/' . $id_a4;

            $validData['file_a4'] = $nama_file;
        }

        // belum bisa update file
        $validData['id_a4'] = $id_a4;

        $validData['status_a4'] = 4;
        $validData['soft_delete'] = 0;
        $validData['created_by'] = $item->created_by;
        $validData['updated_by'] = $personid;

        A4::where('id_a4', $id_a4)->update($validData);

        if ($request->file_a4) {
            // menyimpan file ke storage/app/public
            $request->file_a4->storeAs($nama_folder, $nama_file);
        }

        return redirect('/4a')->with('success', 'Laporan Berhasil Diperbarui!');
    }

    public function ajukan_kembali($id_a4)
    {
        A4::where('id_a4', $id_a4)->update(['status_a4' => 4]);
        return redirect('/4a')->with('success', 'Laporan Berhasil Diajukan Kembali!');
    }

    public function getKurikulum(Request $request)
    {
        $query = DB::select("SELECT * FROM pddikti.dbo.kurikulum_sp WHERE soft_delete=0 AND id_sms='" . $request->id_sms . "'");
        $query = collect($query)->pluck('nm_kurikulum_sp', 'id_kurikulum_sp');
        return response()->json($query);
    }

    public function getMataKuliah(Request $request)
    {
        $query = DB::select("SELECT k.id_kurikulum_sp, m.id_mk, m.kode_mk, m.nm_mk, k.smt, m.jns_mk, k.a_wajib 
                            FROM pddikti.dbo.matkul_kurikulum k JOIN pddikti.dbo.matkul m 
                            ON m.id_mk=k.id_mk 
                            WHERE m.soft_delete=0 AND k.soft_delete=0 AND id_kurikulum_sp='" . $request->id_kurikulum_sp . "'");
        $query = collect($query)->pluck('nm_mk', 'id_mk');
        return response()->json($query);
    }

    public function preview($id_a4)
    {
        $semua_laporan = DB::select("SELECT m.kode_prodi, m.nm_lemb [prodi], j.nm_jenj_didik [jenjang], 
        k.nm_kurikulum_sp, l.kode_mk, l.nm_mk, l.sks_mk, a.*
        from (select * from lldikti9dev.dbo.a4_laporan where soft_delete=0) a 
        inner join (select * from pddikti.dbo.sms where soft_delete=0) m on m.id_sms=a.id_sms 
        inner join pddikti.ref.jenjang_pendidikan j on j.id_jenj_didik=m.id_jenj_didik 
        left join (select * from pddikti.dbo.kurikulum_sp where soft_delete=0) k on k.id_kurikulum_sp=a.id_kurikulum 
        left join (select * from pddikti.dbo.matkul where soft_delete=0) l on l.id_mk=a.id_matkul");

        $item = collect($semua_laporan)->where('id_a4', $id_a4)->first();

        return view('4a.preview', [
            'tab_name' => 'Preview 4A',
            'main_menu' => '4A',
            'sub_menu' => 'Preview',
            'item' => $item,
        ]);
    }

    public function cetak(Request $request)
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
        AND " . $request->tahun . " BETWEEN YEAR (tgl_berlaku) AND YEAR (tgl_kadaluarsa)
        AND status_a4 in (" . $request->valid . ") GROUP BY id_sms) n ON m.id_sms = n.id_sms");

        $query_kedua = DB::select("SELECT * FROM (SELECT * FROM lldikti9dev.dbo.a4_laporan
        WHERE status_a4 in (" . $request->valid . ") AND " . $request->tahun . " BETWEEN YEAR (tgl_berlaku) AND YEAR(tgl_kadaluarsa)) m
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

        $nama_institusi = DB::select("SELECT TOP 1 nm_lemb FROM pddikti.dbo.satuan_pendidikan WHERE id_sp = '" . $request->id_sp . "'");
        $nama_institusi = collect($nama_institusi)->first()->nm_lemb;
        // return $query;
        return view('4a.cetak', [
            'nama_institusi' => $nama_institusi,
            'data' => $query,
            'jumlah_laporan' => $jumlah_laporan,
            'rata_capaian' => $rata_capaian
        ]);
    }
}
