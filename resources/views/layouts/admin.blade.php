
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    @stack("meta")
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Neptune - Responsive Admin Dashboard Template</title>

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="{{ asset('/assets/admin/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/plugins/perfectscroll/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/plugins/pace/pace.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/plugins/summernote/summernote-lite.min.css') }}" rel="stylesheet">


    <!-- Theme Styles -->
    <link href="{{ asset('/assets/admin/css/main.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/css/custom.css') }}" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/assets/admin/images/neptune.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/assets/admin/images/neptune.png') }}" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    @yield("css")
    <![endif]-->
</head>
<body>
<div class="app align-content-stretch d-flex flex-wrap">
    <div class="app-sidebar">
        <div class="logo">
            <a href="#" class="logo-icon"><span class="text-dark">BLOGADMIN.</span></a>

        </div>
        <div class="app-menu">
            <ul class="accordion-menu">
                <li class="sidebar-title">
                    İşlemler
                </li>
                <li class="active-page">
                    <a href="{{ route('article.create') }}" class="active"><i class="material-icons-two-tone text-dark ">post_add</i>Makale Ekle</a>
                </li>
                <li>
                    <a href="{{ route('articles') }}"><i class="material-icons-two-tone text-dark ">article</i>Makale Listesi</a>
                </li>

            </ul>
        </div>
    </div>
    <div class="app-container">
        <div class="search">
            <form>
                <input class="form-control" type="text" placeholder="Type here..." aria-label="Search">
            </form>
            <a href="#" class="toggle-search"><i class="material-icons">close</i></a>
        </div>
        <div class="app-header">
            <nav class="navbar navbar-light navbar-expand-lg">
                <div class="container-fluid">
                    <div class="navbar-nav" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link hide-sidebar-toggle-button" href="#"><i class="material-icons">first_page</i></a>
                            </li>
                        </ul>

                    </div>
                    <div class="d-flex">
                        @auth
                        <ul class="navbar-nav ml-auto">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <li class="nav-item hidden-on-mobile">
                                <a class="nav-link active" href="#">{{ Auth::user()->name }}</a>
                            </li>
                            <li class="nav-item hidden-on-mobile">
                                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            </li>

                        </ul>
                        @endauth
                    </div>
                </div>
            </nav>
        </div>
        <div class="app-content">
            <div class="content-wrapper">
                <div class="container">
                    <div class="row">
                     @yield("content")
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Javascripts -->
<script src="{{ asset('/assets/admin/plugins/jquery/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('/assets/admin/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/assets/admin/plugins/perfectscroll/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('/assets/admin/plugins/pace/pace.min.js') }}"></script>
<script src="{{ asset('/assets/admin/plugins/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('/assets/admin/js/main.min.js') }}"></script>
<script src="{{ asset('/assets/admin/js/custom.js') }}"></script>
<script src="{{ asset('/assets/admin/js/pages/dashboard.js') }}"></script>
<script src="{{ asset("/assets/admin/plugins/flatpickr/flatpickr.js") }}"></script>
<script src="{{ asset("/assets/admin/js/pages/datepickers.js") }}"></script>
<script src="{{ asset("/assets/admin/plugins/summernote/summernote-lite.min.js") }}"></script>
<script src="{{ asset("/assets/admin/js/pages/text-editor.js") }}"></script>
<script>
    $("#publishDate").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    });
</script>
@yield('js')
</body>
</html>
