@extends('master.backend')
@section('title',__('backend.site-users'))
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-6 ">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                        <h4 class="mb-sm-0">@lang('backend.add-new'): @lang('backend.site-users')</h4>
                                    </div>
                                </div>
                                <form action="{{ route('backend.site-users.update',$admin->id) }}" method="POST"
                                      class="needs-validation"
                                      novalidate="" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label>@lang('backend.name') <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" required=""
                                              value="{{ $admin->name }}">
                                        <div class="valid-feedback">
                                            @lang('backend.name') @lang('messages.is-correct')
                                        </div>
                                        <div class="invalid-feedback">
                                            @lang('backend.name') @lang('messages.not-correct')
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label>@lang('backend.email') <span class="text-danger">*</span></label>
                                        <input type="text" name="email" class="form-control" required=""
                                              value="{{ $admin->email }}">
                                        <div class="valid-feedback">
                                            @lang('backend.email') @lang('messages.is-correct')
                                        </div>
                                        <div class="invalid-feedback">
                                            @lang('backend.email') @lang('messages.not-correct')
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label>@lang('backend.ads-count') <span class="text-danger">*</span></label>
                                        <input type="text" name="current_ad_count" class="form-control" required=""
                                               value="{{ $admin->current_ad_count }}">
                                        <div class="valid-feedback">
                                            @lang('backend.ads-count') @lang('messages.is-correct')
                                        </div>
                                        <div class="invalid-feedback">
                                            @lang('backend.ads-count') @lang('messages.not-correct')
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label>@lang('backend.password') <span class="text-danger">*</span></label>
                                        <input type="password" name="password" class="form-control"
                                               placeholder="@lang('backend.password')">
                                    </div>
                                    <div class="mb-3">
                                        <label>@lang('backend.cnew-password') <span class="text-danger">*</span></label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                               placeholder="@lang('backend.cnew-password')">
                                    </div>
                                    <div class="mb-0 text-center">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                                @lang('backend.submit')
                                            </button>
                                            <a href="{{url()->previous()}}" type="button"
                                               class="btn btn-secondary waves-effect">
                                                @lang('backend.cancel')
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
