<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MIV P2APST - Monitoring</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte320/docs/assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte320/dist/css/adminlte.min.css?v=3.2.0') }}">

    <!-- Scroll di sidebar -->
    <link rel="stylesheet" href="{{ asset('adminlte320/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css" />

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('adminlte320/plugins/daterangepicker/daterangepicker.css') }}">

    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{ asset('adminlte320/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('adminlte320/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('adminlte320/plugins/toastr/toastr.min.css') }}">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- Alert Bootstrap custom -->
    <script type="text/javascript" src="{{ asset('mystyle/js/myalertbs.js') }}"></script>

    <!-- Grafik -->
    <link rel="stylesheet" href="{{ asset('adminlte320/plugins/chart.js/Chart.min.css') }}">

    <!-- Muat CSS eksternal -->
    <link rel="stylesheet" href="{{ asset('mystyle/css/style_loading.css') }}">

    <!-- Tambahkan style CSS di sini -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            font-size: 0.85rem;
            background-color: #f4f6f9;
        }

        .card-custom {
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            background: white;
        }

        .btn-custom {
            border-radius: 5px;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        .table-custom th {
            background: #f8f9fa;
            font-weight: bold;
        }

        .dataTables_paginate {
            text-align: center !important;
        }

        /* Datatable style */
        .dataTables_paginate .pagination {
            margin: 0 !important;
            padding: 0 !important;
            gap: 2px; /* Atur jarak antar tombol */
        }

        .dataTables_paginate .pagination li {
            margin: 0 !important;
            padding: 0 !important;
        }

    </style>

</head>
