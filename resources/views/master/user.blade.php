<!DOCTYPE html>
<html lang="{{ app()->getLocale() ?? '-' }}">
<head>
    @include('user.includes.meta')
    @include('user.includes.styles')
    @yield('styles')
</head>
<body>
<div class="layout-wrapper layout-content-navbar  ">
    <div class="layout-container">
        @include('user.includes.sidebar')
        <div class="layout-page">
            @include('user.includes.navbar')
            <div class="content-wrapper">
                @yield('user-content')
                @include('sweetalert::alert')
                @include('user.includes.footer')
                <div class="content-backdrop fade"></div>
            </div>
        </div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
    <div class="drag-target"></div>
</div>
@include('user.includes.scripts')
@yield('scripts')
</body>
</html>
