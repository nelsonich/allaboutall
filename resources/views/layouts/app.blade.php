<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('/storage/icon.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/helpers.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
    <script src="{{ asset('js/slick/slick.min.js') }}" defer></script>
    <script src="{{ asset('js/fontawesome/all.min.js') }}" defer></script>

    @stack('scripts')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/media.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slick/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slick/slick-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome/all.min.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="p-2">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/">
                Все <span style="color: #FF3C36">Обо</span> Всем
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
              <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px;">
                {{-- <li class="nav-item active">
                  <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    Link
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Link</a>
                </li> --}}
              </ul>

              {{-- Social icons --}}
              @include("includes.social_icons")
            </div>
        </nav>

        <main class="py-2">
            @yield('content')
        </main>

        <footer>
          <div class="d-flex">
            <div>
              <h1>
                <i>Все Обо Всем</i>
              </h1>

              {{-- Social icons --}}
              @include("includes.social_icons")

            </div>
            <div>
              <h3>Политика</h3>
              <ul>
                <li>Lorem</li>
                <li>Lorem</li>
                <li>Lorem</li>
                <li>Lorem</li>
                <li>Lorem</li>
              </ul>
            </div>
            <div>
              <h3>Рекомендуемые</h3>
              <ul>
                <li>Lorem</li>
                <li>Lorem</li>
                <li>Lorem</li>
              </ul>
            </div>
            <div>
              <h3>FAQ</h3>
              <ul>
                <li>Lorem</li>
                <li>Lorem</li>
                <li>Lorem</li>
                <li>Lorem</li>
                <li>Lorem</li>
                <li>Lorem</li>
                <li>Lorem</li>
              </ul>
            </div>
            <div>
              <h3>+Больше</h3>
              <ul>
                <li>Lorem</li>
                <li>Lorem</li>
                <li>Lorem</li>
                <li>Lorem</li>
                <li>Lorem</li>
              </ul>
            </div>
          </div>
          <div>
            <p class="m-0">ВсеОбоВсем &copy; Все права защищены {{ date('Y') }}</p>
          </div>
        </footer>
    </div>
</body>
</html>
