<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @if(Session::has('download.in.the.next.request'))
        <meta http-equiv="refresh" content="0; url='{{ Session::get('download.in.the.next.request') }}'">     
        @endif

        <title>{{ config('app.name', 'VEGA IT ServiceDesk') }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/jquery.datetimepicker.css') }}" rel="stylesheet">
        <!-- Scripts -->
        @if (session('filename'))
        <script type="text/javascript">
            var sxf = "/{{session('filename')}}";
            if (sxf) {
                var win = window.open(sxf, '_blank');
                win.focus();
            }
        </script>  
        @endif
        <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/table-sort.js') }}"></script>
        <script src="{{ asset('js/jquery.maskedinput.js') }}"></script>
        <script src="{{ asset('js/table2csv.js') }}"></script>

        </head>
        <body>
            <div id="app">
                <nav class="navbar navbar-default navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">

                            <!-- Collapsed Hamburger -->
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                                <span class="sr-only">Toggle Navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                            <!-- Branding Image -->
                            <a class="navbar-brand" href="{{ url('/') }}">
                                {{ config('app.name', 'Laravel') }}
                            </a>
                        </div>

                        <div class="collapse navbar-collapse" id="app-navbar-collapse">
                            <!-- Left Side Of Navbar -->
                            <ul class="nav navbar-nav">
                                &nbsp;
                            </ul>

                            <!-- Right Side Of Navbar -->
                            <ul class="nav navbar-nav navbar-right">
                                <!-- Authentication Links -->
                                @if (Auth::guest())
                                <li><a href="{{ route('login') }}">Login</a></li>
                                <li><a href="{{ route('register') }}">Register</a></li>
                                @else
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{route('edit_profile')}}">Edit profile</a></li>
                                        <li>
                                            <a href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>

                                    </ul>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </nav>


            </div>
            @auth
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ">
                        <nav class="navbar navbar-light bg-light">
                            <a class="navbar-brand" href="/">Заявки по картриджам</a>
                            <a class="navbar-brand" href="{{route('lockevents')}}">Заявки по замкам</a>
                            <a class="navbar-brand" href="{{route('printers')}}">Принтеры/МФУ</a>
                            <a class="navbar-brand" href="{{route('cartridges')}}">Картриджи</a>
                            <a class="navbar-brand" href="{{route('dependences')}}">Зависимости</a>
                            <a class="navbar-brand" href="{{route('emails')}}">Контроль email</a>
                        </nav>
                    </div>
                </div>
            </div>     
            @endauth

            @yield('content')

            <!-- Footer -->
            <footer class="page-footer font-small blue">

                <!-- Copyright -->
                <div class="footer-copyright text-center py-3">© <?php echo date('Y'); ?> Copyright:
                    <a href="https://vk.com/szaharov"> Захаров С.О.</a>
                </div>
                <!-- Copyright -->

            </footer>
            <!-- Footer -->
        </body>
    </html>
