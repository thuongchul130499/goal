<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    @include('layouts.style')
</head>
<body class="header-fixed">
    <div id="app">
        @include('layouts.header')
        <div class="@if(\Route::current()->getName() != 'show-user') page-body @endif">
            @include('layouts.sidebar')
            <div class="page-content-wrapper">
                @yield('content')
                @include('layouts.footer')
            </div>
        </div>
    </div>
    <script>
        function btnLoad(){
            return `<button class="btn btn-outline-primary btn-xs" id="load" type="button" disabled="">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span class="sr-only">Loading...</span>
                    </button>`;
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    @include('layouts.script')
    <script src="{{ asset('js/plugin.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
