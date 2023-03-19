@extends('master.frontend')
@section('front')
    <section id="single-page-header">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="single-page-header-left">
                            <h2>404 Xəta - Səhifə tapılmadı</h2>
                            <p>Üzr istəyirik axtardığınız səhifə mövcud deyil.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="single-page-header-right">
                            <ol class="breadcrumb">
                                <li><a href="#">Ana səhifə</a></li>
                                <li class="active">404 - Səhifə tapılmadı</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="error">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="errror-page-area">
                        <h1 class="error-title"><span class="fa fa-bug"></span></h1>
                        <div class="error-content">
                            <span>Opps!</span>
                            <p>@lang('frontend.404-2')</p>
                            <a class="error-home" href="{{ route('frontend.index') }}">Ana səhifə</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
