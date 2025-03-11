@extends('layouts.main')

@section('container')
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
                    <div class="col-5">
                    </div>
                    <div class="col-2">
                        <button id='BtnPoeseRCN' name='next' type='button' class='btn btn-block btn-primary'><i class="fa fa-file-pdf-o"></i>
                            Proses</button>
                    </div>
                </div>

                <br>
                <div class="form-group">
                    <label>Log Proses Dowload File RCN dan CTL Bank MIV :</label>
                </div>
                <div class="table-responsive">
                    <table id="mytable" class="table table-sm yjtd-belumflagbank" style="font-size: 9px">
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


    {{-- alert boostrap from javasecript me --}}
    <script src="{{ asset('mystyle/js/myalertbs.js') }}"></script>

    <!-- Page specific script -->
    <script type="text/javascript">
        TampilkanListFileRCN();
        // alert('chek 1');
        function TampilkanListFileRCN() {
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

                //2 ambil file list dari pilihan list browser
                var vlistfile = [];
                // Get the select element by its ID
                var selectElement = document.getElementById("pathfile");
                // Loop through the options and extract their values
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
                        //Iterating through the array using forEach
                        // var res_file = response.downloaded_files;
                        // res_file.forEach((file, index) => {
                        if (response.status = '200') {
                            // ShowMsgSm('Sukses', response.message, 'MB_CLOSE');
                            ShowMsgSm('Sukses', 'Jumlah file yang diproses Sebayak = ' + response.downloaded_files.length + ' File.', 'MB_CLOSE');
                            listdata = JSON.stringify(response.info_progres_ctl.data);
                            tampilmydatatable(listdata);
                        } else {
                            ShowMsgSm('Error', esponse.message, 'MB_CLOSE');
                        };
                        TampilkanListFileRCN();
                    },
                    error: function(req, status, error) {
                        var err = req.responseText.Message;
                        console.log(req.responseJSON);
                        ShowMsgSm('Error', 'Terjadi kesalahan saat Baca File RCN.',
                            'MB_CLOSE');
                        TampilkanListFileRCN();
                    }
                });
            }
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
        $(function() {
            //Date picker
            $('#reservationdate').datetimepicker({
                // format: 'L',
                format: 'MMMM YYYY',
            });

            //isi tanggal hari ini
            let nowdate = moment(Date.now()).format('MMMM YYYY');
            $("#reservationdate").find("input").val(nowdate);

        });
    </script>
    @endsection