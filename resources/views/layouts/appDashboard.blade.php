<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}" defer></script>
    <script src="{{ asset('js/dashboard/script.js') }}" defer></script>
    <script src="{{ asset('js/dashboard/bootstrap-tagsinput.min.js') }}" defer></script>
    <script src="{{ asset('js/fontawesome/all.min.js') }}" defer></script>

    @stack('script')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard/tagsinput.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome/all.min.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <div class="leftBar hide">
        <div class="header">
            <a href="{{ url('home') }}">AllAboutALL</a>
            <span class="leftMenuToggle">
                <i class="fas fa-align-justify"></i>
            </span>
        </div>
        <ul>
            @forelse($permissions as $key => $permission)
                @if($permission['actions']['is_view'])
                    <li>
                        <a href="{{ url('dashboard/' . $permission->slug . '?key=' . $permission->slug) }}">
                            <span class="listName hide">{{ $permission->name }}</span>
                            <span class="listIcon">{{ mb_substr($permission->name, 0, 1) }}</span>
                        </a>
                    </li>
                @endif
            @empty
                Empty!
            @endforelse
        </ul>
    </div>
    <main style="width: calc(100vw - 10%);transform: translate(50%, 0px);">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            Панель приборов
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        @stack('modals')
    </main>
    <div class="rightBar hide">
        <div class="header">
            <span class="rightMenuToggle">
                <i class="fas fa-align-justify"></i>
            </span>
        </div>
    </div>
</div>
</body>
</html>
