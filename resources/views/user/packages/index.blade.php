@extends('master.user')
@section('user-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mx-0 gy-3 px-lg-5">
            @foreach($packages as $package)
                <div class="col-lg">
                    <div class="card border rounded shadow-none">
                        <div class="card-body">
                            <h3 class="card-title text-center text-capitalize fw-semibold mb-1">{{ $package->translate(app()->getLocale())->title ?? '-' }}</h3>
                            <p class="text-center">{{ $package->translate(app()->getLocale())->description ?? '-' }}</p>

                            <div class="text-center">
                                <div class="d-flex justify-content-center">
                                    <sup class="h6 text-primary pricing-currency mt-3 mb-0 me-1">₼</sup>
                                    <h1 class="price-toggle price-yearly fw-semibold display-4 text-primary mb-0">{{ $package->monthly_payment ?? '-' }} </h1>
                                </div>
                                {{--                                <small--}}
                                {{--                                    class="price-yearly price-yearly-toggle text-muted"> {{ $package->ads_count ?? '-'}}--}}
                                {{--                                    x</small>--}}
                            </div>
                            <ul class="ps-3 my-4 list-unstyled">
                                @foreach($package->component()->get() as $component)
                                    <li class="mb-2"><span
                                            class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2"><i
                                                class="bx bx-check bx-xs"></i></span> {{ $component->translate(app()->getLocale())->title ?? '-' }}
                                    </li>
                                @endforeach
                            </ul>
                            <a href="{{ route('user.sendPackageForm',$package->id) }}"
                               class="btn btn-label-primary d-grid w-100">{{ __('backend.buy-package') }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
