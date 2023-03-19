@extends('master.user')
@section('user-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mx-0 gy-3 px-lg-5">
            <div class="card mb-4">
                <h5 class="card-header">@lang('backend.security')</h5>
                <div class="card-body ">
                    <form id="formAccountSettings"
                          action="{{ route('user.updateProfile',auth()->guard('admin')->user()->id) }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6 form-password-toggle">
                                <label class="form-label" for="currentPassword">@lang('backend.email')</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" type="text" disabled
                                           value="{{ auth()->guard('admin')->user()->email ?? '-' }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6 form-password-toggle">
                                <label class="form-label"
                                       for="currentPassword">@lang('backend.current-password')</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" type="password" name="currentPassword"
                                           id="currentPassword"
                                           placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"/>
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6 form-password-toggle">
                                <label class="form-label" for="newPassword">@lang('backend.new-password')</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" type="password" id="newPassword" name="newPassword"
                                           placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"/>
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6 form-password-toggle">
                                <label class="form-label"
                                       for="confirmPassword">@lang('backend.cnew-password')</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" type="password" name="confirmPassword"
                                           id="confirmPassword"
                                           placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"/>
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-1">
                            <button type="submit" class="btn btn-primary me-2">@lang('backend.save')</button>
                            <button type="reset"
                                    class="btn btn-label-secondary">@lang('backend.cancel')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
