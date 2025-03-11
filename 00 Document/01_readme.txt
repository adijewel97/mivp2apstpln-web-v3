php artisan config:clear
php artisan cache:clear
php artisan optimize


php artisan route:list

isue
1 error :
   Error Response: Server Error
  solusi :
    1- Pastikan FTP Extensi PHP Aktif
    Buka php.ini di D:\laragon\bin\php\php-xx\php.ini
    Pastikan ekstensi berikut tidak dikomentari (; dihapus):
    ini
   
        extension=ftp
        Restart Laragon setelah mengubah konfigurasi.
   
    2- Cek Konfigurasi config/filesystems.php

        Pastikan disk FTP sudah dikonfigurasi dengan benar:
        'ftp' => [
            'driver'   => 'ftp',
            'host'     => env('FTP_HOST'),
            'username' => env('FTP_USERNAME'),
            'password' => env('FTP_PASSWORD'),
            'root'     => env('FTP_ROOT', ''),
            'port'     => env('FTP_PORT', 21),
            'passive'  => true,
            'ssl'      => false,
            'timeout'  => 30,
        ],
    
    3- Pastikan .env juga sudah diisi:
        FTP_HOST=ftp.example.com
        FTP_USERNAME=userftp
        FTP_PASSWORD=passftp
        FTP_PORT=21
        FTP_ROOT=/path/to/root