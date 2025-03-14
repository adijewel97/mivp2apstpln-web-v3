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
                                <div class="col-3">
                                    <div class="input-group date" id="tglawal" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#tglawal" />
                                        <div class="input-group-append" data-target="#tglawal" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-3">
                                    <div class="input-group date" id="tglawal" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#tglawal" />
                                        <div class="input-group-append" data-target="#tglawal"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-sm-1 text-center">
                                    <label for="" class="col-form-label">/</label>
                                </div>
                                <div class="col-3">
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
                                    <button id='BtnFindData' name='next' type='button'
                                        class='btn btn-block btn-primary'><i
                                            class="fa-solid fa-magnifying-glass"></i> Cari
                                    </button>
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
                                        <button id='BtnFindDataRCN' name='next' type='button' class='btn btn-block btn-primary'><i class="fa-solid fa-magnifying-glass"></i> Tampilkan File *.RCN
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
                            <!-- <tfoot style="background-color: #a5a7a9">
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>TOTAL</th>
                                    <th id="tJMLBELUMLUNAS" class="text-right">0</th>
                                    <th id="tDATAUNPENDING" class="text-right">0</th>
                                    <th id="tRPTAG" class="text-right">0</th>
                                    <th id="tDATALBIH4LBR" class="text-right">0</th>
                                    <th id="tLAMA_HARI" class="text-right">0</th>
                                    <th id="f" class="text-right"></th>
                                </tr>
                            </tfoot> -->
                        </table>
                    </div>

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

    <script type="text/javascript">
        
        $(document).ready(function() {
            TampilkanListFileRCN();
            combo_bankmiv();
            $('#pilihauserid').empty();
            $('#pilihauserid').append(new Option('PILIH SEMUA', 'ALL'));
            // alert('chek 1');          
        });

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
                        ShowMsgSm('Error', 'Respon - ' + errResponse.message);
                    } catch (e) {
                        console.log("Error parsing response:", req.responseText);
                        ShowMsgSm('Error', 'Respon - ' + req.responseText);
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
                        ShowMsgSm('Error','Respon - '+errResponse.message);
                    } catch (e) {
                        console.log("Error parsing response:", req.responseText); // Jika bukan JSON
                        ShowMsgSm('Error', 'Respon - '+req.responseText);
                    }
                    $('#loadingSpinner').hide();
                    $('.overlay').hide();
                }
            });
        }

        function tampilmydatatable(listdata) {
            // var json = '[{"company_id":"1","company_name":"schneider"}]';
            var json = listdata;
            console.log('aku chek : ' + json);
            $('#mytable').DataTable({
                data: JSON.parse(json),
                processing: true,
                destroy: true,
                autoWidth: true,
                searching: true,
                paging: true, // Aktifkan paging
                pageLength: 10, // Atur jumlah baris per halaman (opsional)
                language: {
                    'loadingRecords': '&nbsp;',
                    'processing': 'Loading...',
                    'emptyTable': 'No records are available',
                },
                scrollX: true,               
                scrollY: 200,
                dom: 'Blfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel"></i> Excel',
                        className: 'dt-button buttons-excel buttons-html5 btn btn-xs btn-success',
                        footer: true,
                        title: 'DAFTAR PROSES DOWNLOAD FILE RCN BANK MIV',
                        filename: 'MIV-DownloadFileRcnBank_',
                        exportOptions: {
                            columns: "thead th:not(.noExport)",
                            rows: function(indx, rowData, domElement) {
                                return $(domElement).css("display") != "none";
                            }
                        }
                    },
                    {
                        extend: 'pdf',
                        footer: true,
                        text: '<i class="fa fa-file-pdf"></i> PDF',
                        className: 'dt-button buttons-excel buttons-html5 btn btn-xs btn-danger',
                        footer: true,
                        title: 'DAFTAR PROSES DOWNLOAD FILE RCN BANK MIV',
                        filename: 'MIV-DownloadFileRcnBank_',
                        orientation: 'landscape',
                    }
                ],
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
                        width: "1%",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    { title: 'NAMAFILE', data: 'NAMAFILE', width: "30%" },
                    { title: 'TGLPROSES', data: 'TGLPROSES', width: "10%" },
                    { title: 'KETERANGAN ', data: 'KET', width: "40%" },
                    { data: 'USERID', width: "20%" }
                ]
            });
        }

        $(function() {
            //1 cari file RCN yang akan di tampilkan di list dari ftp MIV kiriman Bank
            document.getElementById("BtnFindDataRCN").onclick = function() {
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
            document.getElementById("BtnFindData").onclick = function() {
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
                    url: "{{ route('mproses.cari-log-db-rcn') }}",
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
            
        });
    </script>    
@endsection

@section('addfooterjs')
    <!-- daterangepicker -->
    <!-- InputMask -->
    <script src="{{ asset('adminlte320/plugins/moment/moment.min.js') }}"></script>
    {{-- <script src="{{ asset('adminlte320/plugins/inputmask/jquery.inputmask.min.js') }}"></script> --}}
    <!-- date-range-picker -->
    <script src="{{ asset('adminlte320/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('adminlte320/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi DateTimePicker
            $('#tglawal').datetimepicker({
                format: 'DD MMMM YYYY'
            });

            $('#tglakhir').datetimepicker({
                format: 'DD MMMM YYYY'
            });

            // Isi tanggal hari ini
            let firstdate = moment().startOf('month').format('01 MMMM YYYY');
            let nowdate = moment().format('DD MMMM YYYY');
            $("#tglawal").find("input").val(firstdate);
            $("#tglakhir").find("input").val(nowdate);

            // Event listener perubahan tanggal
            $('#tglawal').on('change.datetimepicker', function() {
                setTimeout(combo_userpetugas, 200);
            });

            $('#tglakhir').on('change.datetimepicker', function() {
                setTimeout(combo_userpetugas, 200);
            });

            function combo_userpetugas() {
                let vtglawal  = $('#tglawal').datetimepicker('date').format('YYYYMMDD');
                let vtglakhir = $('#tglakhir').datetimepicker('date').format('YYYYMMDD');
                let vuserid   = $('#pilihauserid').val(); // Tambahkan # untuk ID

                if (vtglawal && vtglakhir) {
                    console.log('Tanggal Awal:', vtglawal);
                    console.log('Tanggal Akhir:', vtglakhir);

                    $.ajax({
                        url: "{{ route('master.mst_userpetugasrcn') }}",
                        dataType: 'json',
                        type: 'POST',
                        data: {
                            tglawal : vtglawal,
                            tglakhir: vtglakhir,
                            userid  : vuserid
                        },
                        success: function(respon) {
                            console.log("Data diterima:", respon);

                            if (respon.status === 'Sukses' && Array.isArray(respon.data)) {
                                let options = ""; 

                                respon.data.forEach(function(object) {
                                    const vvalue = object.KODE_BANK + "|" + object.KODE_ERP;
                                    const voption = object.NAMA_BANK;
                                    
                                    options += `<option value="${vvalue}">${voption}</option>`;
                                });

                                $("#pilihauserid").html(options);
                            } else {
                                console.log("Format data tidak sesuai:", respon);
                                ShowMsgSm('Error', 'Format data dari server tidak sesuai.');
                            }
                        },
                        error: function(req, status, error) {
                            try {
                                let errResponse = JSON.parse(req.responseText);
                                console.log("Error Response:", errResponse.message);
                                ShowMsgSm('Error', 'Respon - ' + errResponse.message);
                            } catch (e) {
                                console.log("Error parsing response:", req.responseText);
                                ShowMsgSm('Error', 'Respon - ' + req.responseText);
                            }
                        }
                    });
                }
            }
        });
    </script>
@endsection