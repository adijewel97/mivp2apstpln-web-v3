@extends('layouts.main')

@section('container')
    <!-- Spinner Loading -->
    <div id="loadingSpinner">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- Overlay -->
    <div class="overlay"></div>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                {{-- <div class="row mb-2">
                        <div class="col-sm-6">
                            <h5>{{ $menuname }}</h5>
            </div> --}}
            {{-- <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Blank Page</li>
                            </ol>
                        </div> --}}
            {{-- </div> --}}
    </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

     <!-- Large Modal Body -->
     <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Header Modal -->
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Chek Log Proses File RCN Ke MIV</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Body Modal -->
                <div class="modal-body">
                    <div class="callout callout-info">
                        <form action="" enctype="multipart/form-data">
                            <div class="row" style="font-size:11px">
                                <label for="" class="col-sm-2 col-form-label">
                                    Tgl. Awal/Akhir
                                </label>
                                <div class="col-4">
                                    <div class="input-group date" id="tglawal" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#tglawal" />
                                        <div class="input-group-append" data-target="#tglawal" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-1 text-center">
                                    <label for="" class="col-form-label">/</label>
                                </div>
                                <div class="col-4">
                                    <div class="input-group date" id="tglakhir" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#tglakhir" />
                                        <div class="input-group-append" data-target="#tglakhir"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>                                
                            </div>

                            <div class="row mt-3" style="font-size:11px">
                                <label for="" class="col-sm-2 col-form-label">
                                    Petugas Download RCN
                                </label>
                                <div class="col-8">
                                    <select class="form-control" id="pilihauserid">
                                        <option value="SEMUA">PILIH SEMUA
                                        </option>
                                    </select>
                                </select>
                                </div>                             
                            </div>

                            <div class="row mt-3" style="font-size:11px">
                                <label for="" class="col-sm-2 col-form-label">
                                    Bank MIV
                                </label>
                                <div class="col-8">
                                    <select class="form-control" id="pilihkdbankmiv">
                                        <option value="SEMUA">PILIH SEMUA
                                        </option>
                                    </select>
                                </div>                             
                            </div>
                             
                            <div class="row mt-3" style="font-size:11px">
                                <div class="col-4">
                                </div>
                                <div class="col-2">
                                    <!-- <button id='BtnFindLogdbRcn' name='next' type='button'
                                        class='btn btn-block btn-primary'><i
                                            class="fa-solid fa-magnifying-glass"></i> Cari
                                    </button> -->
                                    <button id='BtnFindLogdbRcn' type="button" class="btn btn-primary" data-dismiss="modal">Cari</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Large Modal Body -->   
    
    <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-12">

                <!-- Default box -->
                <div class="card">
                    {{-- <div class="card-header">
                                <h1 class="card-title">{{ $title }}</h1>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div> --}}
                <div class="card-body">
                    <fieldset class="border p-3">
                        <legend class="w-auto">{{ $title }}</legend>

                        <div class="callout callout-info">
                            {{-- <h5><i class="fas fa-info"></i> Note:</h5> --}}
                            <form action="" enctype="multipart/form-data">
                                <label for="" class="col-sm-6 col-form-label">
                                    Tanggal : <time datetime="<?php echo date('c'); ?>"><?php echo date('d/m/Y H:i:s'); ?></time>
                                </label>
                                <div class="row mt-1" style="font-size:11px">
                                    <div class="col-4">
                                    </div>
                                    <div class="col-4">
                                        <button id='BtnFindFileRCN' name='next' type='button' class='btn btn-block btn-primary'><i class="fa-solid fa-magnifying-glass"></i> Tampilkan File *.RCN
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </fieldset>
                    <br>
                    <div class="form-group">
                        <label>File akan di Download dan Proses :</label>
                        <select id="pathfile" style="height: 100px;" multiple class="form-control listfile">
                        </select>
                    </div>
                    <div class="row mt-1" style="font-size:11px">
                        <div class="col-4">
                        </div>
                        <div class="col-2">
                            <button id='BtnPoeseRCN' type='button' class='btn btn-block btn-danger'><i class="fa fa-file-pdf-o"></i>
                                Proses</button>
                        </div>
                        <div class="col-2">
                            <button id='BtnHistoRCN' type='button' class='btn btn-block btn-info' data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-file-pdf-o"></i>
                                Histo Log</button>
                        </div>
                        
                    </div>

                    <br>
                    <div class="form-group">
                        <label>Log Proses Dowload File RCN dan CTL Bank MIV :</label>
                    </div>
                    <fieldset class="border p-3">
                        <div class="col-2 mb-3">
                            <button id="exportExcel" type="button" class="btn btn-success btn-block">
                                <i class="fa fa-file-excel-o"></i> Excel
                            </button>
                        </div>

                        <div class="table-responsive">
                            <!-- <table id="mytable" class="table table-sm yjtd-belumflagbank" style="font-size: 9px"> -->
                            <table id="mytable" class="display compact" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">NO</th>
                                        <th class="text-center">NAMAFILE</th>
                                        <th class="text-center">TGLPROSES</th>
                                        <th class="text-center">KETERANGAN</th>
                                        <th class="text-center">USERID</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyid">
                                </tbody>
                            </table>
                        </div>
                    </fieldset>

                    {{-- <div id="pdfContainer"></div> --}}

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{-- Footer --}}
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->
        </div>
        </div>
        <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->  
@endsection

@section('addfooterjs')
    <!-- daterangepicker -->
    <!-- Moment.js harus lebih dulu -->
    <script src="{{ asset('adminlte320/plugins/moment/moment.min.js') }}"></script>
    <!-- Date Range Picker -->
    <script src="{{ asset('adminlte320/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempus Dominus (DateTime Picker) -->
    <script src="{{ asset('adminlte320/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <script>
       $(document).ready(function() {
           document.querySelector("body").style.fontFamily;            
            TampilkanListFileRCN();
            combo_bankmiv();
            $('#pilihauserid').empty();
            $('#pilihauserid').append(new Option('PILIH SEMUA', 'SEMUA'));

            // Inisialisasi DateTimePicker
            $('#tglawal').datetimepicker({
                format: 'DD MMMM YYYY'
            });

            $('#tglakhir').datetimepicker({
                format: 'DD MMMM YYYY'
            });

            // Isi tanggal hari ini dengan metode DateTimePicker
            let firstdate = moment().startOf('month');
            let nowdate = moment();

            $('#tglawal').datetimepicker('date', firstdate);
            $('#tglakhir').datetimepicker('date', nowdate);

            // Set default value dropdown
            $('#pilihauserid').val('SEMUA');

            // Panggil data awal
            combo_userpetugas();

            // Event listener perubahan tanggal
            $('#tglawal, #tglakhir').on('change.datetimepicker', function() {
                combo_userpetugas();
            });

            // Event listener untuk dropdown user
            $('#pilihauserid').on('focus click', function() {
                combo_userpetugas();
            });

            //1 cari file RCN yang akan di tampilkan di list dari ftp MIV kiriman Bank
            document.getElementById("BtnFindFileRCN").onclick = function() {
                TampilkanListFileRCN();
                $("#tbodyid").empty();
            }

            //2 download file struk ke local device
            document.getElementById("BtnPoeseRCN").onclick = function() {
                $('#loadingSpinner').show();
                $('.overlay').show();

                // Ambil file list dari pilihan list browser
                var vlistfile = [];
                var selectElement = document.getElementById("pathfile");

                // Jika tidak ada file yang dipilih, tampilkan pesan error dan hentikan proses
                if (selectElement.options.length === 0) {
                    ShowMsgSm('Info', 'Tidak ada file di FTP yang akan diproses atau Clik Tombol Tampilkan File *.RCN.', 'MB_CLOSE');
                    $('#loadingSpinner').hide();
                    $('.overlay').hide();
                    return;
                }

                // Loop melalui opsi yang ada
                for (var i = 0; i < selectElement.options.length; i++) {
                    vlistfile.push(selectElement.options[i].value);
                }

                $.ajax({
                    url: "{{ route('mproses.proses-file-ftp-rcn') }}",
                    dataType: 'json',
                    data: {
                        vnamafile: vlistfile.join(", ")
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.status === '200') {
                            ShowMsgSm('Sukses', 'Jumlah file yang diproses sebanyak = ' + response.downloaded_files.length + ' File.', 'MB_CLOSE');
                            listdata = JSON.stringify(response.info_progres_ctl.data);
                            tampilmydatatable(listdata);
                        } else {
                            tampilmydatatable([]);
                            ShowMsgSm('Error', response.message, 'MB_CLOSE');
                        }
                        TampilkanListFileRCN();
                        $('#loadingSpinner').hide();
                        $('.overlay').hide();
                    },
                    error: function(req, status, error) {
                        console.log(req.responseJSON);
                        ShowMsgSm('Error', 'Terjadi kesalahan saat Baca File RCN.', 'MB_CLOSE');
                        TampilkanListFileRCN();
                        $('#loadingSpinner').hide();
                        $('.overlay').hide();
                    }
                });
            };

            //3 Tampilkan log user download RCN
            document.getElementById("BtnFindLogdbRcn").onclick = function() {
                $('#loadingSpinner').show();
                $('.overlay').show();

                let tglAwalPicker = $('#tglawal').datetimepicker('date');
                let tglAkhirPicker = $('#tglakhir').datetimepicker('date');
                if (!tglAwalPicker || !tglAkhirPicker) {
                    console.log('Tanggal tidak boleh kosong!');
                    ShowMsgSm('Error', 'Silakan pilih tanggal awal dan akhir!');
                    return;
                }
                let tglawal  = tglAwalPicker.format('YYYYMMDD');
                let tglakhir = tglAkhirPicker.format('YYYYMMDD');
                let userid   = $('#pilihauserid').val();
                let kdbank   = $('#pilihkdbankmiv').val();
                    // kdbank   = kdbank.split("|")[0];
                    kdbank = kdbank.split("|")[0] === 'ALL' ? 'SEMUA' : kdbank.split("|")[0];

                console.log('Tanggal Awal  a:', tglawal);
                console.log('Tanggal Akhir a:', tglakhir);
                console.log('userid        a:', userid);
                console.log('kdbank        a:', kdbank);

                // alert('test 1 ' + tglakhir);

                $.ajax({
                    url: "{{ route('mproses.cari-logdb-filercn') }}",
                    dataType: 'json',
                    type: "GET",
                    data: {
                        vuserid     : userid,
                        vtglawal    : tglawal,
                        vtglakhir   : tglakhir,
                        vkdbank     : kdbank 
                    },
                    success: function(response) {

                        if (response) {
                            console.log("DATA DB RCN", response);
                            console.log("DATA DB RCN DATA", response.data);
                        } else {
                            console.log("Response tidak ditemukan atau undefined");
                        }

                        if (response.kode === 200) {
                        // Tampilkan modal
                        $('.bd-example-modal-lg').modal('show');

                        if (response.data && response.data.length > 0) {
                            listdata = JSON.stringify(response.data);
                            console.log("Data ditemukan:", listdata);
                            tampilmydatatable(listdata);
                        } else {
                            listdata = '[]';
                            console.warn("Data kosong, tabel tetap ditampilkan.");
                            ShowMsgSm('Info', 'Data tidak ditemukan.', 'MB_CLOSE');
                            tampilmydatatable(listdata);
                        }

                        // Tutup modal setelah memastikan tabel sudah ter-update
                        setTimeout(function () {
                            $('.bd-example-modal-lg').modal('hide');
                        }, 1000); // 2 detik sebelum modal di-hide
                    } else {
                        console.error("Terjadi error:", response.message);
                        tampilmydatatable('[]'); // Pastikan tabel tetap diperbarui dengan data kosong
                        ShowMsgSm('Error', response.message, 'MB_CLOSE');

                        // Pastikan modal tetap terbuka untuk menunjukkan pesan error
                        $('.bd-example-modal-lg').modal('show');
                    }

                        TampilkanListFileRCN();
                        $('#loadingSpinner').hide();
                        $('.overlay').hide();
                    },
                    error: function(req, status, error) {
                        console.log(req.responseJSON);
                        ShowMsgSm('Error', 'Terjadi kesalahan saat Baca Log DB RCN.', 'MB_CLOSE');
                        // TampilkanListFileRCN();
                        $('#loadingSpinner').hide();
                        $('.overlay').hide();
                    }
                });
            };
       });

        function combo_userpetugas() {
            console.log("combo_userpetugas() dipanggil!");

            let tglAwalPicker = $('#tglawal').datetimepicker('date');
            let tglAkhirPicker = $('#tglakhir').datetimepicker('date');

            if (!tglAwalPicker || !tglAkhirPicker) {
                console.log('Tanggal tidak boleh kosong!');
                ShowMsgSm('Error', 'Silakan pilih tanggal awal dan akhir!');
                return;
            }

            let vtglawal  = tglAwalPicker.format('YYYYMMDD');
            let vtglakhir = tglAkhirPicker.format('YYYYMMDD');
            let vuserid   = $('#pilihauserid').val();

            console.log('Tanggal Awal:', vtglawal);
            console.log('Tanggal Akhir:', vtglakhir);
            console.log('vuserid      :', vuserid);

            $.when(
                $.ajax({
                    url: "{{ route('master.mst_userpetugasrcn') }}",
                    dataType: 'json',
                    type: 'POST',
                    data: {
                        tglawal: vtglawal,
                        tglakhir: vtglakhir,
                        userid: vuserid
                    }
                })
            ).done(function(respon) {
                console.log("Data diterima:", respon);

                let selectedValue = $('#pilihauserid').val(); 
                let dropdown = $("#pilihauserid");

                dropdown.empty(); 

                if (dropdown.find('option[value="SEMUA"]').length === 0) {
                    dropdown.append('<option value="SEMUA">PILIH SEMUA</option>');
                }

                if (respon.data && Array.isArray(respon.data) && respon.data.length > 0) {
                    respon.data.forEach(function(object) {
                        if (object.USERID && object.USERID.toUpperCase() !== 'SEMUA') {
                            dropdown.append(`<option value="${object.USERID}">${object.USERID}</option>`);
                        }
                    });
                }

                dropdown.val(selectedValue && dropdown.find(`option[value="${selectedValue}"]`).length ? selectedValue : 'SEMUA').trigger('change');

                console.log("Dropdown berhasil diperbarui");
            }).fail(function(req) {
                console.error("AJAX gagal:", req);
            });
        }


        function combo_bankmiv() {
            $.ajax({
                url: "{{ route('master.mst_bankmiv') }}",
                dataType: 'json',
                type: 'POST',
                success: function(respon) {
                    console.log("Data diterima:", respon); // Debugging

                    if (respon.status === 'Sukses' && Array.isArray(respon.data)) {
                        let options = ""; // Pastikan kosong dulu

                        respon.data.forEach(function(object) {
                            const vvalue = object.KODE_BANK + "|" + object.KODE_ERP;
                            const voption = object.NAMA_BANK;
                            
                            options += `<option value="${vvalue}">${voption}</option>`;
                        });

                        $("#pilihkdbankmiv").html(options); // Update dropdown
                    } else {
                        console.log("Format data tidak sesuai:", respon);
                        ShowMsgSm('Error', 'Format data dari server tidak sesuai.');
                    }
                },
                error: function(req, status, error) {
                    try {
                        let errResponse = JSON.parse(req.responseText);
                        console.log("Error Response:", errResponse.message);
                        ShowMsgSm('Error', 'Session User Habis, Silahkan login Ulang. ' + errResponse.message, 'MB_CLOSE');
                    } catch (e) {
                        console.log("Error parsing response:", req.responseText);
                        ShowMsgSm('Error', 'Session User Habis, Silahkan login Ulang. ' + req.responseText, 'MB_CLOSE');
                    }
                }
            });
        }

        function TampilkanListFileRCN() {
            $('#loadingSpinner').show();
            $('.overlay').show();
            $.ajax({
                url: "{{ route('mproses.daftar-file-ftp-rcn') }}",
                dataType: 'json',
                success: function(respon) {
                    console.log(respon);
                    $("#pathfile").html('');
                    if (respon.status === '200') {
                        options = '';
                        respon.downloaded_files.forEach(function(object) {
                            const file = object.file;
                            const path = object.path;
                            const status = object.status;

                            options = options + "<option  value=" + path + '/' + file +
                                ">" + file +
                                "</option>";
                        });

                        $("#pathfile").html(options);
                    }
                    $('#loadingSpinner').hide();
                    $('.overlay').hide();
                },
                error: function(req, status, error) {
                    try {
                        let errResponse = JSON.parse(req.responseText); // Parse JSON
                        console.log("Error Response:", errResponse.message); // Ambil "message"
                        ShowMsgSm('Error','Session User Habis, Silahkan login Ulang. '+errResponse.message, 'MB_CLOSE');
                    } catch (e) {
                        console.log("Error parsing response:", req.responseText); // Jika bukan JSON
                        ShowMsgSm('Error', 'Session User Habis, Silahkan login Ulang. '+req.responseText, 'MB_CLOSE');
                    }
                    $('#loadingSpinner').hide();
                    $('.overlay').hide();
                }
            });
        }

        function tampilmydatatable(listdata) {
            if (!listdata || listdata === '[]') {
                console.log("Data kosong, tidak menampilkan tabel.");
                listdata = '[]'; // Pastikan string kosong tetap JSON valid
            }

            let jsonData;
            try {
                jsonData = JSON.parse(listdata);
            } catch (e) {
                console.error("Error parsing JSON:", e);
                jsonData = [];
            }

            console.log('Cek Data:', jsonData); // Debugging

            // Bersihkan DataTable sebelum diinisialisasi ulang
            $('#mytable').DataTable().clear().destroy();

            var table = $('#mytable').DataTable({
                data: jsonData,
                processing: true,
                autoWidth: false,
                searching: true,
                paging: true,
                pageLength: 10,
                lengthChange: true,
                info: true,
                language: {
                    'loadingRecords': '&nbsp;',
                    'processing': 'Loading...',
                    'emptyTable': 'No records available',
                },
                scrollX: true,
                scrollY: 200,
                responsive: true,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                pageLength: 10,
                columnDefs: [{
                    "defaultContent": "",
                    "targets": "_all"
                }],
                columns: [
                    {
                        title: 'NO',
                        data: null,
                        sortable: false,
                        className: "text-right",
                        width: "5%",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    { title: 'NAMAFILE', data: 'NAMAFILE', width: "35%" },
                    { title: 'TGLPROSES', data: 'TGLPROSES', width: "20%", className: "text-center" },
                    { title: 'KETERANGAN', data: 'KET', width: "30%" },
                    { title: 'USERID', data: 'USERID', width: "10%" }
                ],
                // dom: 'Bfrtip',
                dom: '<"row"<"col-md-6"l><"col-md-6 text-end"f>>' +
                        '<"row"<"col-md-12"tr>>' +
                        '<"row mt-2"<"col-md-6"i><"col-md-6 text-end"p>>',
                pagingType: "simple_numbers" // Gunakan format paging yang lebih rapi
            });

            // Tombol Export Excel di luar tabel
            $('#exportExcel').off('click').on('click', function () {
                table.button('.buttons-excel').trigger();
            });
        }


    </script>
@endsection