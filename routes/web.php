<?php

use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
// use Monolog\Handler\RotatingFileHandler;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\CMstDistribusi;
use App\Http\Controllers\CLoginUser;
use App\Http\Controllers\CProeseMIV;
use App\Http\Controllers\CProeseMIVTxt;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     Log::info('Sukses : test info mang adis.');
//     // Log::warning('Something could be going wrong.');
//     // Log::error('Something is really going wrong.');

//     return view('vhome', [
//         'title' => 'Home'
//     ]);
// });

// ---------------------------------------------------------------
// -- (1) Area LOGIN APP / AUTH USER TOKEN
// ---------------------------------------------------------------
//====================================================================================================================================
Route::get('/', function (Request $request) {
    // $data = $request->session()->all();
    // dd($request->session()->get('_datalogin.kode'));
    if (($request->session()->exists('_datalogin')) && ($request->session()->get('_datalogin.kode') == 200)) {
        $msg = $request->session()->get('_datalogin.message');
        return view('dashboards/vDashboardPerDist', ['title' => 'Home', 'message' => $msg]);
    } else {
        $data = $request->session()->all();
        // dd($data);
        return view('layouts/login', ['title' => 'Login', 'message' => '']);
    }
});

Route::get('/login', function (Request $request) {
    // $request->session()->invalidate();
    // dd($request->session()->invalidate());
    // return view('layouts/login', ['title' => 'Login', 'message' => '']);
    if (($request->session()->exists('_datalogin')) && ($request->session()->get('_datalogin.kode') == 200)) {
        $msg = $request->session()->get('_datalogin.message');
        return view('dashboards/vDashboardPerDist', ['title' => 'Home', 'message' => $msg]);
    } else {
        $data = $request->session()->all();
        // dd($data);
        return view('layouts/login', ['title' => 'Login', 'message' => '']);
    }
});

Route::post('/clear-err-msg', function () {
    session()->forget('err_msg');
    return response()->json(['message' => 'Session berhasil dihapus']);
});

// Route::get('/users', function () {
//     return config('myconfig.variable.SVR_URL_API');
// });

Route::post('/loginuser', [CLoginUser::class, 'actionlogin']);
Route::get('/logoutuser', [CLoginUser::class, 'actionlogout']);

Route::get('/home', [CMstDistribusi::class, 'GetApiMstDistribusi'])->name('home');
Route::get('/dasboardperdist', [CMstDistribusi::class, 'GetApiMstDistribusi'])->name('dasboardperdist');
Route::get('/showmstdist', [CMstDistribusi::class, 'ShowApiMstDistribusi']);

// Route::get('/login', function (Request $request) {
//     if ($request->ajax()) {
//         $ChekLoginUser = http::post(
//             'http://mivp2apstpln-api-v2.test/api/mivp2apstpln/login',
//             [
//                 'username' => 'adis',
//                 'password' => 'adis1234'
//             ]
//         );
//         dd($ChekLoginUser);
//     }
// })->name('actionlogin');

Route::get('getmstdistribusi', function (Request $request) {
    if ($request->ajax()) {
        $MstDistData = http::get(config('myconfig.variable.SVR_URL_API') . 'getmstdistribusi');
        // return $MstDistData['data'];
        // return DataTables::of($MstDistData['data'])->make(true);
        // dd($MstDistData['data']);
        return DataTables::of($MstDistData['data'])
            ->addIndexColumn()
            // ->addColumn('action', function ($row) {
            //     $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
            //     return $actionBtn;
            // })
            // ->rawColumns(['action'])
            ->make(true);
    }
})->name('monlap.mstdistribusi');

// ---------------------------------------------------------------
// -- (2) Area Dasboard Menu
// ---------------------------------------------------------------
//====================================================================================================================================
Route::get('getdasboardperdist', function (Request $request) {
    if ($request->ajax()) {
        $blthlaporan      = $request->input('vblthlaporan');
        // print_f($blthlaporan);
        // http://mivp2apstpln-api-v2.test/api/mivp2apstpln/mivlunasflagalldist
        $MyData = http::withToken($request->Session()->get('_datalogin.data.token'))
            ->post(
                config('myconfig.variable.SVR_URL_API') . 'mivlunasflagalldist',
                [
                    // 'blthlaporan' => '202303'
                    'blthlaporan' => $blthlaporan
                ]
            );
        return $MyData;
        // return DataTables::of($MstDistData['data'])->make(true);
        // dd($MyData);
        // return DataTables::of($MyData['data'])
        //     ->addIndexColumn()
        //     // ->addColumn('kd_nama_dist', function ($data) {
        //     //     return  $data->DIST;
        //     // })
        //     // ->addColumn('action', function ($row) {
        //     //     $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
        //     //     return $actionBtn;
        //     // })
        //     // ->rawColumns(['action'])
        //     ->make(true);
    }
})->name('dashboard.flagperdist');

// ---------------------------------------------------------------
// -- (3) Area Master-Master Menu
// ---------------------------------------------------------------
//====================================================================================================================================
//Master wilayah/Distribusi pln
Route::get('/masterdist', function (Request $request) {
    $kddist      = $request->input('vkddist');
    $comboup3 =  http::withToken($request->Session()->get('_datalogin.data.token'))
        ->post(
            config('myconfig.variable.SVR_URL_API') . 'getmstunitap',
            [
                'kddist' => $kddist
            ]
        )->json();
    // dd($comboup3);
    return $comboup3['data'];
})->name('master.mst_wilayah');


//Master Area pln / Unit Pelaksana Pelayanan Pelanggan (UP3)
Route::POST('/masterup3', function (Request $request) {
    $kddist      = $request->input('vkddist');
    $comboup3 =  http::withToken($request->Session()->get('_datalogin.data.token'))
        ->post(
            config('myconfig.variable.SVR_URL_API') . 'getmstunitap',
            [
                'kddist' => $kddist
            ]
        )->json();
    // dd($comboup3);
    return $comboup3['data'];
})->name('master.mst_up3');

//Master Bank MIV
Route::POST('/masterbankmiv', function (Request $request) {
    $kdbank      = 'ALL'; 
    // $request->input('vkdbank');
    $combobankmiv = http::withToken($request->Session()->get('_datalogin.data.token'))
            ->post(
                config('myconfig.variable.SVR_URL_API') . 'getmstbankmiv',
                [
                    'kdbank' => $kdbank 
                ]
            )->json();
    // dd($comboup3);
    return $combobankmiv;
})->name('master.mst_bankmiv');


//Master Bank MIV
Route::POST('/masteruserpetugasrcn', function (Request $request) {
    $tglawal = $request->input('tglawal');
    $tglakhir = $request->input('tglakhir');
    $userid = $request->input('userid');

    $combobankmiv = http::withToken($request->Session()->get('_datalogin.data.token'))
            ->post(
                config('myconfig.variable.SVR_URL_API') . 'getmstuserlogrcnnmiv',
                [
                    'tglawal'  => $tglawal,
                    'tglakhir' => $tglakhir,
                    'userid'   => $userid
                ]
            )->json();
    // dd($comboup3);
    return $combobankmiv;
})->name('master.mst_userpetugasrcn');

// ---------------------------------------------------------------
// -- (4) Area MIV PROSES Menu
// ---------------------------------------------------------------
//====================================================================================================================================

// 4a1 Download proses file rcn Bank
//=======================================================================
Route::get('/ProsesFileRCNBank', function (Request $request) {
    try {
        return view('mivproses/vProsesFileRCNBank', [
            'menuname' => 'MIV - Proses/File RCN Bank',
            'title'    => 'Proses File RCN Bank MIV'
        ]);
    } catch (\Exception $e) {
        return redirect('/login')->with([
            'SessionMessage' => 'Session expired, silahkan login ulang!',
            'error' => $e->getMessage()
        ]);
    }
});


//test FTP http://mivp2apstpln-web-v3.test/test-ftp
Route::get('/test-ftp', function () {
    try {
        $files = Storage::disk('ftp')->allFiles('/');
        return response()->json(['status' => 'success', 'files' => $files]);
    } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
    }
});

//4a2  baca list file *.rcn yang ada fi ftp
//=======================================================================
Route::get('/list-ftp-files-rcn', [CProeseMIV::class, 'get_list_ftp_files_rcn'])->name('mproses.daftar-file-ftp-rcn');

//4a3  baca list file *.rcn yang ada di ftp dan lakukan insert db miv dan
//=======================================================================
//  - move file rcn ke dari folder lunas ke lunas\proses jika ada data yg dinsert ke db jika sudah ada file di folder
//    lunas\proses lakukan rename menambahkan seq contoh
//    POS5215020220908016-20220917-200CA01.rcn menjadi POS5215020220908016-20220917-200CA01_R001.rcn
//    POS5215020220908016-20220917-200CA01.rcn.ctl menjadi POS5215020220908016-20220917-200CA01_R001.rcn.ctl
//  - jika sudah ada di db semuanya tanpa berhasil 1 pun masuk ke lunas/gagal dan jika sudah ada nama file tambahka _Rxxx = XXX = Seq
Route::get('/proses-ftp-files-rcn', [CProeseMIV::class, 'proses_file_rcn'])->name('mproses.proses-file-ftp-rcn');

//4a3  baca log data hasil download perBank/PerPetugas isi file *.rcn yang ada di database hasil download proses
//=======================================================================
Route::get('/cari-log-db-rcn', [CProeseMIV::class, 'cari_log_db_rcn'])->name('mproses.cari-log-db-rcn');

// 4b1 tampilkan view upload kirm ulang file txt miv ke bank (bank gagal download file dan ke delete/gagal)
//=======================================================================
Route::get('/ProsesKirimUlangFileTXTBank', function (Request $request) {
    return view('mivproses/vProsesKirimUlangFileTXTBank', [
        'menuname'      => 'MIV - Proses/File RCN Bank',
        'title'         => 'Proses Kirim Ulang File TXT Ke Bank MIV'
    ]);
});

//4b2 script untuk buat nama file *.txt dan *.txt.ctl
//=======================================================================
Route::get('/proses-nama-files-txt', [CProeseMIVTxt::class, 'buat_nama_files_txt_miv'])->name('mproses.proses-nama-file-txt');

//4b3 script untuk isi file data yang belum lunas aja dari db MIV nousulan file txt
//=======================================================================
Route::get('/proses-detail-files-txt', [CProeseMIVTxt::class, 'buat_detail_files_txt_miv'])->name('mproses.proses-detail-file-txt');

//4b4 script untuk rekap file data yang belum lunas aja dari db MIV nousulan file txt.ctl
//=======================================================================
Route::get('/proses-rekap-files-txt', [CProeseMIVTxt::class, 'buat_rekap_files_txt_miv'])->name('mproses.proses-rekap-file-txt');

//4b5 Create file *.txt
//=======================================================================
Route::get('/proses-file-txt_pos', [CProeseMIVTxt::class, 'proses_file_txt_pos'])->name('mproses.proses-file-txt-pos');




// ---------------------------------------------------------------
// -- (5) Area MIV MONITORING DAN LAPORAN Menu
// ---------------------------------------------------------------
//====================================================================================================================================
//1a Data Belum Lunas Bank
// Route::controller(CMonLaporanMiv::class)->group(function () {
//     Route::get('/mivp2apstpln/getmstdistribusi', 'monlap_get_distribusi');
// });

Route::get('/DaftarBelumFlagBank', function (Request $request) {
    try {
        // run your code here
        $combobankmiv = http::withToken($request->Session()->get('_datalogin.data.token'))
            ->post(
                config('myconfig.variable.SVR_URL_API') . 'getmstbankmiv',
                [
                    'kdbank' => 'ALL'
                ]
            )->json();
        // dd($combobankmiv['data']);

        return view('mivmonlap/vDaftarBelumFlagBank', [
            'menuname' => 'MIV - Monitoring/Laporan',
            'title' => 'Daftar Belum Flag Bank',
            'combobankmiv' =>  $combobankmiv['data']
        ]);
    } catch (exception $e) {
        return redirect('/login')->with(['SessionMessage' => 'Session expired, silahkan login ulang !']);
    }
});

// ---------------------------------------------------------------
//1b ambil data
//=======================================================================
Route::get('getDaftarBelumFlagBank', function (Request $request) {
    if ($request->ajax()) {
        $blthlaporan      = $request->input('vblthlaporan');
        $kodebank         = $request->input('vkdbank');
        // print_f($blthlaporan . '---' . $kodebank);
        $MyData = http::withToken($request->Session()->get('_datalogin.data.token'))
            ->post(
                config('myconfig.variable.SVR_URL_API') . 'mivbelumflag',
                [
                    // 'blthlaporan' => '202303'
                    'blthlaporan' => $blthlaporan,
                    'kdbank'    => $kodebank
                ]
            )->json();
        // return $MstDistData['data'];
        // return DataTables::of($MstDistData['data'])->make(true);
        // dd($MyData);

        return $MyData;

        // if (Str::upper($MyData['status']) == Str::upper('Error')) {
        //     return $MyData;
        // } else {
        //     return DataTables::of($MyData['data'])
        //         ->addIndexColumn()
        //         // ->addColumn('kd_nama_dist', function ($data) {
        //         //     return  $data->DIST;
        //         // })
        //         // ->addColumn('action', function ($row) {
        //         //     $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
        //         //     return $actionBtn;
        //         // })
        //         // ->rawColumns(['action'])
        //         ->make(true);
        // }
    }
})->name('monlap.daftarbelumflagbank');

// ---------------------------------------------------------------
//2 Daftar Rekon PLN vs bank file rcn vs olap lunas
Route::get('/DaftarRekonPlnvsBank', function (Request $request) {
    //21 ambil master bank MIV
    // $combobankmiv = file_get_contents(URL::to('master.mst_wilayah'));
    // $combodistpln = Route::getRoutes()->getByName('master.mst_wilayah')->uri();
    // dd($combodistpln);

    // GET Request
    // $response = Http::get(route('master.mst_wilayah'));

    // $combodistpln = http::post(
    //     $request->url() . Route::getRoutes()->getByName('master.mst_wilayah')->uri()
    // )->json();

    //22 ambil master wilayah/distribusi PLN
    $combobankmiv = http::withToken($request->Session()->get('_datalogin.data.token'))
        ->post(
            config('myconfig.variable.SVR_URL_API') . 'getmstbankmiv'
        );


    $combodistpln =  http::withToken($request->Session()->get('_datalogin.data.token'))
        ->post(
            config('myconfig.variable.SVR_URL_API') . 'getmstdistribusi'
        )->json();
    // dd($combodistpln);

    $mydatacombo = [
        'combobankmiv' => $combobankmiv['data'],
        'combodistpln' => $combodistpln['data']
    ];

    return view('mivmonlap/vDaftarRekonPlnvsBank', [
        'menuname' => 'MIV - Monitoring/Laporan',
        'title' => 'Daftar Permohonan/Rekon PLN vs. BANK PerWilayah',
        'mycombo' => $mydatacombo
    ]);
});

//2b ambil API data rekon PLN vs bank MIV
Route::get('getdaptarrekonplnvsbank', function (Request $request) {
    if ($request->ajax()) {
        $blthlaporan      = $request->input('vblthlaporan');
        $kodebank         = $request->input('vkodebank');
        $kddist           = $request->input('vkddist');
        $kdarea           = $request->input('vkdarea');
        // print_f($blthlaporan . '---' . $kodebank);
        $MyData = http::withToken($request->Session()->get('_datalogin.data.token'))
            ->post(
                config('myconfig.variable.SVR_URL_API') . 'mivrekonplnvsbankuiw',
                [
                    // 'blthlaporan' => '202303'
                    'blthlaporan' => $blthlaporan,
                    'kdbank' => $kodebank,
                    'kddist' => $kddist,
                    'kdarea' => $kdarea
                ]
            )->json();
        // return $MstDistData['data'];
        // return DataTables::of($MstDistData['data'])->make(true);
        // dd($MyData);

        return $MyData;
    }
})->name('monlap.daptarrekonplnvsbank');


// ---------------------------------------------------------------
//3a Data Belum Lunas Bank
Route::get('/RekapLunasPerDist', function () {
    return view('mivmonlap/vRekapLunasPerDist', [
        'title' => 'Rekap/Daftar Lunas Per-Distribusi/Wilayah'
    ]);
});

// ---------------------------------------------------------------
//4a Status data pelanggan SAKTI KEU. RI
Route::get('/RekapStatusSakti', function () {
    return view('mivmonlap/vRekapStatusSakti', [
        'menuname' => 'MIV - Monitoring/Laporan',
        'title' => 'Rekap/Daftar Status Pelanggan Sakti'
    ]);
});

//4b ambil API data status sakti
Route::get('getrekapstatussakti', function (Request $request) {
    if ($request->ajax()) {
        $blthlaporan      = $request->input('vblthlaporan');
        $kodebank         = $request->input('vkodebank');
        // print_f($blthlaporan . '---' . $kodebank);
        $MyData = http::withToken($request->Session()->get('_datalogin.data.token'))
            ->post(
                config('myconfig.variable.SVR_URL_API') . 'saktistatus',
                [
                    // 'blthlaporan' => '202303'
                    'blthlaporan' => $blthlaporan
                ]
            )->json();
        // return $MstDistData['data'];
        // return DataTables::of($MstDistData['data'])->make(true);
        // dd($MyData);

        return $MyData;
    }
})->name('monlap.rekapstatussakti');

//5a Report Cetak/download pdf struk MIV
Route::get('/RepCetakStrukMIV', function (Request $request) {
    $combobankmiv = http::withToken($request->Session()->get('_datalogin.data.token'))
        ->post(
            config('myconfig.variable.SVR_URL_API') . 'getmstbankmiv',
            [
                'kdbank' => 'ALL'
            ]
        )->json();
    // dd($combobankmiv['data']);
    //22 ambil master wilayah/distribusi PLN
    $combobankmiv = http::withToken($request->Session()->get('_datalogin.data.token'))
        ->post(
            config('myconfig.variable.SVR_URL_API') . 'getmstbankmiv'
        );


    $combodistpln =  http::withToken($request->Session()->get('_datalogin.data.token'))
        ->post(
            config('myconfig.variable.SVR_URL_API') . 'getmstdistribusi'
        )->json();
    // dd($combodistpln);

    $mydatacombo = [
        'combobankmiv' => $combobankmiv['data'],
        'combodistpln' => $combodistpln['data']
    ];

    return view('mivmonlap/vRepCetakStrukLunasMiv', [
        'menuname' => 'MIV - Download/Cetak Struk PerArea',
        'title' => 'Download/Cetak Struk PerArea',
        'combobankmiv' =>  $combobankmiv['data'],
        'mycombo' => $mydatacombo
    ]);
});

//5b1 Chek koneksi ftp
Route::get('/check-ftp-connection', function () {
    try {
        // Path FTP yang akan dicek
        $path = '/vertikal/2000001/200CA01/POSTPAID/lunas/struk';
        // /vertikal/2000001/200CA01/POSTPAID/lunas/struk
        $files = Storage::disk('ftp')->files($path);

        // Cek apakah ada file di dalam path
        if (empty($files)) {
            return response()->json([
                'success' => true,
                'message' => 'Tidak ada file di path tersebut.'
            ]);
        }

        // Jika ada file
        return response()->json([
            'success' => true,
            'message' => 'Ada file di path tersebut.',
            'files' => $files
        ]);
    } catch (\Exception $e) {
        // Jika gagal, kembalikan pesan error
        return response()->json([
            'success' => false,
            'message' => 'Koneksi FTP gagal: ' . $e->getMessage()
        ]);
    }
});

//5b2 baca list file struk yang ada fi ftp
Route::get('/list-ftp-files', function (Request $request) {
    $blthlaporan      = $request->input('vblthlaporan');
    list($vkdbank, $kderp) = explode('|', $request->input('vkdbank'));
    $kdbank           = $vkdbank . 'CA01';
    $uiw              = $request->input('vuiw');
    $up3              = $request->input('vup3');
    $directories = [
        '/vertikal/' . $kderp . '/' . $kdbank . '/POSTPAID/lunas/struk',
        '/vertikal/' . $kderp . '/' . $kdbank . '/NTLS/lunas/struk',
        '/vertikal/' . $kderp . '/' . $kdbank . '/PREPAID/lunas/struk',
    ];

    $mydatafile = [];
    $kdstatus = '404'; // Inisialisasi status awal
    $msg = "Gagal koneksi ke FTP atau file tidak ditemukan";
    $success = false;

    try {
        // Loop melalui setiap direktori
        foreach ($directories as $directory) {
            // Ambil semua file di direktori
            // $files = Storage::disk('ftp')->allFiles($directory);
            $files = Storage::disk('ftp')->Files($directory);

            // Cek apakah ada file di dalam direktori
            if (!empty($files)) {
                foreach ($files as $file) {
                    if (pathinfo($file, PATHINFO_EXTENSION) === 'pdf') {
                        $namafile = pathinfo($file, PATHINFO_BASENAME);
                        $vfile_uiw = substr($namafile, 3, 2);
                        $vfile_up3 = substr($namafile, 3, 5);
                        $vfile_crt = substr($namafile, 8, 6);

                        if (($vfile_crt === $blthlaporan) && ($vfile_uiw === $uiw) &&
                            (($vfile_up3 === $up3) || ($up3 === 'ALL'))
                        ) {
                            $success = true;
                            $kdstatus = '200';
                            $msg = 'Sukses, file ditemukan.';
                            $mydatafile[] = [
                                'path'      => $directory,
                                'file'      => $namafile,
                                'file_uiw'  => $vfile_uiw,
                                'file_up3'  => $vfile_up3,
                                'file_crt'  => $vfile_crt,
                                'status'    => 'Sukses Baca File di FTP'
                            ];
                        }
                    }
                }
            }
        }

        // Jika tidak ada file yang ditemukan
        if (empty($mydatafile)) {
            $kdstatus = '404';
            $msg = 'Gagal, Tidak ada file Terbaca. ';
        }
    } catch (\Exception $e) {
        // Tangani kesalahan koneksi FTP
        $kdstatus = '500';
        $msg = 'Gagal Koneksi FTP: ' . $e->getMessage();
    }

    // Data respons
    $mydata = [
        'directories_checked' => $directories,
        'status'              => $kdstatus,
        'success'             => $success,
        'message'             => $msg,
        'downloaded_files'    => $mydatafile,
        'vblthlaporan'        => $blthlaporan,
        'vkdbank'             => $kdbank,
        'vkderp'              => $kderp,
        'vuiw'                => $uiw,
        'vup3'                => $up3
    ];

    return response()->json($mydata);
})->name('monlap.daftar-file-ftp');


//5c download file lebih dari 1 atau 1 struk pdf
Route::get('/download-struk-pdf', function (Request $request) {

    // Replace 'your_remote_files' with an array of remote file paths you want to download
    // $blthlaporan      = $request->input('vblthlaporan');
    // $kodebank         = $request->input('vkodebank');
    $namafile         = $request->input('vnamafile');
    $filedataArray    = explode(", ", $namafile);

    // Initialize an empty array to store information about downloaded files
    $downloadedFiles = [];

    // Use a foreach loop to download and process each file
    foreach ($filedataArray as $file) {
        try {
            // Menggunakan Storage dengan disk FTP
            $ftpDisk = Storage::disk('ftp');

            if (pathinfo($file, PATHINFO_EXTENSION) === 'pdf') {
                $namafileremot = pathinfo($file, PATHINFO_BASENAME);
            }

            $localFilePath  = 'public/report/' . $namafileremot; // Nama file untuk disimpan di lokal


            if ($ftpDisk->exists($file)) {
                //copy file dari ftp ke local aplikasi storage/app/public
                $content = $ftpDisk->get($file);
                $result = Storage::disk('local')->put($localFilePath, $content);
                if ($result) {
                    $sukses = true;
                    $msg    = 'Sukses PDF file Download successfully';
                } else {
                    $sukses = false;
                    $msg    = 'Gagal to Download PDF file';
                }

                //tampilkan file dilocal storage/app/public
                $url = Storage::url($localFilePath);
                if (Storage::disk('local')->exists($localFilePath)) {
                    $kdstatus = '200';
                    $downloadedFiles[] = [
                        'success'   =>  $sukses,
                        'localpath' =>  $url,
                        'status'    => 'Sukses',
                        'message'   => $msg
                    ];
                } else {
                    $kdstatus = '404';
                    $downloadedFiles[] = [
                        'success'    =>  $sukses,
                        'localpath'  =>  $url,
                        'status'     => 'Sukses',
                        'message'    =>  $msg
                    ];
                }
            } else {
                $kdstatus = '404';
                $downloadedFiles[] = [
                    'success'     =>  false,
                    'localpath'   =>  '',
                    'status'      => 'Sukses',
                    'message'     => 'File Tidak Ditemukan'
                ];
            }
        } catch (\Exception $e) {
            $kdstatus = '401';
            $msg = "Error Ftp : " . $e->getMessage();
        }
    }

    $data = [
        'status' =>  $kdstatus,
        'message' => $msg, // ?? "Files Sukses di downloaded !",
        'downloaded_files' => $downloadedFiles,
    ];

    return response()->json($data);
    // return response()->json($namafileremot);
})->name('monlap.download-struk-pdf');

// ---------------------------------------------------------------
// -- (6) Area USER APLIKASI Menu
// ---------------------------------------------------------------
