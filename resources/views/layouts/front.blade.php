<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="userId" content="{{ Auth::check() ? Auth::user()->id : '' }}">
    <title>@yield('title', config('app.name')) - Laravel 商城</title>

    {{-- 樣式 --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('style')
</head>
<body>
<div id="app">

    @include('layouts.frontHeader._header')

    <div id="alert-block"></div>
    <main class="container-fluid">

        <div class="row">
            @include('layouts.frontSidebar._sideBar')
            <div class="col-lg-10 mt-3">
                    @yield('content')
            </div>
        </div>
    </main>
    @include('layouts.frontFooter._footer')

</div>

{{-- JS腳本 --}}
<script src="{{ asset('js/app.js') }}"></script>
@stack('script')
</body>
</html>