<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <!-- CSRF Token -->
    <meta id="csrf" name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Sweetalert2 --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-dark">
    @if(Auth::check() && Auth::user()->approvedEmail == 0)
        <div id="sendContainer" class="container-fluid bg-warning sticky-top">
            @if(Auth::user()->email != "")
                <p id="sendEmailText" class="text-center">Your e-mail <code>{{Auth::user()->email}}</code> is not approved. <a href="#" id="sendVerification">Click here to send e-mail verification.</a></p>
            @else
                <p class="text-center">Please provide your e-mail to the <a href="{{route('account')}}">Account Page</a>.</p>
            @endif
        </div>

        <script> 

            $(()=>{
                $("#sendVerification").click((e)=>{
                    e.preventDefault();

                    $.ajax({
                        url: "{{route('profile.sendVerification')}}",
                        type: 'post',
                        data: { "_token":"{{csrf_token()}}"},
                        dataType: "html",
                        success: (data) => {
                            if(data == 1)
                                $("#sendEmailText").text("E-mail verification successfully sent.");
                        }
                    });
                });
            });

        </script>
    @endif
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ __('Gone By Celestial')}}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('game_info') }}">{{ __('Game Info') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('articles') }}">{{ __('Articles') }}</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="#">{{ __('Download') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">{{ __('About') }}</a>
                        </li> --}}
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>

                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->fname.' '.Auth::user()->lname }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->roles == '1')
                                        <a class="dropdown-item" href="{{ route('admin.index') }}">{{ __('Admin Dashboard') }}</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('account') }}">{{ __('My Account') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                        {{ __('Logout') }}
                                    </a>
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
</body>
</html>
