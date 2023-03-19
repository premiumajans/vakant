@extends('master.user')
@section('user-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mx-0 gy-3 px-lg-5">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <span
                            class="badge bg-label-primary">{{ $package->translate(app()->getLocale())->title ?? '-' }}</span>
                        <div class="d-flex justify-content-center">
                            <sup class="h5 pricing-currency mt-3 mb-0 me-1 text-primary">₼</sup>
                            <h1 class="display-5 mb-0 text-primary">{{ $package->monthly_payment }}</h1>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-1 mt-3">
                        <span>{{  0 .'/'. $package->ads_count }}</span>
                        <span>80% Completed</span>
                    </div>
                    <div class="progress mb-1" style="height: 8px;">
                        <div class="progress-bar" role="progressbar" style="width: 80%;" aria-valuenow="80"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-grid w-100 mt-4 pt-2">
                        <button class="btn btn-primary" data-bs-target="#upgradePlanModal"
                                data-bs-toggle="modal">@lang('backend.buy-new-package')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
