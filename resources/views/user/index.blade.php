@extends('master.user')
@section('user-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row g-4 mb-4">
            <h2 class="fw-bold py-3 mb-2">
                <span
                    class="text-muted fw-light">@lang('auth.welcome') /</span> {{ auth()->guard('admin')->user()->name ?? '-' }}!
            </h2>
            <div class="col-sm-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('user.item.create') }}">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="content-left">
                                    <span>@lang('backend.add-new-vacancy')</span>
                                    <div class="d-flex align-items-end mt-2">
                                        <h4 class="mb-0 me-2">&nbsp;</h4>
                                    </div>
                                </div>
                                <span class="badge bg-label-primary rounded p-2">
                                <i class="fas fa-plus"></i>
                            </span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span>@lang('backend.my-ads')</span>
                                <div class="d-flex align-items-end mt-2">
                                    <h4 class="mb-0 me-2">0</h4>
                                </div>
                            </div>
                            <span class="badge bg-label-primary rounded p-2">
                                <i class="fas fa-scroll"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mx-0 gy-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                        <span
                            class="badge bg-label-primary"> biznes</span>
                            <div class="d-flex justify-content-center">
                                <sup class="h5 pricing-currency mt-3 mb-0 me-1 text-primary">₼</sup>
                                <h1 class="display-5 mb-0 text-primary">10</h1>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-1 mt-3">
                            <span>1/2</span>
                            <span>50% @lang('backend.used')</span>
                        </div>
                        <div class="progress mb-1" style="height: 8px;">
                            <div class="progress-bar" role="progressbar" style="width: 80%;" aria-valuenow="80"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-grid w-100 mt-4 pt-2">
                            <button class="btn btn-primary" data-bs-target="#upgradePlanModal"
                                    data-bs-toggle="modal">@lang('backend.add-ads-count')</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
