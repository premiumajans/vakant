@extends('master.user')
@section('user-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mx-0 gy-3 px-lg-5">
            <h5>@lang('backend.current-package')</h5>
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
                        <span>{{ $package->ads_count - $package->pivot->current_ads_count .'/'. $package->ads_count }}</span>
                        <span>{{ 100 - (($package->pivot->current_ads_count / $package->ads_count ) * 100) }}% @lang('backend.used')</span>
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
        <div class="row mx-0 gy-3 px-lg-5">
            <h5>@lang('backend.old-packages')</h5>
            @foreach($myOldPackages as $myPackage)
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-start">
                                <div class="d-flex align-items-start">
                                    <div class="me-2">
                                        <h5 class="mb-1"><a href="javascript:;" class="h5 stretched-link">{{ $myPackage->translate(app()->getLocale())->title ?? '-' }}</a></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center flex-wrap">
                                <div class="bg-lighter p-2 rounded me-auto mb-3">
                                    <h6 class="mb-1">$2.4k <span class="text-body fw-normal">/ 1.8k</span></h6>
{{--                                    <span>Total Budget</span>--}}
                                </div>
                                <div class="text-end mb-3">
                                    <h6 class="mb-1">@lang('backend.date-of-purchase'): <span class="text-body fw-normal">{{ $myPackage->created_at->format('d.m.y') }}</span></h6>
{{--                                    <h6 class="mb-1">Deadline: <span class="text-body fw-normal">21/6/22</span></h6>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
