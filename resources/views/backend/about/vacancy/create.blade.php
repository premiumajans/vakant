@extends('master.backend')
@section('title',__('backend.vacancies'))
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <form action="{{ route('backend.about.vacancies.store') }}"
                                  class="needs-validation" novalidate
                                  method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="col-12">
                                        <div
                                            class="page-title-box d-sm-flex align-items-center justify-content-between">
                                            <h4 class="mb-sm-0">@lang('backend.vacancies'):</h4>
                                        </div>
                                    </div>
                                    <ul class="nav nav-pills nav-justified" role="tablist">
                                        @foreach(active_langs() as $lan)
                                            <li class="nav-item waves-effect waves-light">
                                                <a class="nav-link @if($loop->first) active @endif" data-bs-toggle="tab"
                                                   href="#{{ $lan->code }}" role="tab" aria-selected="true">
                                                    <span class="d-block d-sm-none"><i
                                                            class="fas fa-flag">&nbsp; {{ $lan->code }}</i></span>
                                                    <span class="d-none d-sm-block">{{ $lan->name }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content p-3 text-muted">
                                        @foreach(active_langs() as $key => $lan)
                                            <div class="tab-pane @if($loop->first) active show @endif"
                                                 id="{{ $lan->code }}" role="tabpanel">
                                                <div class="form-group row">
                                                    <div class="mb-3">
                                                        <label>@lang('backend.title') <span class="text-danger">*</span></label>
                                                        <input name="title[{{ $lan->code }}]" type="text"
                                                               class="form-control"
                                                               placeholder="Senior Backend Proqramçı" required="">
                                                        <div class="valid-feedback">
                                                            @lang('backend.title')({{$lan->code}}
                                                            ) @lang('messages.is-correct')
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            @lang('backend.title')({{$lan->code}}
                                                            ) @lang('messages.not-correct')
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>@lang('backend.education') <span
                                                                class="text-danger">*</span></label>
                                                        <input name="education[{{ $lan->code }}]" type="text"
                                                               class="form-control" placeholder="Ali" required="">
                                                        <div class="valid-feedback">
                                                            @lang('backend.education')({{$lan->code}}
                                                            ) @lang('messages.is-correct')
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            @lang('backend.education')({{$lan->code}}
                                                            ) @lang('messages.not-correct')
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>@lang('backend.experience') <span
                                                                class="text-danger">*</span></label>
                                                        <input name="experience[{{ $lan->code }}]" type="text"
                                                               class="form-control" placeholder="1 ildən 3 ilə qədər"
                                                               required="">
                                                        <div class="valid-feedback">
                                                            @lang('backend.experience')({{$lan->code}}
                                                            ) @lang('messages.is-correct')
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            @lang('backend.experience')({{$lan->code}}
                                                            ) @lang('messages.not-correct')
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="mb-3">
                                        <label>@lang('backend.age') <span
                                                class="text-danger">*</span></label>
                                        <input name="age" type="text"
                                               class="form-control" placeholder="18-35" required="">
                                        <div class="valid-feedback">
                                            @lang('backend.age') @lang('messages.is-correct')
                                        </div>
                                        <div class="invalid-feedback">
                                            @lang('backend.age') @lang('messages.not-correct')
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label>@lang('backend.email') <span
                                                class="text-danger">*</span></label>
                                        <input name="email" type="text"
                                               class="form-control" placeholder="reklam@premium.az" required="">
                                        <div class="valid-feedback">
                                            @lang('backend.email')@lang('messages.is-correct')
                                        </div>
                                        <div class="invalid-feedback">
                                            @lang('backend.email') @lang('messages.not-correct')
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label>@lang('backend.phone') <span
                                                class="text-danger">*</span></label>
                                        <input name="phone" type="text"
                                               class="form-control" placeholder="+994505100000" required="">
                                        <div class="valid-feedback">
                                            @lang('backend.phone')@lang('messages.is-correct')
                                        </div>
                                        <div class="invalid-feedback">
                                            @lang('backend.phone')@lang('messages.not-correct')
                                        </div>
                                    </div>


                                    <div class="mb-3">
                                        <label>@lang('backend.salary') <span
                                                class="text-danger">*</span></label>
                                        <input name="salary" type="text"
                                               class="form-control" placeholder="510" required="">
                                        <div class="valid-feedback">
                                            @lang('backend.salary') @lang('messages.is-correct')
                                        </div>
                                        <div class="invalid-feedback">
                                            @lang('backend.salary') @lang('messages.not-correct')
                                        </div>
                                    </div>


                                </div>
                                <div class="mb-5 text-center">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                            @lang('backend.submit')
                                        </button>
                                        <a href="{{ url()->previous() }}" type="button"
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
@endsection
@section('scripts')
    <script src="{{asset('backend/libs/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('backend/js/pages/form-editor.init.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
@endsection
