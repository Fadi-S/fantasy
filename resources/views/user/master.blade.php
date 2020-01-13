<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    @yield('title')
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="{{ url('js/jquery.js') }}"></script>
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
</head>

<body background="{{ url('images/background.png') }}">
<nav class="navbar navbar-expand-lg navbar-toggleable-lg navbar-dark bg-dark fixed-top" id="navbar">
    <a class="navbar-brand" href="{{ url('/') }}">
        StGeorge Service
    </a>
    @if(auth()->check())
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{ url('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div>
    @endif
</nav>
<br><br><br><br>

    <div class="container-fluid">
        @yield("content")
        @include("admin.flash")
    </div>
    <script src="{{ url('js/app.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
</body>
</html>