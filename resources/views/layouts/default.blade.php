<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="/css/bootstrap.css" rel="stylesheet">
        <link href="/css/main.css" rel="stylesheet">
        {{--  <script src="/js/jquery.js"></script>  --}}
        <script src="/js/form.js"></script>
        <script src="/js/popper.js"></script>
        <script src="/js/bootstrap.js"></script>
    </head>
    <body>
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="/">Квестра инвестра</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                         @if(!\Auth::guest()) 
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('referals') }}">Рефералы</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('history')  }}">История</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('profile') }}">Профиль</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}">Выход</a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href={{ route('register') }}>Регистрация</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href={{ route('login') }}>Вход</a>
                            </li>
                    </ul>
                    @endif
                </div>
                
            </div>
        </nav>

        @yield('content')
        
    </body>
</html>