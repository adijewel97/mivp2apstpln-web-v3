<nav class="main-header navbar navbar-expand navbar-white navbar-light bg-orange">
    {{-- <nav class="main-header navbar navbar-expand navbar-light navbar-white"> --}}

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        {{-- <li class="nav-item d-none d-sm-inline-block">
            <a href="../../index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li> --}}
    </ul>

    <ul class="navbar-nav ml-auto">

        {{-- <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li> --}}

        {{-- <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-comments"></i>
                    <span class="badge badge-danger navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item">

                        <div class="media">
                            <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar"
                                class="img-size-50 mr-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Brad Diesel
                                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">Call me whenever you can...</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>

                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">

                        <div class="media">
                            <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar"
                                class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    John Pierce
                                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">I got your message bro</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>

                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">

                        <div class="media">
                            <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar"
                                class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Nora Silvester
                                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">The subject goes here</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>

                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
            </li> --}}

        {{-- <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li> --}}
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item dropdown">
            {{-- <div class="image user-panel">
                    <img src="{{ asset('adminlte320/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                        alt="User Image">
                </div> --}}

            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                style="font-size: 12px; font-weight: bold">
                {{-- <img src="http://mivp2apstpln-web-v3.test/adminlte320/dist/img/AdminLTELogo.png" alt="user"
                    style="width: 30px;  margin-bottom: -0.25rem; margin-top: -.55rem; margin-left: 0.10rem;margin-right: 0.20rem;"> --}}
                <img src="{{ asset('images/user_adis.JPG') }}" alt="user" class="img-circle"
                    style="width: 30px; height: 30px; margin-bottom: -0.25rem; margin-top: -0.50rem; margin-left: 0.10rem;margin-right: 0.40rem;">
                {{--  class="brand-image img-circle elevation-4" --}}

                @if (Session::get('_datalogin.data.user.username'))
                    {{-- Str::upper(Session::get('_datalogin.data.user.username')) . ' - ' . Session::get('_datalogin.data.user.role') --}}
                    {{-- {{ Str::upper($userlogininfo['username']) . ' - ' . userlogininfo['userrole'] }} --}}
                    {{ Str::upper(Session::get('_datalogin.data.user.username')) . ' - ' . Str::upper(Session::get('_datalogin.data.user.role')) }}
                @endif
            </a>
            {{-- <div class="dropdown-menu" aria-labelledby="navbarDropdown3"> --}}
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <i class="fa fa-user mr-3"></i> Profil
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fa fa-cog mr-3"></i> Setting
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fa fa-lock mr-3"></i> Rubah Password
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/logoutuser">
                    <i class="fas fa-sign-out-alt mr-3"></i> Logout
                </a>
            </div>
        </li>
</nav>
