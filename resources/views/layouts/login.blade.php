<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MIV P2APST | Management Instansi Vertikal</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{asset('adminlte320/plugins')}}/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="{{asset('adminlte320/plugins')}}/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="{{asset('adminlte320/plugins')}}/toastr/toastr.min.css">
  <link rel="stylesheet" href="{{asset('adminlte320/dist')}}/css/adminlte.min.css?v=3.2.0">
  <link rel="stylesheet" href="{{ asset('mystyle/css/style.css') }}">
  <script src="{{ asset('mystyle/js/myalertbs.js') }}"></script>
  <!-- <style>
    .custom-btn {
      min-width: calc(50%); /* Tambahkan 20px ekstra */
      padding: 5px 15px; /* Atur padding agar tetap proporsional */
    }
  </style> -->
</head>

<body class="hold-transition sidebar-mini">
  @if (session()->has('err_msg'))
  <div class="modal fade" tabindex="-1" id="bs-alert2">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Error</h4>
        </div>
        <div class="modal-body">
          <p>{{ session()->get('err_msg') }}&hellip;</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    window.onload = function() {
      fetch('/clear-err-msg', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          }
        })
        .then(response => {
          if (response.ok) {
            console.log('Session berhasil dihapus');
          } else {
            console.error('Gagal menghapus session');
          }
        })
        .catch(error => {
          console.error('Terjadi kesalahan:', error);
        });
      $('#btnmsg').click();
    }
  </script>
  @endif
  <section>
    <div class="login-box">
      <form action="/loginuser" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="col-12 mb-4">
          <h2>LOGIN</h2>
        </div>
        <p class="aplikasi">Monitoring & Laporan MIV P2APST</p>
        <div class="input-box">
          <span class="icon"><ion-icon name="mail"></ion-icon></span>
          <input type="text" name="email" value="{{ old('email') }}" autofocus>
          <label>Email / User Name</label>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
          <input type="password" name="password">
          <label>Password</label>
        </div>
        <div class="remember-forgate">
          <label><input type="checkbox"> Ingatkan </label><a href="">Lupa Password ?</a>
        </div>
        <div class="col-12 d-flex justify-content-center" style="padding-top: 25px;">
            <button class="btn btn-primary mx-2" type="submit" style="max-width: 200px; width: 50%;">Login</button>
            <button type="button" class="btn btn-default d-none" id="btnmsg" data-toggle="modal" data-target="#bs-alert2">Launch Default Modal</button>
        </div>
        <div class="register-link">
          <p>Don't have an accunt ? <a href="">Register</a></p>
        </div>
      </form>
    </div>
  </section>
  <script src="{{asset('adminlte320/plugins')}}/jquery/jquery.min.js"></script>
  <script src="{{asset('adminlte320/plugins')}}/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('adminlte320/plugins')}}/sweetalert2/sweetalert2.min.js"></script>
  <script src="{{asset('adminlte320/plugins')}}/toastr/toastr.min.js"></script>
  <script src="{{asset('adminlte320/plugins')}}/js/adminlte.min.js?v=3.2.0"></script>
  <script src="{{asset('adminlte320/plugins')}}/js/demo.js"></script>
</body>

</html>