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
                                        <h4 class="mb-sm-0">@lang('backend.site-users'):
                                            #{{ \App\Models\Admin::find($id)->name ?? '-' }}
                                            - @lang('frontend.company')</h4>
                                    </div>
                                </div>
                                @if(empty($company))
                                    <form
                                        action="{{ route('backend.userCompanyCreate',$id) }}"
                                        method="POST"
                                        class="needs-validation"
                                        novalidate="" enctype="multipart/form-data">
                                        @csrf
                                        <input hidden name="admin_id" value="{{ $id }}">
                                        <div class="mb-3">
                                            <label>@lang('backend.name') <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control" required=""
                                                   placeholder="Premium Ajans MMC">
                                           {!! validation_m('backend.name') !!}
                                        </div>
                                        <div class="mb-3">
                                            <label>@lang('backend.email') <span class="text-danger">*</span></label>
                                            <input type="text" name="email" class="form-control" required=""
                                                   placeholder="taleh@vakant.az">
                                            {!! validation_m('backend.email') !!}
                                        </div>
                                        <div class="mb-3">
                                            <label>@lang('backend.phone') <span class="text-danger">*</span></label>
                                            <input type="number" name="phone" class="form-control" required=""
                                                   placeholder="50 000 0510">
                                            {!! validation_m('backend.phone') !!}
                                        </div>
                                        <div class="mb-3">
                                            <label>@lang('backend.adress') <span class="text-danger">*</span></label>
                                            <input type="text" name="address" class="form-control" required=""
                                                   placeholder="Bakı, Azərbaycan">
                                            {!! validation_m('backend.address') !!}
                                        </div>
                                        <div class="mb-3">
                                            <label>@lang('backend.photo')</label>
                                            <input type="file" name="photo" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label>@lang('menus.about')
                                                <span
                                                    class="text-danger">*</span></label>
                                            <textarea id="elmaz1" required=""
                                                      name="about"></textarea>
                                        </div>
                                        <div class="mb-0 text-center">
                                            <div>
                                                <button type="submit"
                                                        class="btn btn-primary waves-effect waves-light me-1">
                                                    @lang('backend.submit')
                                                </button>
                                                <a href="{{url()->previous()}}" type="button"
                                                   class="btn btn-secondary waves-effect">
                                                    @lang('backend.cancel')
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    <form action="{{ route('backend.userCompanyCreate',$id) }}" method="POST"
                                          class="needs-validation"
                                          novalidate="" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label>@lang('backend.name') <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control" required=""
                                                   value="{{ $company->name ?? '-' }}">
                                            {!! validation_m('backend.name') !!}
                                        </div>
                                        <div class="mb-3">
                                            <label>@lang('backend.email') <span class="text-danger">*</span></label>
                                            <input type="text" name="email" class="form-control" required=""
                                                   value="{{ $company->email ?? '-' }}">
                                            {!! validation_m('backend.email') !!}
                                        </div>

                                        <div class="mb-3">
                                            <label>@lang('backend.phone') <span class="text-danger">*</span></label>
                                            <input type="text" name="phone" class="form-control" required=""
                                                   value="{{ $company->phone ?? '-' }}">
                                            {!! validation_m('backend.phone') !!}
                                        </div>
                                        <div class="mb-3">
                                            <label>@lang('backend.adress') <span class="text-danger">*</span></label>
                                            <input type="text" name="address" class="form-control" required=""
                                                   value="{{ $company->adress ?? '-' }}">
                                            {!! validation_m('backend.address') !!}
                                        </div>
                                        <div class="mb-3">
                                            <label>@lang('backend.photo')</label>
                                            <input type="file" name="photo" class="form-control mb-2">
                                            <img class="form-control" src="{{ asset($company->photo) }}"
                                                 style="width: 100%;max-height: 500px;">
                                        </div>
                                        <div class="mb-3">
                                            <label>@lang('menus.about')
                                                <span
                                                    class="text-danger">*</span></label>
                                            <textarea id="elmaz1" required=""
                                                      name="about">{!! $company->about !!}</textarea>
                                        </div>
                                        <div class="mb-0 text-center">
                                            <div>
                                                <button type="submit"
                                                        class="btn btn-primary waves-effect waves-light me-1">
                                                    @lang('backend.submit')
                                                </button>
                                                <a href="{{url()->previous()}}" type="button"
                                                   class="btn btn-secondary waves-effect">
                                                    @lang('backend.cancel')
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('backend/libs/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('backend/js/pages/form-editor.init.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
@endsection
