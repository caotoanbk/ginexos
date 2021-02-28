<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>GinexOS</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,300&display=swap" rel="stylesheet">
    <style>
        body{
            font-family: 'Open Sans', sans-serif;
        }
        a,a:focus, button:focus{
            outline: 0;
        }
        .custom_select {
            padding: 4px 8px;
            border: 1px solid #dce4ec;
            border-radius: 4px;
            margin-bottom: 5px;
        }
    </style>
    @yield('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">GinexOS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ml-auto">
                @if (Auth::guest())
                    <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>
                @else
                <li class="nav-item"><a class="nav-link {{ request()->is('tra-cuu') ? 'active' : ''}}" href="{{ route('tracuu') }}">Tra cứu</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('bang-cong') ? 'active' : ''}}" href="{{ route('bangcong') }}">Bảng công</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('importExport') ? 'active' : ''}}" href="{{ route('uploadexcel') }}">Upload Bảng Công</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('crudapp') }}" >Cài đặt</a>
                        <a class="dropdown-item" href="#" 
                        aria-labelledby="navbarDropdownMenuLink"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="/logout" method="GET" style="display: none;">
                            {{ csrf_field() }}</form>
                    </div>
                </li>
                @endif
                </ul>
            </div>
        </div>
        </nav>
        <div class="container">

            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/datatables.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>
    @yield('javascript')
</body>
</html>
