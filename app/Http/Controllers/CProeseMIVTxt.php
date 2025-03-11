<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class CProeseMIVTxt extends Controller
{
    //
    //
    //1a ambil nama file untuk *.txt dan *.txt.ctl
    function buat_nama_files_txt_miv(Request $request)
    {
        // ambil master bank miv
        $nousulan         = $request->input('vnousulan');
        $tglfile          = $request->input('vtglfile');

        // Ambil session
        $MyData1 = http::withToken($request->Session()->get('_datalogin.data.token'))
            ->post(
                config('myconfig.variable.SVR_URL_API') . 'prosesnamafilestxt_post',
                [
                    'nousulan'     => $nousulan,
                    'tglfile'      => $tglfile
                ]
            )->json();

        // $mydata =  $files;
        $mydata = [
            'status'            => ($MyData1['kode'] !== null) ? $MyData1['kode'] : '400',
            'message'           => ($MyData1['message'] !== null) ? $MyData1['message'] : 'Data Tidak ditemukan',
            'nama_file'         => $MyData1,
            // 'nousulan'          => $nousulan,
            // 'tglfile'           => $tglfile,
            // 'token'             => $request->Session()->get('_datalogin.data.token')
            // 'path_chek'         => $directories
        ];
        return json_encode($mydata);
    }

    //1b buat isi file untuk file *.txt
    function buat_detail_files_txt_miv(Request $request)
    {

        // ambil master bank miv
        $nousulan         = $request->input('vnousulan');
        $tglfile          = $request->input('vtglfile');

        // Ambil session
        $MyData2 = http::withToken($request->Session()->get('_datalogin.data.token'))
            ->post(
                config('myconfig.variable.SVR_URL_API') . 'prosesdetailfilestxt_post',
                [
                    'nousulan'     => $nousulan,
                    'tglfile'      => $tglfile
                ]
            )->json();

        // $mydata =  $files;
        $mydata = [
            'status'            => ($MyData2['kode'] !== null) ? $MyData2['kode'] : '400',
            'message'           => ($MyData2['message'] !== null) ? $MyData2['message'] : 'Data Tidak ditemukan',
            'txtfile'           => $MyData2
            // 'nousulan'          => $nousulan,
            // 'tglfile'           => $tglfile,
            // 'token'             => $request->Session()->get('_datalogin.data.token')
            // 'path_chek'         => $directories
        ];
        return json_encode($mydata);
    }

    //1c buat isi file untuk file *.txt
    function buat_rekap_files_txt_miv(Request $request)
    {
        // ambil master bank miv
        $nousulan         = $request->input('vnousulan');
        $tglfile          = $request->input('vtglfile');

        // Ambil session
        $MyData2 = http::withToken($request->Session()->get('_datalogin.data.token'))
            ->post(
                config('myconfig.variable.SVR_URL_API') . 'prosesrekapfilestxt_post',
                [
                    'nousulan'     => $nousulan,
                    'tglfile'      => $tglfile
                ]
            )->json();

        // $mydata =  $files;
        $mydata = [
            'status'            => ($MyData2['kode'] !== null) ? $MyData2['kode'] : '400',
            'message'           => ($MyData2['message'] !== null) ? $MyData2['message'] : 'Data Tidak ditemukan',
            'rkpfile'           => $MyData2
            // 'nousulan'          => $nousulan,
            // 'tglfile'           => $tglfile,
            // 'token'             => $request->Session()->get('_datalogin.data.token')
            // 'path_chek'         => $directories
        ];
        return json_encode($mydata);
    }

    function proses_kirim_file_txt_keftp(Request $request, $localFileName)
    {
        $localFilePath = 'TXT_FILE/' . $localFileName;
        // Ensure the local file exists
        if (Storage::exists($localFilePath)) {
            $mstbankmiv = Http::withToken($request->session()->get('_datalogin.data.token'))
            ->post(
                config('myconfig.variable.SVR_URL_API') . 'getmstbankmiv',
                [
                    'kdbank' => 'ALL'
                ]
            )->json();

            $mstbanks = $mstbankmiv['data'];
            $MstProduk = substr($localFileName, 0, 3);
            $Mstkdbankfile = substr($localFileName, 29, 3);

            $indexproduk = 0;
            if ($MstProduk === 'PRE') {
                $indexproduk = 1;
            } else if ($MstProduk === 'NTL') {
                $indexproduk = 2;
            }

            $MstProduks = ['POSTPAID', 'PREPAID', 'NTLS'];
            $remoteFilePathdaftar = '';
            foreach ($mstbanks as $mstbank) {
                if ($mstbank['KODE_BANK'] == $Mstkdbankfile) {
                    $remoteFilePathdaftar = '/vertikal/' . $mstbank['KODE_ERP'] . '/' . $mstbank['KODE_BANK'] .
                    'CA01/' .  $MstProduks[$indexproduk] . '/daftar';
                    break; // Exit the loop once a matching bank is found
                }
            }

            $status = '200';
            $message = 'file txt miv berhasil dikirim ke ftp folder daftar';
        } else {
            $status = '401';
            $message = 'file txt miv gagal dikirim ke ftp folder daftar';
        };


        // if (Storage::exists($localFilePath)) {
        //     // ambil master bank miv
        //     $mstbankmiv = Http::withToken($request->session()->get('_datalogin.data.token'))
        //     ->post(
        //         config('myconfig.variable.SVR_URL_API') . 'getmstbankmiv',
        //         [
        //             'kdbank' => 'ALL'
        //         ]
        //     )->json();

        //     $mstbanks = $mstbankmiv['data'];
        //     $MstProduk = substr($localFileName, 0, 3);
        //     $Mstkdbankfile = substr($localFileName, 29, 3);

        //     $indexproduk = 0;
        //     if ($MstProduk === 'PRE') {
        //         $indexproduk = 1;
        //     } else if ($MstProduk === 'NTL') {
        //         $indexproduk = 2;
        //     }

        //     $MstProduks = ['POSTPAID', 'PREPAID', 'NTLS'];
        //     $remoteFilePathdaftar = '';
        //     foreach ($mstbanks as $mstbank) {
        //         if ($mstbank['KODE_BANK'] == $Mstkdbankfile) {
        //             $remoteFilePathdaftar = '/vertikal/' . $mstbank['KODE_ERP'] . '/' . $mstbank['KODE_BANK'] .
        //             'CA01/' .  $MstProduks[$indexproduk] . '/daftar';
        //             break; // Exit the loop once a matching bank is found
        //         }
        //     }

        //     // Use the 'ftp' disk driver
        //     $diskftp = Storage::disk('ftp');

        //     // Upload the file to the FTP server
        //     $result = $diskftp->put($remoteFilePathdaftar, $localFilePath);

        //     if ($result) {
        //     // File uploaded successfully
        //     $status = '200';
        //     $message = 'file txt miv berhasil dikirim ke ftp folder daftar';
        // } else {
        //     // File upload failed
        //     $status = '401';
        //     $message = 'file txt miv gagal dikirim ke ftp folder daftar';
        // }

        $info_filetxt_toftp[] = [
            'status'  => $status,
            'message' => $message,
            'bank_miv' =>  $mstbankmiv,
            'localPathfile' =>  $localFilePath,
            'remotPathfile' =>  $remoteFilePathdaftar
        ];

        return json_encode($info_filetxt_toftp);
    }

    function proses_file_txt_pos(Request $request)
    {
        $Nama_file_txt    = $request->input('vNama_file_txt');
        $Nama_file_txtctl = $Nama_file_txt . '.ctl';
        $nousulan         = $request->input('vnousulan');
        $tglfile          = $request->input('vtglfile');

        // Ambil session
        $MyData_detil = http::withToken($request->session()->get('_datalogin.data.token'))
            ->post(
                config('myconfig.variable.SVR_URL_API') . 'prosesdetailfilestxt_post',
                [
                    'nousulan' => $nousulan,
                    'tglfile'  => $tglfile
                ]
            )->json();

        // Ambil session
        $MyData_rekap = http::withToken($request->Session()->get('_datalogin.data.token'))
            ->post(
                config('myconfig.variable.SVR_URL_API') . 'prosesrekapfilestxt_post',
                [
                    'nousulan'     => $nousulan,
                    'tglfile'      => $tglfile
                ]
            )->json();

        // Check if a file is uploaded
        if ($MyData_detil['data']) {
            // Convert array data to a JSON string
            $content_detail = json_encode($MyData_detil['data']);
            $content_rekap  = json_encode($MyData_rekap['data']);

            // Append a newline character after each element in the array
            //isi file detail
            $content_detail = str_replace('"},{"DATA":"', PHP_EOL, $content_detail);
            $content_detail = str_replace('[{"DATA":"', "", $content_detail);
            $content_detail = str_replace('"}]', PHP_EOL, $content_detail);

            //isi filerekap
            $content_rekap = str_replace('[{"DATA":"', "", $content_rekap);
            $content_rekap = str_replace('"}]', PHP_EOL, $content_rekap);

            // Specify the storage folder dynamically
            $folder = 'TXT_FILE/';
            // Use the Storage facade to create the text file
            Storage::put($folder . $Nama_file_txt, $content_detail);
            Storage::put($folder . $Nama_file_txtctl, $content_rekap);

            $vproduk = ' ';
            if (substr($Nama_file_txt, 0, 3) == 'POS') {
                $vproduk = 'Pospaid';
                $Nama_file_remot = '';
                // $statuskirimftp[] = $this->proses_kirim_file_txt_keftp($Nama_file_txt);
                $result = $this->proses_kirim_file_txt_keftp($request, $Nama_file_txt);
                // Decode the JSON string
                $info = json_decode($result, true);
                // Check if decoding was successful
                if ($info !== null) {
                    $message = $info[0]['message'];
                } 
            } else if (substr($Nama_file_txt, 0, 3) == 'PRE') {
                $vproduk = 'Prepaid';
            } else if (substr($Nama_file_txt, 0, 3) == 'NTL') {
                $vproduk = 'Nontaglis';
            }

            $response = [
                'kdstatus' => '200',
                'status'  => 'success',
                'message' => 'File Txt MIV ' . $vproduk . ' sukses diproses dan Disimpan.',
                'Info_kirim_ftp' =>   $info,
                'data_detil'    => $MyData_detil['data'],
            ];
        } else {
            $response = [
                'kdstatus' => '400',
                'status'   => 'error',
                'message'  => 'File TXT MIV, gagal diproses dan di Upload Ke FTP.',
            ];
        }

        return response()->json($response);
    }
}
