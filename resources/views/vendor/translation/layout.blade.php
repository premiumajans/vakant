<!DOCTYPE html>
<html lang="en">
<head>
    <title>@lang('backend.translation-panel')</title>
    <link rel="stylesheet" href="{{ asset('/vendor/translation/css/main.css') }}">
</head>
<body>
<div id="app">
    @include('translation::nav')
    @include('translation::notifications')
    @yield('body')
</div>
<script src="{{ asset('/vendor/translation/js/app.js') }}"></script>
</body>
</html>


{{--@extends('master.backend')--}}
{{--@section('styles')--}}
{{--    <link rel="stylesheet" href="{{ asset('/vendor/translation/css/main.css') }}">--}}
{{--@endsection--}}
{{--@section('content')--}}
{{--    @include('translation::nav')--}}
{{--    @include('translation::notifications')--}}
{{--    @yield('body')--}}
{{--@endsection--}}
