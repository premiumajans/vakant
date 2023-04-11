@extends('master.user')
@section('user-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row g-4 mb-4">
            <h2 class="fw-bold py-3 mb-2">
                <span
                    class="text-muted fw-light">@lang('auth.welcome') /</span> {{ auth()->guard('admin')->user()->name ?? '-' }}
            </h2>
            <div class="col-sm-6 col-xl-4">
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
            <div class="col-sm-6 col-xl-4">
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
            <div class="col-sm-6 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span>@lang('frontend.packages')</span>
                                <div class="d-flex align-items-end mt-2">
                                    <h4 class="mb-0 me-2">{{ $counts['packages'] ?? '-' }}</h4>
                                </div>
                            </div>
                            <span class="badge bg-label-primary rounded p-2">
                                <i class="fas fa-box"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
