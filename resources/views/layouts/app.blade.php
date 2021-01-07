<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/storage/acostudio/favicon.ico">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://kit.fontawesome.com/6e3c04dd1f.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>
<body>
    <div class="loading" >
        <div class="spinner-border m-4" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/storage/acostudio/logo3.png" class="d-block w-100 img-fluid" alt="...">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto justify-contents-flexstart">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-link d-flex align-items-center">
                                <a href="{{route('homepage')}}" class="text-light text-decoration-none">Home</a>
                            </li>
                            <li class="nav-link d-flex align-items-center">
                                <a href="{{route('products.index')}}" class="text-light text-decoration-none">Products</a>
                            </li>
                            @if(Auth::user()->role==2)
                            <li class="nav-link d-flex align-items-center">
                                <a href="{{route('payments.admin')}}" class="text-light text-decoration-none">Payments</a>
                            </li>
                            @elseif(Auth::user()->role==1)
                            <li class="nav-link d-flex align-items-center">
                                <a href="{{route('products.myproducts')}}" class="text-light text-decoration-none">My Products</a>
                            </li>
                            @endif
                            <li class="nav-link d-flex align-items-center">
                                <a href="{{route('orders.index')}}" class="text-light text-decoration-none">
                                    <i class="fas fa-shopping-cart" ></i>
                                </a>
                            </li>
                            <li class="nav-item dropdown justify-content-center d-flex">
                                <a id="navbarDropdown" class="nav-link d-flex align-items-center text-light dropdown-toggle justify-content-center " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{  __('Account') }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile.index') }}">
                                        {{ __('Profile') }}
                                    </a>
                                    @if(Auth::user()->role==1)
                                    <a class="dropdown-item" href="{{ route('payments.index') }}">
                                        {{ __('Payments History') }}
                                    </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('transaction.index') }}">
                                        {{ __('History Transaction') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <footer class="bg-dark footer p-4">
        <div class="row">
            <div class="col text-center text-white disabled">
                &copy ACOSTUDIO 2020
            </div>
        </div>
    </footer>
    <script>
        $(window).on("load",function(){
            $(".loading").fadeOut(500);
        });
    </script>
</body>
</html>
