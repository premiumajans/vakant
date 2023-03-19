@extends('master.backend')
@section('title',__('backend.slider'))
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">@lang('backend.slider'): @lang('backend.add-new')</h4>
                                </div>
                            </div>
                            <form action="{{ route('backend.slider.store') }}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                                @csrf
                                <ul class="nav nav-pills nav-justified mb-2" role="tablist">
                                    @foreach(active_langs() as $lan)
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link @if($loop->first) active @endif" data-bs-toggle="tab" href="#{{ $lan->code }}" role="tab" aria-selected="true">
                                                <span class="d-block d-sm-none"><i class="fas fa-flag">&nbsp; {{ $lan->code }}</i></span>
                                                <span class="d-none d-sm-block">{{ $lan->name }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content p-3 text-muted">
                                    @foreach(active_langs() as $key => $lan)
                                        <div class="tab-pane @if($loop->first) active show @endif" id="{{ $lan->code }}" role="tabpanel">
                                            <div class="form-group row">
                                                <div class="mb-3">
                                                    <label>@lang('backend.title') </label>
                                                    <input type="text" name="title[{{ $lan->code }}]" class="form-control" id="validationCustom" data-parsley-minlength="6" placeholder="@lang('backend.title')">
                                                </div>
                                                <div class="mb-3">
                                                    <label>@lang('backend.description') </label>
                                                    <input type="text" name="description[{{ $lan->code }}]" class="form-control" id="validationCustom" data-parsley-minlength="6" placeholder="@lang('backend.description')">
                                                </div>
                                                <div class="mb-3">
                                                    <label>@lang('backend.alt') </label>
                                                    <input type="text" name="alt[{{ $lan->code }}]" class="form-control" id="validationCustom" data-parsley-minlength="6" placeholder="@lang('backend.alt')">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mb-3">
                                    <label>@lang('backend.photo') <span class="text-danger">*</span></label>
                                    <input type="file" name="photo" class="form-control" required="" id="validationCustom">
                                    <div class="valid-feedback">
                                        @lang('backend.photo') @lang('messages.is-correct')
                                    </div>
                                    <div class="invalid-feedback">
                                        @lang('backend.photo') @lang('messages.not-correct')
                                    </div>
                                </div>
                                <div class="mb-0 text-center">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                            @lang('backend.submit')
                                        </button>
                                        <a href="{{url()->previous()}}" type="button" class="btn btn-secondary waves-effect">
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
