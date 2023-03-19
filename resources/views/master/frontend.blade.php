<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('frontend.includes.meta')
    @include('frontend.includes.styles')
    @yield('styles')
</head>
<body>
<div class="body">
    @include('frontend.includes.navbar')
    @include('frontend.includes.header')
    @yield('front')
    @include('sweetalert::alert')
    @include('frontend.includes.footer')
    @include('frontend.includes.scripts')
</div>
@yield('scripts')
</body>
</html>
