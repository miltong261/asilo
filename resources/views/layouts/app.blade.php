<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>SHADAI NUEVA FAMILIA </title>
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo.jpeg') }}"/>
        <link rel="dns-prefetch" href="//fonts.gstatic.com">

        @include('inc.styles')
    </head>
    <body>
        <div id="load_screen"> <div class="loader"> <div class="loader-content">
            <div class="spinner-grow align-self-center"></div>
        </div></div></div>

        @include('inc.navbar')

        <div class="main-container" id="container">

            <div class="overlay"></div>
            <div class="search-overlay"></div>

            @if (Auth::check())
                @if (Auth::user()->rol_id == 1 && Auth::user()->estado == 1)
                    @include('inc._admin_sidebar')
                @elseif (Auth::user()->rol_id == 2 && Auth::user()->estado == 1)
                    @include('inc._secretaria_sidebar')
                @elseif (Auth::user()->rol_id == 3 && Auth::user()->estado == 1)
                    @include('inc._enfermera_sidebar')
                @endif
            @endif

            <div id="content" class="main-content">

                <router-view></router-view>

                @include('inc.footer')

            </div>

        </div>

        @include('inc.scripts')

    </body>
</html>

