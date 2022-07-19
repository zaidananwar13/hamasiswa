<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hamasiswa | Berbagi Rasa Kemahasiswaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Website Template by freehtml5.co" />
    <meta name="keywords"
        content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
    <meta name="author" content="freehtml5.co" />

    <meta property="og:title" content="" />
    <meta property="og:image" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />
    <meta property="og:description" content="" />
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />

    <link href="https://fonts.googleapis.com/css?family=Inconsolata:400,700" rel="stylesheet">

    <link rel="stylesheet" href="{{ url('air/css/animate.css') }}">
    <link rel="stylesheet" href="{{ url('air/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ url('air/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('air/css/flexslider.css') }}">

    <link rel="stylesheet" href="{{ url('air/css/style.css') }}">
    <style>
    </style>
    @yield('css')

    <script src="{{ url('air/js/modernizr-2.6.2.min.js') }}"></script>
    @yield('head-js')

</head>

<body>

    <div class="fh5co-loader"></div>

    <div id="page">
        <nav class="fh5co-nav" role="navigation">
            <div class="top-menu">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-2">
                            <div id="fh5co-logo"><a
                                    href="{{ \Session::has('mail') ? url('beranda') : url('/') }}">HaMahasiswa<span>*</span></a>
                            </div>
                        </div>
                        <div class="col-xs-10 text-right menu-1">
                            <ul>
                                @if (!\Session::has('login'))
                                    <li class="btn-cta"><a href="{{ url('login') }}"><span>Login</span></a></li>
                                    <li class="btn-cta">
                                        <a href="{{ url('register') }}">
                                            <span class="yellow">Daftar Akun</span>
                                        </a>
                                    </li>
                                @else
                                    <li class="has-dropdown">
                                        <a href="{{ url('profile') }}">{{ \Session::get('namae') }}</a>
                                    </li>
                                    <li class="btn-cta"><a href="{{ url('thread/create') }}"><span class="yellow">Post Thread</span></a></li>
                                    <li class="btn-cta"><a href="{{ url('logout') }}"><span>Logout</span></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </nav>

        <div>
            @yield('content')
        </div>

        <footer id="fh5co-footer" role="contentinfo"
            style="padding:0;  padding-top: 30px !important;padding-bot:20px !important;">
            <div class="container">


                <div class="row copyright">
                    <div class="col-md-12 text-center">
                        <p>
                            <small class="block">&copy; 2022 Halo Mahasiswa. All Rights Reserved.</small>
                            <small class="block">Designed by <a href="#">FreeHTML5.co</a> Customed by <a
                                    href="#">Nocty</a></small>
                        </p>

                    </div>
                </div>

            </div>
        </footer>
    </div>

    <div class="gototop js-top">
        <a href="#" class="js-gotop"><i class="icon-arrow-up22"></i></a>
    </div>

    <!-- jQuery -->
    <script src="{{ url('air/js/jquery.min.js') }}"></script>
    <!-- jQuery Easing -->
    <script src="{{ url('air/js/jquery.easing.1.3.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ url('air/js/bootstrap.min.js') }}"></script>
    <!-- Waypoints -->
    <script src="{{ url('air/js/jquery.waypoints.min.js') }}"></script>
    <!-- Flexslider -->
    <script src="{{ url('air/js/jquery.flexslider-min.js') }}"></script>
    <!-- Main -->
    <script src="{{ url('air/js/main.js') }}"></script>
    @yield('js')

</body>

</html>
