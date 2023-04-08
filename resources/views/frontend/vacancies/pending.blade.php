@extends('master.frontend')
@section('front')
    <section class="ftco-section bg-light">
        <div class="container pending-vacancy" style="padding-top: 15px;">
            <div class="row d-flex mb-5 contact-info">
                <div class="col-md-12 mb-2">
                    <h2 class="h3">{{ $position }}</h2>
                </div>
                <div class="w-100"></div>
                <div class="col-md-12">
                    <p style="color: black"><span>@lang('backend.your-item-number'):</span> #{{ $id }}</p>
                </div>
                <div class="col-md-12">
                    <p style="color: black"><span>@lang('backend.your-item-message')</p>
                </div>
            </div>
        </div>
    </section>
@endsection

