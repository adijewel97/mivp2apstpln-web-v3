<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class CProeseMIV extends Controller
{
    //1a ambil file extention *.RCN di ftp tampilkan di list
    function get_list_ftp_files_rcn(Request $request)
    {
        // ambil master bank miv
        $mstbankmiv = http::withToken($request->Session()->get('_datalogin.data.token'))
            ->post(
                config('myconfig.variable.SVR_URL_API') . 'getmstbankmiv',
                [
                    'kdbank' => 'ALL'
                ]
            )->json();

        $kdstatus = 'Sukses-...';
        $mstbanks = $mstbankmiv['data'];
        $Mstbanksmiv   = [];
        $MstProduks    = array('POSTPAID', 'PREPAID', 'NTLS');
        $directories   = [];
        foreach ($mstbanks as $mstbank) {
            // if ($mstbank['KODE_BANK'] != 'ALL') {
            if ($mstbank['KODE_BANK'] == '200') {
                $Mstbanksmiv[] = [
                    'KODE_BANK' => $mstbank['KODE_BANK'],
                    'KODE_ERP'  => $mstbank['KODE_ERP'],
                ];

                foreach ($MstProduks as $MstProduk) {
                    $directories[] =  '/vertikal/' . $mstbank['KODE_ERP'] . '/' . $mstbank['KODE_BANK'] . 'CA01/' . $MstProduk . '/lunas';
                }
            }
        }

        // monlap_get_bank_miv
        // $directories = [
        //     '/vertikal/2000001/200CA01/POSTPAID/lunas',
        //     '/vertikal/2000001/200CA01/PREPAID/lunas',
        //     '/vertikal/2000001/200CA01/NTLS/lunas',
        //     // '/vertikal/' . $kderp . '/' . $kdbank . '/POSTPAID/lunas/struk',
        //     // '/vertikal/' . $kderp . '/' . $kdbank . '/NTLS/lunas/struk',
        //     // '/vertikal/' . $kderp . '/' . $kdbank . '/PREPAID/lunas/struk',
        // ];

        $mydatafile = [];
        foreach ($directories as $directory) {
            $files = Storage::disk('ftp')->allFiles($directory);
            try {
                if (!empty($files)) {
                    foreach ($files as $file) {
                        if (pathinfo($file, PATHINFO_EXTENSION) === 'rcn') {
                            $namafile = pathinfo($file, PATHINFO_BASENAME);
                            $kdstatus = '200';
                            $mydatafile[] = [
                                'path'      => $directory,
                                'file'      => $namafile,
                                'status'    => 'Sukses Baca File di FTP'
                            ];
                        }
                    }
                } 
                // else {
                //     $mydatafile[] = [
                //         'path'   => $directory,
                //         'file'   => '',
                //         'status' => 'Tidak ada file .rcn di direktori ini'
                //     ];
                // }
            } catch (\Exception $e) {
                $mydatafile[] = [
                    'path'   => $directory,
                    'file'   => '',
                    'status' => 'Gagal membaca direktori: ' . $e->getMessage()
                ];
            }
        }

        $mydata = [
            'status'            =>  $kdstatus,
            'message'           => $msg ?? "Files Sukses di Tampilkan !",
            'downloaded_files'  => $mydatafile,
            'Mstbanksmiv'       => $Mstbanksmiv,
            'path_chek'         => $directories
        ];
        return json_encode($mydata);
    }

    function proses_file_rcn(Request $request)
    {
        // baca seluruh select
        // Replace 'your_remote_files' with an array of remote file paths you want to download
        // $blthlaporan      = $request->input('vblthlaporan');
        // $kodebank         = $request->input('vkodebank');
        $namafile         = $request->input('vnamafile');
        $filedataArray    = explode(", ", $namafile);

        // Initialize an empty array to store information about downloaded files
        $downloadedFiles = [];

        // // Use a foreach loop to download and process each file
        $count_sukses = 0;
        $count_gagal  = 0;
        $kdstatus     = '200';
        $msg          = 'Sukses ...';

        if (count($filedataArray) > 0) {
            foreach ($filedataArray as $file) {
                try {
                    // Menggunakan Storage dengan disk FTP
                    $ftpDisk = Storage::disk('ftp');
                    $namafileremot = '';

                    if (pathinfo($file, PATHINFO_EXTENSION) === 'rcn') {
                        $namafileremot = pathinfo($file, PATHINFO_BASENAME);
                        $pathfileremot = substr($file, 1, (strlen($file) - strlen($namafileremot)) - 1);

                        // 1) jika ada file sudah ada di folder lunas/proses (pernah di proses)
                        // direname di tambhakan -revxxx (xxx=nilai random) conntoh file :
                        $newDestinationPath_awal = $pathfileremot . 'proses/' . $namafileremot;
                        if ($ftpDisk->exists($newDestinationPath_awal)) {
                            $randomNumber = substr('000' . random_int(1, 100), -3);
                            // Mendapatkan informasi path file
                            $pathInfo = pathinfo($newDestinationPath_awal);
                            // Mengambil nama file tanpa ekstensi
                            $fileNameWithoutExtension = $pathInfo['filename'] . '-R' . $randomNumber . '.rcn';

                            $newDestinationPath_akhir = $pathfileremot . 'proses/' . $fileNameWithoutExtension;
                            $namafile_akhir = $fileNameWithoutExtension;
                        } else {
                            $newDestinationPath_akhir = $pathfileremot . 'proses/' . $namafileremot;
                            $namafile_akhir = $namafileremot;
                        }

                        // 2) ambil isi file rcn per baris masukan ke db
                        $myarray = [];
                        $json_data_in = [];
                        $fileStream = $ftpDisk->readStream($file);
                        // Check if the stream is valid
                        if ($fileStream !== false) {
                            // $jml = $fileStream . count();
                            $i = 0;
                            $myarray_filed = [];
                            $json_data     = [];
                            $MyData        = [];
                            $file_produk = substr($namafileremot, 0, 3);
                            while (!feof($fileStream)) {
                                $line = fgets($fileStream);
                                $i++;
                                // Process each line as needed
                                // if ((trim($line) != 'NOUSULAN|TGLUSULAN|VA|KDBANK|IDPEL|BLTH|RPTAG|RPBK|TGLBAYAR|JAMBAYAR|USERID')) {
                                $myarray_filed = explode("|", trim($line));

                                // if (substr($myarray_filed[0], 1, 3) == ['POS', 'PRE', 'NTL']) {
                                // if (in_array(substr($myarray_filed[0], 0, 3), ['POS', 'PRE', 'NTL'])) {
                                if (($file_produk == 'POS') and (substr($myarray_filed[0], 0, 3) == 'POS')) {
                                    $myarray[] = [
                                        'ke' => $i,
                                        'isi' => trim($line),
                                        'isi_filed' => $myarray_filed[0]
                                    ];
                                    // ambil data filed untuk di buat data json
                                    $json_data[]    = [
                                        'NOUSULAN'      =>  $myarray_filed[0],
                                        'TGLUSULAN'     =>  $myarray_filed[1],
                                        'VA'            =>  $myarray_filed[2],
                                        'KDBANK'        =>  $myarray_filed[3],
                                        'IDPEL'         =>  $myarray_filed[4],
                                        'BLTH'          =>  $myarray_filed[5],
                                        'RPTAG'         =>  $myarray_filed[6],
                                        'RPBK'          =>  $myarray_filed[7],
                                        'TGLBAYAR'      =>  $myarray_filed[8],
                                        'JAMBAYAR'      =>  $myarray_filed[9],
                                        'USERID'        =>  $myarray_filed[10],
                                        'NAMAFILE'      =>  $namafile_akhir
                                    ];
                                    // {"items": [{"NOUSULAN":"POS1212620230306001", "TGLUSULAN":"20231127","VA":"8800881299912200"
                                    // , "KDBANK":"200","IDPEL":"121190107375", "BLTH":"202302", "RPTAG":"1886228","RPBK":"0"
                                    // , "TGLBAYAR":"07032023", "JAMBAYAR":"161559","USERID":"BNI-TBS"
                                    // ,"NAMAFILE":"POS1212620230306006-20230307-009CA01.rcn"},]}
                                } else if (($file_produk == 'PRE') and (substr($myarray_filed[0], 0, 3) == 'PRE')) {
                                    $myarray[] = [
                                        'ke' => $i,
                                        'isi' => trim($line),
                                        'isi_filed' => $myarray_filed[0]
                                    ];
                                    // ambil data filed untuk di buat data json
                                    $json_data[]    = [
                                        'NOUSULAN'      =>  $myarray_filed[0],
                                        'TGLUSULAN'     =>  $myarray_filed[1],
                                        'VA'            =>  $myarray_filed[2],
                                        'KDBANK'        =>  $myarray_filed[3],
                                        'IDPEL'         =>  $myarray_filed[4],
                                        'BLTH'          =>  $myarray_filed[5],
                                        'RPTAG'         =>  $myarray_filed[6],
                                        'RPBK'          =>  $myarray_filed[7],
                                        'TGLBAYAR'      =>  $myarray_filed[8],
                                        'JAMBAYAR'      =>  $myarray_filed[9],
                                        'USERID'        =>  $myarray_filed[10],
                                        'NAMAFILE'      =>  $namafile_akhir
                                    ];
                                    // {"items": [{"NOUSULAN":"PRE1212620230306001", "TGLUSULAN":"20231127","VA":"8800881299912200"
                                    // , "KDBANK":"200","IDPEL":"121190107375", "BLTH":"202302", "RPTAG":"1886228","RPBK":"000000"
                                    // , "TGLBAYAR":"07032023", "JAMBAYAR":"161559","USERID":"BNI-TBS"
                                    // ,"NAMAFILE":"PRE1212620230306006-20230307-009CA01.rcn"},]}
                                } else if (($file_produk == 'NTL') and (substr($myarray_filed[0], 0, 3) == 'NTL')) {
                                    $myarray[] = [
                                        'ke' => $i,
                                        'isi' => trim($line),
                                        'isi_filed' => $myarray_filed[0]
                                    ];
                                    // ambil data filed untuk di buat data json
                                    $json_data[]    = [
                                        'NOUSULAN'      =>  $myarray_filed[0],
                                        'TGLUSULAN'     =>  $myarray_filed[1],
                                        'VA'            =>  $myarray_filed[2],
                                        'KDBANK'        =>  $myarray_filed[3],
                                        'IDPEL'         =>  $myarray_filed[4],
                                        'BLTH'          =>  $myarray_filed[5],
                                        'RPTAG'         =>  $myarray_filed[6],
                                        'RPBK'          =>  $myarray_filed[7],
                                        'TGLBAYAR'      =>  $myarray_filed[8],
                                        'JAMBAYAR'      =>  $myarray_filed[9],
                                        'USERID'        =>  $myarray_filed[10],
                                        'NAMAFILE'      =>  $namafile_akhir
                                    ];
                                    // {"items": [ {"NOUSULAN":"NTL1212620230306001", "TGLUSULAN":"20231127","VA":"8800881299912200",    
                                    //               "KDBANK":"200","IDPEL":"1211901073750", "BLTH":"1", "RPTAG":"1886228","RPBK":"0",    
                                    //               "TGLBAYAR":"07032023", "JAMBAYAR":"161559","USERID":"BNI-TBS",
                                    //               "NAMAFILE":"NTL1212620230306006-20230307-009CA01.rcn"
                                    //             },  
                                    //             {"NOUSULAN":"NTL1212620230306001", "TGLUSULAN":"20231127","VA":"8800881299912200",
                                    //              "KDBANK":"200","IDPEL":"1211901073740", "BLTH":"1", "RPTAG":"188000","RPBK":"0",
                                    //              "TGLBAYAR":"07032023", "JAMBAYAR":"161559","USERID":"BNI-TBS",
                                    //              "NAMAFILE":"NTL1212620230306006-20230307-009CA01.rcn"
                                    //             }  
                                    //           ]}
                                }
                            }

                            // proses insert ke db setelah seluruh file rcn di baca ke bentuk json
                            if ($file_produk == 'POS') {
                                $json_data_in = [
                                    'items'             => $json_data,
                                ];

                                $data = $request->session()->all();
                                $dataUser = $data['_datalogin']['data']['user']['username'];
                                $MyData = http::withToken($request->Session()->get('_datalogin.data.token'))
                                    ->post(
                                        config('myconfig.variable.SVR_URL_API') . 'prosesinsertfilercn_post',
                                        [
                                            'json_data'     => json_encode($json_data_in),
                                            'app_user'      => $dataUser
                                        ]
                                    )->json();
                            } else  if ($file_produk == 'PRE') {
                                $json_data_in = [
                                    'items'             => $json_data,
                                ];

                                $data = $request->session()->all();
                                $dataUser = $data['_datalogin']['data']['user']['username'];
                                $MyData = http::withToken($request->Session()->get('_datalogin.data.token'))
                                    ->post(
                                        config('myconfig.variable.SVR_URL_API') . 'prosesinsertfilercn_pre',
                                        [
                                            'json_data'     => json_encode($json_data_in),
                                            'app_user'      => $dataUser
                                        ]
                                    )->json();
                            } else  if ($file_produk == 'NTL') {
                                $json_data_in = [
                                    'items'             => $json_data,
                                ];

                                $data = $request->session()->all();
                                $dataUser = $data['_datalogin']['data']['user']['username'];
                                $MyData = http::withToken($request->Session()->get('_datalogin.data.token'))
                                    ->post(
                                        config('myconfig.variable.SVR_URL_API') . 'prosesinsertfilercn_ntl',
                                        [
                                            'json_data'     => json_encode($json_data_in),
                                            'app_user'      => $dataUser
                                        ]
                                    )->json();
                            }

                            // Close the file stream
                            fclose($fileStream);
                        } else {
                            $kdstatus = '401';
                            $msg = "Error: File tidak bisa di baca chek isi format fie RCN Bank.";
                        }
                    }


                    $ftpDisk->move($file, $newDestinationPath_akhir);
                    if ($ftpDisk->exists($newDestinationPath_akhir)) {
                        $fileStream_ctl = $ftpDisk->readStream($file . '.ctl');
                        // Check if the stream is valid
                        if ($fileStream_ctl !== false) {
                            $i = 0;
                            $myarray_filed = [];
                            $json_data     = [];
                            $MyData_ctl    = [];
                            while (!feof($fileStream_ctl)) {
                                $line = fgets($fileStream_ctl);
                                $i++;
                                // Process each line as needed
                                // if ((trim($line) != 'NOUSULAN|TGLUSULAN|VA|KDBANK|IDPEL|BLTH|RPTAG|RPBK|TGLBAYAR|JAMBAYAR|USERID')) {
                                $myarray_filed = explode("|", trim($line));

                                // ambil data filed untuk di buat data json
                                $json_data[]    = [
                                    'NAMAFILE'      =>  $namafile_akhir . '.ctl',
                                    'LEMBAR'        =>  $myarray_filed[0],
                                    'RPTAG'         =>  $myarray_filed[1]
                                ];

                                // {"items": [{"NAMAFILE":"POS1212620230306006-20230307-009CA01.rcn"
                                //           , "LEMBAR":"121"
                                //           , "RPTAG":"100121"}]}
                            }

                            $json_data_in = [
                                'items'             => $json_data,
                            ];

                            if ($file_produk == 'POS') {
                                $data = $request->session()->all();
                                $dataUser = $data['_datalogin']['data']['user']['username'];
                                $MyData_ctl = http::withToken($request->Session()->get('_datalogin.data.token'))
                                    ->post(
                                        config('myconfig.variable.SVR_URL_API') . 'prosesinsertfilercn_ctl_post',
                                        [
                                            'json_data'     => json_encode($json_data_in),
                                            'app_user'      => $dataUser
                                        ]
                                    )->json();
                            } else if ($file_produk == 'PRE') {
                                $data = $request->session()->all();
                                $dataUser = $data['_datalogin']['data']['user']['username'];
                                $MyData_ctl = http::withToken($request->Session()->get('_datalogin.data.token'))
                                    ->post(
                                        config('myconfig.variable.SVR_URL_API') . 'prosesinsertfilercn_ctl_pre',
                                        [
                                            'json_data'     => json_encode($json_data_in),
                                            'app_user'      => $dataUser
                                        ]
                                    )->json();
                            } else if ($file_produk == 'NTL') {
                                $data = $request->session()->all();
                                $dataUser = $data['_datalogin']['data']['user']['username'];
                                $MyData_ctl = http::withToken($request->Session()->get('_datalogin.data.token'))
                                    ->post(
                                        config('myconfig.variable.SVR_URL_API') . 'prosesinsertfilercn_ctl_ntl',
                                        [
                                            'json_data'     => json_encode($json_data_in),
                                            'app_user'      => $dataUser
                                        ]
                                    )->json();
                            }
                        }

                        $ftpDisk->move($file . '.ctl', $newDestinationPath_akhir . '.ctl');
                        $ftpDisk->delete($file);
                        $ftpDisk->delete($file . '.ctl');
                        $sukses         = true;
                        $msg            = 'Sukses RCN CTL file Download dan Proses';
                        $kdstatus       = '200';
                        $downloadedFiles[] = [
                            'success'   =>  $sukses,
                            'path'      =>  $newDestinationPath_akhir,
                            'filename'  =>  $namafileremot,
                            'status'    => 'Sukses',
                            'message'   => $msg
                        ];
                        $count_sukses = $count_sukses + 1;
                    } else {
                        $sukses         = true;
                        $msg            = 'Gagal RCN CTL file Download dan Proses.';
                        $kdstatus       = '404';
                        $count_gagal =  $count_gagal + 1;
                    }
                } catch (\Exception $e) {
                    $kdstatus = '401';
                    $msg = "Error: " . $e->getMessage();
                }
            }

            $data =
                [
                    'status'            =>  $kdstatus,
                    // 'message'           => $msg . ' ( Sukses = ' . $count_sukses . ' dan Sudah ada = ' . $count_gagal . ') ',
                    'message'           => $MyData['message'],
                    'downloaded_files'  => $downloadedFiles,
                    'isi_file_rcn'      => $myarray,
                    'info_items'        => json_encode($json_data_in),
                    'info_prosres'      => $MyData,
                    'info_progres_ctl'  => $MyData_ctl
                ];
        } else {
            $data =
                [
                    'status' =>  '401',
                    'message' => 'Gagal Tidak Ada File List Yang Akan di Proses',
                    'downloaded_files' => $downloadedFiles,
                ];
        }

        return response()->json($data);
    }

    function cari_log_db_rcn(Request $request)
    {
        // baca seluruh select
        // Replace 'your_remote_files' with an array of remote file paths you want to download
        // $blthlaporan      = $request->input('vblthlaporan');
        // $kodebank         = $request->input('vkodebank');
        $namafile         = $request->input('vnamafile');
        $filedataArray    = explode(", ", $namafile);

        // Initialize an empty array to store information about downloaded files
        $downloadedFiles = [];

        // // Use a foreach loop to download and process each file
        $count_sukses = 0;
        $count_gagal  = 0;
        $kdstatus     = '200';
        $msg          = 'Sukses ...';

        if (count($filedataArray) > 0) {
            foreach ($filedataArray as $file) {
                try {
                    // Menggunakan Storage dengan disk FTP
                    $ftpDisk = Storage::disk('ftp');
                    $namafileremot = '';

                    if (pathinfo($file, PATHINFO_EXTENSION) === 'rcn') {
                        $namafileremot = pathinfo($file, PATHINFO_BASENAME);
                        $pathfileremot = substr($file, 1, (strlen($file) - strlen($namafileremot)) - 1);

                        // 1) jika ada file sudah ada di folder lunas/proses (pernah di proses)
                        // direname di tambhakan -revxxx (xxx=nilai random) conntoh file :
                        $newDestinationPath_awal = $pathfileremot . 'proses/' . $namafileremot;
                        if ($ftpDisk->exists($newDestinationPath_awal)) {
                            $randomNumber = substr('000' . random_int(1, 100), -3);
                            // Mendapatkan informasi path file
                            $pathInfo = pathinfo($newDestinationPath_awal);
                            // Mengambil nama file tanpa ekstensi
                            $fileNameWithoutExtension = $pathInfo['filename'] . '-R' . $randomNumber . '.rcn';

                            $newDestinationPath_akhir = $pathfileremot . 'proses/' . $fileNameWithoutExtension;
                            $namafile_akhir = $fileNameWithoutExtension;
                        } else {
                            $newDestinationPath_akhir = $pathfileremot . 'proses/' . $namafileremot;
                            $namafile_akhir = $namafileremot;
                        }

                        // 2) ambil isi file rcn per baris masukan ke db
                        $myarray = [];
                        $json_data_in = [];
                        $fileStream = $ftpDisk->readStream($file);
                        // Check if the stream is valid
                        if ($fileStream !== false) {
                            // $jml = $fileStream . count();
                            $i = 0;
                            $myarray_filed = [];
                            $json_data     = [];
                            $MyData        = [];
                            $file_produk = substr($namafileremot, 0, 3);
                            while (!feof($fileStream)) {
                                $line = fgets($fileStream);
                                $i++;
                                // Process each line as needed
                                // if ((trim($line) != 'NOUSULAN|TGLUSULAN|VA|KDBANK|IDPEL|BLTH|RPTAG|RPBK|TGLBAYAR|JAMBAYAR|USERID')) {
                                $myarray_filed = explode("|", trim($line));

                                // if (substr($myarray_filed[0], 1, 3) == ['POS', 'PRE', 'NTL']) {
                                // if (in_array(substr($myarray_filed[0], 0, 3), ['POS', 'PRE', 'NTL'])) {
                                if (($file_produk == 'POS') and (substr($myarray_filed[0], 0, 3) == 'POS')) {
                                    $myarray[] = [
                                        'ke' => $i,
                                        'isi' => trim($line),
                                        'isi_filed' => $myarray_filed[0]
                                    ];
                                    // ambil data filed untuk di buat data json
                                    $json_data[]    = [
                                        'NOUSULAN'      =>  $myarray_filed[0],
                                        'TGLUSULAN'     =>  $myarray_filed[1],
                                        'VA'            =>  $myarray_filed[2],
                                        'KDBANK'        =>  $myarray_filed[3],
                                        'IDPEL'         =>  $myarray_filed[4],
                                        'BLTH'          =>  $myarray_filed[5],
                                        'RPTAG'         =>  $myarray_filed[6],
                                        'RPBK'          =>  $myarray_filed[7],
                                        'TGLBAYAR'      =>  $myarray_filed[8],
                                        'JAMBAYAR'      =>  $myarray_filed[9],
                                        'USERID'        =>  $myarray_filed[10],
                                        'NAMAFILE'      =>  $namafile_akhir
                                    ];
                                    // {"items": [{"NOUSULAN":"POS1212620230306001", "TGLUSULAN":"20231127","VA":"8800881299912200"
                                    // , "KDBANK":"200","IDPEL":"121190107375", "BLTH":"202302", "RPTAG":"1886228","RPBK":"0"
                                    // , "TGLBAYAR":"07032023", "JAMBAYAR":"161559","USERID":"BNI-TBS"
                                    // ,"NAMAFILE":"POS1212620230306006-20230307-009CA01.rcn"},]}
                                } else if (($file_produk == 'PRE') and (substr($myarray_filed[0], 0, 3) == 'PRE')) {
                                    $myarray[] = [
                                        'ke' => $i,
                                        'isi' => trim($line),
                                        'isi_filed' => $myarray_filed[0]
                                    ];
                                    // ambil data filed untuk di buat data json
                                    $json_data[]    = [
                                        'NOUSULAN'      =>  $myarray_filed[0],
                                        'TGLUSULAN'     =>  $myarray_filed[1],
                                        'VA'            =>  $myarray_filed[2],
                                        'KDBANK'        =>  $myarray_filed[3],
                                        'IDPEL'         =>  $myarray_filed[4],
                                        'BLTH'          =>  $myarray_filed[5],
                                        'RPTAG'         =>  $myarray_filed[6],
                                        'RPBK'          =>  $myarray_filed[7],
                                        'TGLBAYAR'      =>  $myarray_filed[8],
                                        'JAMBAYAR'      =>  $myarray_filed[9],
                                        'USERID'        =>  $myarray_filed[10],
                                        'NAMAFILE'      =>  $namafile_akhir
                                    ];
                                    // {"items": [{"NOUSULAN":"PRE1212620230306001", "TGLUSULAN":"20231127","VA":"8800881299912200"
                                    // , "KDBANK":"200","IDPEL":"121190107375", "BLTH":"202302", "RPTAG":"1886228","RPBK":"000000"
                                    // , "TGLBAYAR":"07032023", "JAMBAYAR":"161559","USERID":"BNI-TBS"
                                    // ,"NAMAFILE":"PRE1212620230306006-20230307-009CA01.rcn"},]}
                                } else if (($file_produk == 'NTL') and (substr($myarray_filed[0], 0, 3) == 'NTL')) {
                                    $myarray[] = [
                                        'ke' => $i,
                                        'isi' => trim($line),
                                        'isi_filed' => $myarray_filed[0]
                                    ];
                                    // ambil data filed untuk di buat data json
                                    $json_data[]    = [
                                        'NOUSULAN'      =>  $myarray_filed[0],
                                        'TGLUSULAN'     =>  $myarray_filed[1],
                                        'VA'            =>  $myarray_filed[2],
                                        'KDBANK'        =>  $myarray_filed[3],
                                        'IDPEL'         =>  $myarray_filed[4],
                                        'BLTH'          =>  $myarray_filed[5],
                                        'RPTAG'         =>  $myarray_filed[6],
                                        'RPBK'          =>  $myarray_filed[7],
                                        'TGLBAYAR'      =>  $myarray_filed[8],
                                        'JAMBAYAR'      =>  $myarray_filed[9],
                                        'USERID'        =>  $myarray_filed[10],
                                        'NAMAFILE'      =>  $namafile_akhir
                                    ];
                                    // {"items": [ {"NOUSULAN":"NTL1212620230306001", "TGLUSULAN":"20231127","VA":"8800881299912200",    
                                    //               "KDBANK":"200","IDPEL":"1211901073750", "BLTH":"1", "RPTAG":"1886228","RPBK":"0",    
                                    //               "TGLBAYAR":"07032023", "JAMBAYAR":"161559","USERID":"BNI-TBS",
                                    //               "NAMAFILE":"NTL1212620230306006-20230307-009CA01.rcn"
                                    //             },  
                                    //             {"NOUSULAN":"NTL1212620230306001", "TGLUSULAN":"20231127","VA":"8800881299912200",
                                    //              "KDBANK":"200","IDPEL":"1211901073740", "BLTH":"1", "RPTAG":"188000","RPBK":"0",
                                    //              "TGLBAYAR":"07032023", "JAMBAYAR":"161559","USERID":"BNI-TBS",
                                    //              "NAMAFILE":"NTL1212620230306006-20230307-009CA01.rcn"
                                    //             }  
                                    //           ]}
                                }
                            }

                            // proses insert ke db setelah seluruh file rcn di baca ke bentuk json
                            if ($file_produk == 'POS') {
                                $json_data_in = [
                                    'items'             => $json_data,
                                ];

                                $data = $request->session()->all();
                                $dataUser = $data['_datalogin']['data']['user']['username'];
                                $MyData = http::withToken($request->Session()->get('_datalogin.data.token'))
                                    ->post(
                                        config('myconfig.variable.SVR_URL_API') . 'prosesinsertfilercn_post',
                                        [
                                            'json_data'     => json_encode($json_data_in),
                                            'app_user'      => $dataUser
                                        ]
                                    )->json();
                            } else  if ($file_produk == 'PRE') {
                                $json_data_in = [
                                    'items'             => $json_data,
                                ];

                                $data = $request->session()->all();
                                $dataUser = $data['_datalogin']['data']['user']['username'];
                                $MyData = http::withToken($request->Session()->get('_datalogin.data.token'))
                                    ->post(
                                        config('myconfig.variable.SVR_URL_API') . 'prosesinsertfilercn_pre',
                                        [
                                            'json_data'     => json_encode($json_data_in),
                                            'app_user'      => $dataUser
                                        ]
                                    )->json();
                            } else  if ($file_produk == 'NTL') {
                                $json_data_in = [
                                    'items'             => $json_data,
                                ];

                                $data = $request->session()->all();
                                $dataUser = $data['_datalogin']['data']['user']['username'];
                                $MyData = http::withToken($request->Session()->get('_datalogin.data.token'))
                                    ->post(
                                        config('myconfig.variable.SVR_URL_API') . 'prosesinsertfilercn_ntl',
                                        [
                                            'json_data'     => json_encode($json_data_in),
                                            'app_user'      => $dataUser
                                        ]
                                    )->json();
                            }

                            // Close the file stream
                            fclose($fileStream);
                        } else {
                            $kdstatus = '401';
                            $msg = "Error: File tidak bisa di baca chek isi format fie RCN Bank.";
                        }
                    }


                    $ftpDisk->move($file, $newDestinationPath_akhir);
                    if ($ftpDisk->exists($newDestinationPath_akhir)) {
                        $fileStream_ctl = $ftpDisk->readStream($file . '.ctl');
                        // Check if the stream is valid
                        if ($fileStream_ctl !== false) {
                            $i = 0;
                            $myarray_filed = [];
                            $json_data     = [];
                            $MyData_ctl    = [];
                            while (!feof($fileStream_ctl)) {
                                $line = fgets($fileStream_ctl);
                                $i++;
                                // Process each line as needed
                                // if ((trim($line) != 'NOUSULAN|TGLUSULAN|VA|KDBANK|IDPEL|BLTH|RPTAG|RPBK|TGLBAYAR|JAMBAYAR|USERID')) {
                                $myarray_filed = explode("|", trim($line));

                                // ambil data filed untuk di buat data json
                                $json_data[]    = [
                                    'NAMAFILE'      =>  $namafile_akhir . '.ctl',
                                    'LEMBAR'        =>  $myarray_filed[0],
                                    'RPTAG'         =>  $myarray_filed[1]
                                ];

                                // {"items": [{"NAMAFILE":"POS1212620230306006-20230307-009CA01.rcn"
                                //           , "LEMBAR":"121"
                                //           , "RPTAG":"100121"}]}
                            }

                            $json_data_in = [
                                'items'             => $json_data,
                            ];

                            if ($file_produk == 'POS') {
                                $data = $request->session()->all();
                                $dataUser = $data['_datalogin']['data']['user']['username'];
                                $MyData_ctl = http::withToken($request->Session()->get('_datalogin.data.token'))
                                    ->post(
                                        config('myconfig.variable.SVR_URL_API') . 'prosesinsertfilercn_ctl_post',
                                        [
                                            'json_data'     => json_encode($json_data_in),
                                            'app_user'      => $dataUser
                                        ]
                                    )->json();
                            } else if ($file_produk == 'PRE') {
                                $data = $request->session()->all();
                                $dataUser = $data['_datalogin']['data']['user']['username'];
                                $MyData_ctl = http::withToken($request->Session()->get('_datalogin.data.token'))
                                    ->post(
                                        config('myconfig.variable.SVR_URL_API') . 'prosesinsertfilercn_ctl_pre',
                                        [
                                            'json_data'     => json_encode($json_data_in),
                                            'app_user'      => $dataUser
                                        ]
                                    )->json();
                            } else if ($file_produk == 'NTL') {
                                $data = $request->session()->all();
                                $dataUser = $data['_datalogin']['data']['user']['username'];
                                $MyData_ctl = http::withToken($request->Session()->get('_datalogin.data.token'))
                                    ->post(
                                        config('myconfig.variable.SVR_URL_API') . 'prosesinsertfilercn_ctl_ntl',
                                        [
                                            'json_data'     => json_encode($json_data_in),
                                            'app_user'      => $dataUser
                                        ]
                                    )->json();
                            }
                        }

                        $ftpDisk->move($file . '.ctl', $newDestinationPath_akhir . '.ctl');
                        $ftpDisk->delete($file);
                        $ftpDisk->delete($file . '.ctl');
                        $sukses         = true;
                        $msg            = 'Sukses RCN CTL file Download dan Proses';
                        $kdstatus       = '200';
                        $downloadedFiles[] = [
                            'success'   =>  $sukses,
                            'path'      =>  $newDestinationPath_akhir,
                            'filename'  =>  $namafileremot,
                            'status'    => 'Sukses',
                            'message'   => $msg
                        ];
                        $count_sukses = $count_sukses + 1;
                    } else {
                        $sukses         = true;
                        $msg            = 'Gagal RCN CTL file Download dan Proses.';
                        $kdstatus       = '404';
                        $count_gagal =  $count_gagal + 1;
                    }
                } catch (\Exception $e) {
                    $kdstatus = '401';
                    $msg = "Error: " . $e->getMessage();
                }
            }

            $data =
                [
                    'status'            =>  $kdstatus,
                    // 'message'           => $msg . ' ( Sukses = ' . $count_sukses . ' dan Sudah ada = ' . $count_gagal . ') ',
                    'message'           => $MyData['message'],
                    'downloaded_files'  => $downloadedFiles,
                    'isi_file_rcn'      => $myarray,
                    'info_items'        => json_encode($json_data_in),
                    'info_prosres'      => $MyData,
                    'info_progres_ctl'  => $MyData_ctl
                ];
        } else {
            $data =
                [
                    'status' =>  '401',
                    'message' => 'Gagal Tidak Ada File List Yang Akan di Proses',
                    'downloaded_files' => $downloadedFiles,
                ];
        }

        return response()->json($data);
    }
}
