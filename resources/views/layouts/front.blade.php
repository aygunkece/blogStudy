<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack("meta")
    <title>Anasayfa</title>
    <link rel="stylesheet" href="{{ asset("assets/front/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/front/css/style.css") }}">
    @yield("css")
</head>
<body>
<nav class="navbar navbar-expand-lg text-bg-dark">
    <div class="container ">
        <a class="navbar-brand text-white" href="#">BLOG.</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon text-white"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="#">Makaleler</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#"> Son Makaleler </a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="btn btn-outline-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item ms-3">
                            <a class="btn btn-outline-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                        <li class="nav-item d-flex align-items-center me-3">
                                {{ Auth::user()->name }}
                          </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-secondary text-white" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                @endguest
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-3">
    <div class="row d-flex">

        <div class="col-12 col-md-9">
            @yield("content")

        </div>
        <div class="col-12 col-md-3 d-flex">
            <ul class="list-group mx-auto">
                <li class="list-group-item disabled" aria-disabled="true">Popüler Kategoriler</li>
                <li class="list-group-item">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ asset('/assets/front/image/blog.jpeg') }}" class="card-img-top" style="height: 9rem;">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ asset('/assets/front/image/blog.jpeg') }}" class="card-img-top" style="height: 9rem;">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ asset('/assets/front/image/blog.jpeg') }}" class="card-img-top" style="height: 9rem;">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </li>


            </ul>
        </div>
    </div>
</div>

<footer id="footer" class="footer mt-3 text-bg-dark">

    <div class="footer-content pt-3 pb-3">
        <div class="container">

            <div class="row">
               <div class="col-12 text-center">
                   BLOG CASE STUDY
               </div>
            </div>
        </div>
    </div>

</footer>

<script src="{{ asset("assets/front/js/bootstrap.min.js") }}"></script>
<script src="{{ asset("assets/front/js/jquery.min.js") }}"></script>
<script src="{{ asset("assets/front/js/main.js") }}"></script>
<script src="https://kit.fontawesome.com/b0be4e7251.js" crossorigin="anonymous"></script>
@yield('js')
</body>
</html>
