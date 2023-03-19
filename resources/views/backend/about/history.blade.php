@extends('master.backend')
@section('title',__('backend.history'))
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <form action="{{ route('backend.about.history.update',$history->id) }}"
                                  class="needs-validation" novalidate
                                  method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="col-12">
                                        <div
                                            class="page-title-box d-sm-flex align-items-center justify-content-between">
                                            <h4 class="mb-sm-0">@lang('backend.history'):</h4>
                                            <a href="{{ route('backend.menuStatus','history') }}"
                                               title="@lang('backend.status')">
                                                <input type="checkbox" id="switch"
                                                       switch="primary" {{ check_menu('history') }}/>
                                                <label for="switch4"></label>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <img width="100%" height="400px" style="border-radius: 5px;"
                                             src="{{ asset($history->photo) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label>@lang('backend.photo')</label>
                                        <input name="photo" type="file" class="form-control">
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
                                                               class="form-control" required=""
                                                               value="{{ $history->translate($lan->code)->title }}">
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
                                                        <label>@lang('backend.content') <span
                                                                class="text-danger">*</span></label>
                                                        <textarea id="elm{{$lan->code.$key+1}}" required=""
                                                                  name="content1[{{$lan->code}}]">{!! $history->translate($lan->code)->content1 !!}</textarea>
                                                        <div class="valid-feedback">
                                                            @lang('backend.content')({{$lan->code}}
                                                            ) @lang('messages.is-correct')
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            @lang('backend.content')({{$lan->code}}
                                                            ) @lang('messages.not-correct')
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>@lang('backend.content') <span
                                                                class="text-danger">*</span></label>
                                                        <textarea id="elm{{$lan->code.$key+2}}" required=""
                                                                  name="content2[{{$lan->code}}]">{!! $history->translate($lan->code)->content2 !!}</textarea>
                                                        <div class="valid-feedback">
                                                            @lang('backend.content')({{$lan->code}}
                                                            ) @lang('messages.is-correct')
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            @lang('backend.content')({{$lan->code}}
                                                            ) @lang('messages.not-correct')
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>@lang('backend.content') <span
                                                                class="text-danger">*</span></label>
                                                        <textarea id="elm{{$lan->code.$key+3}}" required=""
                                                                  name="content3[{{$lan->code}}]">{!! $history->translate($lan->code)->content3 !!}</textarea>
                                                        <div class="valid-feedback">
                                                            @lang('backend.content')({{$lan->code}}
                                                            ) @lang('messages.is-correct')
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            @lang('backend.content')({{$lan->code}}
                                                            ) @lang('messages.not-correct')
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
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
