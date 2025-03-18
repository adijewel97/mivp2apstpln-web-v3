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
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard Pelunasan MIV Existing</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v3</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <div class="row">
            <div class="col-sm-3 col-6">
                <div class="description-block border-right">
                    <span class="description-percentage text-success"><i class="fas fa-caret-down"></i></span>
                    <h5 class="description-header"><label id="mytotallbr"></label></h5>
                    <span class="description-text">TOTAL COUNT REVENUE</span>
                </div>
                <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-3 col-6">
                <div class="description-block border-right">
                    <span class="description-percentage text-success"><i class="fas fa-caret-down"></i> </span>
                    <h5 class="description-header"><label id="mytotalrp"></label></h5>
                    <span class="description-text">TOTAL AMOUNT REVENUE</span>
                </div>
                <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-3 col-6">
                <div class="description-block border-right">
                    <span class="description-percentage text-success"><label id="myporsenlbp_max">0%</label>
                    </span>
                    <h5 class="description-header"><label id="myMaxLbr">0</label></h5>
                    <span class="description-text">MAX COUNT </span>
                </div>
                <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-3 col-6">
                <div class="description-block">
                    <span class="description-percentage text-success"><label id="myporsenlrp_max">0%</label>
                    </span>
                    <h5 class="description-header"><label id="myMaxRptag">0</label></h5>
                    <span class="description-text">MAX AMOUNT</span>
                </div>
                <!-- /.description-block -->
            </div>
        </div>


        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">Pelunasan MIV Per-Dist./Wil.</h3>
                                    <!-- <a href="javascript:void(0);">View Report</a> -->
                                </div>
                            </div>
                            <div class="card-body">
                                {{-- <div class="d-flex">
                                        <p class="d-flex flex-column">
                                            <span class="text-bold text-lg">820</span>
                                            <span>Visitors Over Time</span>
                                        </p>
                                        <p class="ml-auto d-flex flex-column text-right">
                                            <span class="text-success">
                                                <i class="fas fa-arrow-up"></i> 12.5%
                                            </span>
                                            <span class="text-muted">Since last week</span>
                                        </p>
                                    </div> --}}
                                <!-- /.d-flex -->

                                <div class="position-relative mb-4">
                                    <table class="table table-bordered table-striped table-sm yajra-datatable" style="font-size: 10px">
                                        <thead>
                                            <tr>
                                                <th class="text-center">NOMOR</th>
                                                <th class="text-center">DISTRIBUSI</th>
                                                <th class="text-center">BANK</th>
                                                <th class="text-center">LEMBAR</th>
                                                <th class="text-center">RUPIAH/Rp.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot style="background-color: #a5a7a9">
                                            <tr>
                                                <th colspan="3">TOTAL</th>
                                                <th id="lembar">0</th>
                                                <th id="total">0</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <!-- /.card -->
                    </div>

                    <!-- /.col-md-6 -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">Grafik Rupiah MIV Per-Dis./Wil.</h3>
                                    <!-- <a href="javascript:void(0);">View Report</a> -->
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- <canvas id="stackedBarChart" style="height: 320px; width: 100%;"></canvas> -->
                                <canvas id="barChart_rptag" style="height: 100%;"></canvas>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">Grafik Lembar MIV Per-Dis./Wil.</h3>
                                    <!-- <a href="javascript:void(0);">View Report</a> -->
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- <canvas id="stackedBarChart" style="height: 320px; width: 100%;"></canvas> -->
                                <canvas id="barChart_lembar" style="height: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Page specific script -->
    <script type="text/javascript">
        function TampilkanGridData(vformattedDate) {
            const rupiah = (number) => {
                return new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR"
                }).format(number);
            }

            $('#loadingSpinner').show();
            $('.overlay').show();

            // alert('chek 2');
            var table = $('.yajra-datatable').DataTable({
                processing: false,
                serverSide: true,
                responsive: true,
                autoWidth: true,
                searching: false,
                paging: false,
                // lengthChange: true,
                // pageLength: 25,
                // lengthMenu: [
                //     [10, 25, 50, 100, 1000, -1],
                //     ['10', '25', '50', '100', '1000', 'All']
                // ],
                destroy: true,
                bInfo: false,
                // oLanguage: {
                //     "sInfo": "Awal _START_ ke _END_ (_TOTAL_ Data)", // text you want show for info section
                // },
                dom: 'Blfrtip',
                buttons: [
                    'excel'
                ],
                ajax: {
                    url: "{{ route('dashboard.flagperdist') }}",
                    data: function(d) {
                        d.vblthlaporan = vformattedDate;
                    }
                },
                columnDefs: [{
                    "targets": 0, // your case first column
                    "className": "text-left"
                }],
                columns: [{
                        title: 'NOMOR',
                        data: null,
                        sortable: false,
                        className: "text-right",
                        width: "4%",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    }, {
                        title: 'DISTRIBUSI',
                        data: null,
                        render: function(data, type, row) {
                            return row['KD_DIST'] + ' - ' + row['DIST'];
                        }
                    }, {
                        title: 'BANK',
                        data: 'NAMA_BANK',
                    }, {
                        data: 'BANK_LBR',
                        className: 'text-right',
                        render: $.fn.dataTable.render.number(',', '.', 0, '')
                    }, {
                        data: 'RPTAG',
                        className: 'text-right',
                        render: $.fn.dataTable.render.number('.', ',', 0, '')
                    }
                    //  {
                    //      data: 'action',
                    //      name: 'action',
                    //      orderable: true,
                    //      searchable: true
                    //  },
                ],
                drawCallback: function(row, data, start, end, display) {
                    var api = this.api();

                    // Remove the formatting to get integer data for summation
                    var intVal = function(i) {
                        return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ? i : 0;
                    };
                    // Total over all pages
                    lembar = api
                        .column(3)
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    total = api
                        .column(4)
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    $('#lembar').html($.fn.dataTable.render.number('.', '.', 0).display(lembar));
                    $('#total').html($.fn.dataTable.render.number('.', '.', 0).display(total));
                    $('#mytotallbr').html($.fn.dataTable.render.number('.', '.', 0).display(lembar));
                    $('#mytotalrp').html('Rp. ' + $.fn.dataTable.render.number('.', '.', 0).display(
                        total) + ',-');
                },
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        
        }



        // alert('chek 1');
        $(function() {
            var currentDate = new Date();
            // Extract the year and month
            var year = currentDate.getFullYear();
            var month = currentDate.getMonth() + 1; // Month is zero-based, so we add 1
            // Pad the month with leading zero if necessary
            if (month < 10) {
                month = '0' + month;
            }
            // Format the date as YYYYMM
            var formattedDate = year + '' + month;
            console.log(formattedDate);

            $('#loadingSpinner').show();
            $('.overlay').show();
            $.ajax({
                url: "{{ route('dashboard.flagperdist') }}",
                data: {
                    vblthlaporan: formattedDate,
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    //Iterating through the array using forEach
                    // var res_file = response.downloaded_files;
                    // res_file.forEach((file, index) => {
                    if (response.status = '200') {
                        // ShowMsgSm('Sukses', response.message, 'MB_CLOSE');
                        if (response.kode = '200') {
                            TampilkanGridData(formattedDate);
                            console.log(response.data);
                            jsonData = response.data;
                            // Mendapatkan nilai DIST dari setiap objek dalam array dan menyimpannya ke dalam array baru
                            var distArray = jsonData.map(function(item) {
                                return item.KD_DIST + ' ' + item.DIST;
                            });
                            var LbrArray = jsonData.map(function(item) {
                                return item.BANK_LBR;
                            });
                            var RptagArray = jsonData.map(function(item) {
                                return item.BANK_RPTAG;
                            });
                            // Mencetak array yang berisi nilai DIST
                            // console.log(RptagArray);
                            var maxLbr = Math.max.apply(null, LbrArray);
                            var maxrp = Math.max.apply(null, RptagArray);
                            var countLbr = LbrArray.length;
                            // Menggunakan reduce() untuk menghitung total dari RptagArray
                            var totalLbr = LbrArray.reduce(function(acc, curr) {
                                return parseInt(acc) + parseInt(curr);
                            }, 0);
                            var totalRptag = RptagArray.reduce(function(acc, curr) {
                                return parseInt(acc) + parseInt(curr);
                            }, 0); // 0 adalah nilai awal total
                            var porsenLbp = (maxLbr / totalLbr) * 100;
                            var porsenRp = (maxrp / totalRptag) * 100;

                            console.log('Total array : ' + totalLbr);
                            console.log('max : ' + maxLbr);
                            $('#myporsenlbp_max').html($.fn.dataTable.render.number('.', '.', 0).display(porsenLbp) + '%');
                            $('#myMaxLbr').html(maxLbr);
                            $('#myporsenlrp_max').html($.fn.dataTable.render.number('.', '.', 2).display(porsenRp) + '%');
                            $('#myMaxRptag').html('Rp. ' + $.fn.dataTable.render.number('.', '.', 0).display(
                                maxrp) + ',-');


                            // --------------------------------------------------------------------------
                            // Bar Chart Data RPTAG
                            var barData_rptag = {
                                labels: distArray, // Menggunakan array distArray sebagai label
                                datasets: [{
                                    label: 'RPTAG', // Ubah label sesuai dengan data yang dipetakan
                                    backgroundColor: '#28a745',
                                    data: RptagArray // Menggunakan array RptagArray sebagai data
                                }]
                            };

                            // Fungsi untuk memformat nilai menjadi format mata uang Rupiah
                            function formatRupiah(value) {
                                return 'Rp' + new Intl.NumberFormat('id-ID').format(value);
                            }

                            // Bar Chart Options
                            var barOptions_rptag = {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true,
                                            // Fungsi callback untuk menampilkan nilai sumbu Y dalam skala ribuan
                                            callback: function(value, index, values) {
                                                return value / 1000000 + 'Jt'; // Menampilkan nilai dibagi 1000 dan ditambah 'K' sebagai ribuan
                                            },
                                            tooltips: {
                                                callbacks: {
                                                    // Fungsi callback untuk menampilkan nilai tooltip dalam format Rupiah saat disorot
                                                    label: function(tooltipItem, data) {
                                                        var value = tooltipItem.yLabel;
                                                        return formatRupiah(value);
                                                    }
                                                }
                                            }
                                        }
                                    }]
                                }
                            };


                            // Get the context of the canvas element we want to select
                            var barChartCanvas = $('#barChart_rptag').get(0).getContext('2d');

                            // Create the chart
                            var barChart = new Chart(barChartCanvas, {
                                type: 'bar',
                                data: barData_rptag,
                                options: barOptions_rptag
                            });


                            // --------------------------------------------------------------------------
                            // Bar Chart Data Lembar
                            var barData_lembar = {
                                labels: distArray, // Menggunakan array distArray sebagai label
                                datasets: [{
                                    label: 'Lembar', // Ubah label sesuai dengan data yang dipetakan
                                    backgroundColor: '#28a745',
                                    data: LbrArray // Menggunakan array RptagArray sebagai data
                                }]
                            };
                            // Get the context of the canvas element we want to select
                            var barChartCanvas = $('#barChart_lembar').get(0).getContext('2d');

                            // Bar Chart Options
                            var barOptions_lbr = {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            };

                            // Create the chart
                            var barChart = new Chart(barChartCanvas, {
                                type: 'bar',
                                data: barData_lembar,
                                options: barOptions_lbr
                            });
                            // ShowMsgSm('Sukses', response.message, 'MB_CLOSE');
                            setTimeout(function() {
                                // Menyembunyikan spinner dan overlay setelah proses selesai
                                $('#loadingSpinner').hide();
                                $('.overlay').hide();
                                // alert("Data berhasil diproses!");
                            }, 3000);
                            $('#loadingSpinner').hide();
                            $('.overlay').hide();
                        } else {
                            $('#loadingSpinner').hide();
                            $('.overlay').hide();
                            ShowMsgSm('Error', response.message, 'MB_CLOSE');
                        }
                    } else {
                        setTimeout(function() {
                            // Menyembunyikan spinner dan overlay setelah proses selesai
                            $('#loadingSpinner').hide();
                            $('.overlay').hide();
                            // alert("Data berhasil diproses!");
                        }, 1000);
                        ShowMsgSm('Error', response.message, 'MB_CLOSE');
                    };
                },
                // error: function(req, status, error) {
                //     var err = req.responseText.Message;
                //     console.log(req.responseJSON);
                //     ShowMsgSm('Error', 'Terjadi kesalahan saat Baca File RCN.',
                //         'MB_CLOSE');
                // }
                error: function(request, error) {
                    console.log(arguments);
                    setTimeout(function() {
                        // Menyembunyikan spinner dan overlay setelah proses selesai
                        $('#loadingSpinner').hide();
                        $('.overlay').hide();
                    }, 1000);
                    
                    if (error === 'parsererror') {
                        ShowMsgSm('Error', 'Sesion Aplikasi Habis Silahkan Login Ulang !', 'MB_CLOSE');
                    } else {
                        ShowMsgSm('Error', 'Terjadi kesalahan : ' + error, 'MB_CLOSE');
                    }
                }
            });

        });
    </script>
    <!-- End Page specific script -->
@endsection