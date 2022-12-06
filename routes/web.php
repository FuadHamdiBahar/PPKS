<?php

use App\Http\Controllers\A4Controller;
use App\Http\Controllers\Admin4AController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPPKSController;
use App\Http\Controllers\apiController;
use App\Http\Controllers\PPKSController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Storage;

use Barryvdh\DomPDF\Facade\Pdf as PDF;

// SSO
Route::get('/logout', function (Request $request) {
    $request->session()->put('logged_in', false);
    $request->session()->put('user_id', null);
    $request->session()->put('username', null);

    return redirect('http://ssodev.lldikti9.id/access/logout');
});


// DD
Route::get('/dd', function () {
    // $query = DB::table('a4_laporan')->get();
    // $query = DB::select("SELECT * FROM pddikti.dbo.kurikulum_sp WHERE soft_delete=0 AND id_sms='FEB15FC3-38F3-4511-B8A0-15189B74AA6B'");
    // $query = collect($query)->where('id_sms', '1A0E8F73-412F-45A0-9C92-FF17261FB93C');
    // $query = DB::select("SELECT m.id_mk, m.kode_mk, m.nm_mk, k.smt, m.jns_mk, k.a_wajib 
    // FROM pddikti.dbo.matkul_kurikulum k JOIN pddikti.dbo.matkul m 
    // ON m.id_mk=k.id_mk 
    // WHERE m.soft_delete=0 AND k.soft_delete=0 AND id_kurikulum_sp='8DA1ECBF-35AC-40DC-9C22-0000D1E11C34'");
    $query = DB::select("SELECT m.kode_prodi, m.prodi, m.jenjang, a1, a2, a3, a4,
    (CONVERT(FLOAT,IIF(a1>0,1,0)+IIF(a2>0,1,0)+IIF(a3>0,1,0)+IIF(a4>0,1,0)))/4*100 [persen]
    FROM (SELECT id_sms, kode_prodi, nm_lemb [prodi], s.id_jenj_didik [jenjang]
    FROM pddikti.dbo.sms s INNER JOIN pddikti.[ref].jenjang_pendidikan jp on jp.id_jenj_didik = s.id_jenj_didik 
    WHERE s.soft_delete = 0
        AND s.id_jns_sms = 3
        AND s.stat_prodi IN ('A', 'N')
        AND s.id_jenj_didik IN (20, 21, 22, 23, 30)
        AND s.id_sp = '2C56EF95-0194-410B-A7A6-704471B27452') m
    LEFT JOIN
    (SELECT id_sms, 
        SUM(IIF(jenis_a4=1,1,0)) [a1],
        SUM(IIF(jenis_a4=2,1,0)) [a2],
        SUM(IIF(jenis_a4=3,1,0)) [a3],
        SUM(IIF(jenis_a4=4,1,0)) [a4]
    FROM lldikti9dev.dbo.a4_laporan al 
    WHERE soft_delete = 0
        AND 2022 BETWEEN YEAR (tgl_berlaku) AND YEAR (tgl_kadaluarsa)
        AND status_a4 = 4
    GROUP BY id_sms) n ON m.id_sms = n.id_sms");

    return ($query);
});

Route::get('/', function (Request $request) {
    $rekap_4a = DB::select("SELECT al.jenis_a4, COUNT(al.jenis_a4) as Jumlah FROM lldikti9dev.dbo.a4_laporan al GROUP BY al.jenis_a4");

    return view('dashboard', [
        'tab_name' => 'Dashboard',
        'main_menu' => 'Dashboard',
        'sub_menu' => 'Dokumentasi',
        'rekap' => $rekap_4a,
        // 'rekap_laporan' => $rekap_laporan
    ]);
})->middleware('LoginSSO');


// 4A
Route::middleware(['LoginSSO'])->group(function () {
    Route::prefix('/4a')->group(function () {
        Route::get('/rekap', [A4Controller::class, 'rekap'])->name('4arekap');
        Route::get('', [A4Controller::class, 'index'])->name('4aindex');
        Route::post('', [A4Controller::class, 'store'])->name('4a.store');
        Route::get('/create', [A4Controller::class, 'create'])->name('4a.create');
        Route::get('/creates', [A4Controller::class, 'creates'])->name('4a.creates');
        Route::get('/{id_sms}', [A4Controller::class, 'show'])->name('4a.show');
        Route::put('/{id_a4}', [A4Controller::class, 'update'])->name('4a.update');
        Route::delete('/{id_a4}', [A4Controller::class, 'destroy'])->name('4a.destroy');
        Route::get('/{id_a4}/edit', [A4Controller::class, 'edit'])->name('4a.edit');
        Route::put('/{id_a4}/ajukan_kembali', [A4Controller::class, 'ajukan_kembali']);

        Route::get('/{id_a4}/preview', [A4Controller::class, 'preview']);
        Route::get('/cetak/{id_sp}/{valid}/{tahun}', [A4Controller::class, 'cetak']);
    });
});

Route::get('/4a/download/{id_a4}/{nama_file}', function ($id_a4, $nama_file) {
    $path = 'a4/' . $id_a4 . '/' . $nama_file;

    return Storage::download($path);
});

Route::get('/getKurikulum', [A4Controller::class, 'getKurikulum'])->name('getKurikulum');
Route::get('/getMataKuliah', [A4Controller::class, 'getMataKuliah'])->name('getMataKuliah');

// PPKS
Route::middleware(['LoginSSO'])->group(function () {
    Route::prefix('/ppks')->group(function () {
        Route::get('/rekap', [PPKSController::class, 'rekap'])->name('ppksrekap');
        Route::get('', [PPKSController::class, 'index'])->name('ppksindex');
        Route::post('', [PPKSController::class, 'store'])->name('ppks.store');
        Route::get('/create', [PPKSController::class, 'create'])->name('ppks.create');
        Route::get('/{id_inpp}', [PPKSController::class, 'show'])->name('ppks.show');
        Route::put('/{id_ppks}', [PPKSController::class, 'update'])->name('ppks.update');
        Route::delete('/{id_ppks}', [PPKSController::class, 'destroy'])->name('ppks.destroy');
        Route::get('/{id_ppks}/edit', [PPKSController::class, 'edit'])->name('ppks.edit');
        Route::put('/{id_ppks}/ajukan_kembali', [PPKSController::class, 'ajukan_kembali']);

        Route::get('/{id_ppks}/preview', [PPKSController::class, 'preview']);
        Route::get('/cetak/{id_sp}/{valid}/{tahun}', [PPKSController::class, 'cetak']);
    });
});

Route::get('/ppks/download/{id_ppks}/{nama_file}', function ($id_ppks, $nama_file) {
    $path = 'ppks/' . $id_ppks . '/' . $nama_file;
    return Storage::download($path);
});

// LLDIKTI
Route::prefix('/admin/ppks')->group(function () {
    Route::get('', [AdminPPKSController::class, 'laporanPPKS'])->name('adminppks');
    Route::get('/{id_ppks}', [AdminPPKSController::class, 'show']);
    Route::put('/{id_ppks}', [AdminPPKSController::class, 'validPPKS']);
    Route::delete('/{id_ppks}', [AdminPPKSController::class, 'tolakPPKS']);

    Route::get('/valid/{id_ppks}', [AdminPPKSController::class, 'show2']);
});

Route::prefix('/admin/4a')->group(function () {
    Route::get('', [Admin4AController::class, 'index'])->name('admin4a');
    Route::get('/{id_4a}', [Admin4AController::class, 'show']);
    Route::put('/{id_4a}', [Admin4AController::class, 'valid']);
    Route::delete('/{id_4a}', [Admin4AController::class, 'tolak']);

    Route::get('/valid/{id_4a}', [Admin4AController::class, 'show2']);
});

Route::get('/overview4A', [AdminController::class, 'overview4A'])->name('overview4A');
Route::get('/overview4A/{id_sp}', [AdminController::class, 'detailOverview4A']);
Route::get('/overviewPPKS', [AdminController::class, 'overviewPPKS'])->name('overviewPPKS');
Route::get('/overviewPPKS/{id_sp}', [AdminController::class, 'detailOverviewPPKS'])->name('detailOverviewPPKS');

// API
Route::get('/a4Api/{id_sp}/{valid?}/{tahun?}', [AdminController::class, 'a4Api'])->name('a4Api');
Route::get('/someData', [AdminController::class, 'someData'])->name('someData');

Route::get('/ppksApi/{valid?}/{tahun?}', [AdminController::class, 'ppksApi'])->name('ppksApi');

Route::get('/cek/{id_sp}/{valid}/{tahun}', function (Request $request) {
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

    $pdf = PDF::loadView('4a.cetak', [
        'data' => $query,
        'jumlah_laporan' => $jumlah_laporan,
        'rata_capaian' => $rata_capaian
    ]);

    return $pdf->stream();
});

Route::prefix('/api')->group(function () {
    Route::prefix('/a4')->group(function () {
        Route::get('/rekap/{id_sp}/{valid}/{year}', [apiController::class, 'a4_rekap'])->name('a4_rekap');
    });
    Route::prefix('/ppks')->group(function () {
        Route::get('/rekap/{id_sp}/{valid}/{year}', [apiController::class, 'ppks_rekap'])->name('ppks_rekap');
    });
    Route::prefix('/admin')->group(function () {
        Route::get('/overview/a4/{valid}/{year}', [apiController::class, 'overview_4a'])->name('overview-4a');
        Route::get('/overview/ppks/{valid}/{year}', [apiController::class, 'overview_ppks'])->name('overview_ppks');
    });
});
