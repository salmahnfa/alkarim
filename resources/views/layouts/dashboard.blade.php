<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>{{ $title }}</title>
        <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
        <link rel="icon" href="/assets/img/icon.ico" type="image/x-icon"/>

        <!-- Fonts and icons -->
        <script src="/assets/js/plugin/webfont/webfont.min.js"></script>
        <script>
            WebFont.load({
                google: {"families":["Open+Sans:300,400,600,700"]},
                custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['/assets/css/fonts.css']},
                active: function() {
                    sessionStorage.fonts = true;
                }
            });
        </script>

        <!-- CSS Files -->
        <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/css/azzara.min.css">

        <!-- CSS Just for demo purpose, don't include it in your project -->
        {{-- <link rel="stylesheet" href="/assets/css/demo.css"> --}}
    </head>
    <body>
        <div class="wrapper">
            <!--
                Tip 1: You can change the background color of the main header using: data-background-color="blue | purple | light-blue | green | orange | red"
            -->
            <div class="main-header" data-background-color="purple">
                <!-- Logo Header -->
                <div class="logo-header">

                    <a href="index.html" class="logo">
                        <img src="/assets/img/logoazzara.svg" alt="navbar brand" class="navbar-brand">
                    </a>
                    <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon">
                            <i class="fa fa-bars"></i>
                        </span>
                    </button>
                    <button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
                    <div class="navbar-minimize">
                        <button class="btn btn-minimize btn-rounded">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                </div>
                <!-- End Logo Header -->

                <!-- Navbar Header -->
                <nav class="navbar navbar-header navbar-expand-lg">

                    <div class="container-fluid">
                        <div class="collapse" id="search-nav">
                            <form class="navbar-left navbar-form nav-search mr-md-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="submit" class="btn btn-search pr-1">
                                            <i class="fa fa-search search-icon"></i>
                                        </button>
                                    </div>
                                    <input type="text" placeholder="Search ..." class="form-control">
                                </div>
                            </form>
                        </div>
                        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                            <li class="nav-item toggle-nav-search hidden-caret">
                                <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
                                    <i class="fa fa-search"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>

            <!-- Sidebar -->
            <div class="sidebar">
            <div class="sidebar-background"></div>
                <div class="sidebar-wrapper scrollbar-inner">
                    <div class="sidebar-content">
                        <div class="user">
                            <div class="avatar-sm float-left mr-2">
                                <img src="/assets/img/profile.jpg" alt="" class="avatar-img rounded-circle">
                            </div>
                            <div class="info">
                                <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                                    <span>
                                        {{ Auth::user()->nama }}
                                        <span class="user-level">{{ Auth::user()->role->nama }}</span>
                                        <span class="caret"></span>
                                    </span>
                                </a>
                                <div class="clearfix"></div>

                                <div class="collapse in" id="collapseExample">
                                    <ul class="nav">
                                        <li>
                                            <a href="#profile">
                                                <span class="link-collapse">My Profile</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#edit">
                                                <span class="link-collapse">Edit Profile</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#settings">
                                                <span class="link-collapse">Settings</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <ul class="nav">
                            @switch(Auth::user()->role_id)
                                @case(1)
                                    @include('layouts.components')
                                    @break
                                @case(2)
                                    @include('ppq.components')
                                    @break
                                @case(3)
                                    @include('admin_unit.components')
                                    @break
                                @case(4)
                                    @include('guru_quran.components')
                                    @break
                                @default
                                    <div class="alert alert-danger">Error: Unknown role {{ Auth::user()->role_id }}</div>
                            @endswitch

                            <li class="nav-item">
                                <a href="{{ route('logout') }}">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <p>Log Out</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Sidebar -->

            @yield('content')

            <!-- Custom template | don't include it in your project! -->
            <div class="custom-template">
                <div class="title">Settings</div>
                <div class="custom-content">
                    <div class="switcher">
                        <div class="switch-block">
                            <h4>Topbar</h4>
                            <div class="btnSwitch">
                                <button type="button" class="changeMainHeaderColor" data-color="blue"></button>
                                <button type="button" class="selected changeMainHeaderColor" data-color="purple"></button>
                                <button type="button" class="changeMainHeaderColor" data-color="light-blue"></button>
                                <button type="button" class="changeMainHeaderColor" data-color="green"></button>
                                <button type="button" class="changeMainHeaderColor" data-color="orange"></button>
                                <button type="button" class="changeMainHeaderColor" data-color="red"></button>
                            </div>
                        </div>
                        <div class="switch-block">
                            <h4>Background</h4>
                            <div class="btnSwitch">
                                <button type="button" class="changeBackgroundColor" data-color="bg2"></button>
                                <button type="button" class="changeBackgroundColor selected" data-color="bg1"></button>
                                <button type="button" class="changeBackgroundColor" data-color="bg3"></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="custom-toggle">
                    <i class="flaticon-settings"></i>
                </div>
            </div>
            <!-- End Custom template -->
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="/assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="/assets/js/core/popper.min.js"></script>
    <script src="/assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery UI -->
    <script src="/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Moment JS -->
    <script src="/assets/js/plugin/moment/moment.min.js"></script>

    <!-- Chart JS -->
    <script src="/assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="/assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="/assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- Bootstrap Toggle -->
    <script src="/assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="/assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
    <script src="/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

    <!-- Google Maps Plugin -->
    <script src="/assets/js/plugin/gmaps/gmaps.js"></script>

    <!-- Sweet Alert -->
    <script src="/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Azzara JS -->
    <script src="/assets/js/ready.min.js"></script>

    <!-- Azzara DEMO methods, don't include it in your project! -->
    {{-- <script src="/assets/js/setting-demo.js"></script>
    <script src="/assets/js/demo.js"></script> --}}

    <script>
        $(document).ready(function() {
            // Get the current URL
            var currentUrl = window.location.href;

            // Loop through each nav item
            $('.nav-item').each(function() {
                // Get the href attribute of the nav item
                var navItemHref = $(this).find('a').attr('href');

                // Check if the current URL matches the nav item href
                if (currentUrl.indexOf(navItemHref)!== -1) {
                    // Add the active class to the nav item
                    $(this).addClass('active submenu');
                }
            });

            $('.collapse').each(function() {
                // Get the href attribute of the nav item
                var collapseHref = $(this).find('a').attr('href');

                // Check if the current URL matches the nav item href
                if (currentUrl.indexOf(collapseHref)!== -1) {
                    // Add the active class to the nav item
                    $(this).addClass('show');
                }
            });
        });
    </script>

    @yield('script')

    </body>
</html>
