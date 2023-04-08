@extends('master.backend')
@section('title',__('backend.posts'))
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <form action="{{ route('backend.posts.update',$post->id) }}" class="needs-validation"
                                  novalidate method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="col-12">
                                        <div
                                            class="page-title-box d-sm-flex align-items-center justify-content-between">
                                            <h4 class="mb-sm-0">@lang('backend.post'): #{{$post->id}} <span
                                                    class="text-success">@lang('backend.approved'): {{ \App\Models\User::find($post->admin_id)->name }}</span>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <img width="100%" height="300px" src="{{ asset($post->photo) }}">
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

                                                               value="{{ $post->translate($lan->code)->title }}"
                                                               placeholder="@lang('backend.title')">
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
                                                        <textarea id="elm{{$key+1}}" required=""
                                                                  name="content1[{{$lan->code}}]">{!! $post->translate($lan->code)->content !!}</textarea>
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
                                                        <label>@lang('backend.meta') @lang('backend.keywords')</label>
                                                        <input name="meta_keywords[{{ $lan->code }}]" type="text"
                                                               class="form-control"
                                                               value="{{ $post->translate($lan->code)->keywords }}"
                                                               placeholder="@lang('backend.meta') @lang('backend.keywords')">
                                                        <div class="valid-feedback">
                                                            @lang('backend.meta') @lang('backend.keywords')
                                                            ({{$lan->code}}) @lang('messages.is-correct')
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            @lang('backend.meta') @lang('backend.keywords')
                                                            ({{$lan->code}}) @lang('messages.not-correct')
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>@lang('backend.meta') @lang('backend.description')</label>
                                                        <input name="meta_description[{{ $lan->code }}]" type="text"
                                                               class="form-control"
                                                               value="{{ $post->translate($lan->code)->description }}"
                                                               placeholder="@lang('backend.meta') @lang('backend.description')">
                                                        <div class="valid-feedback">
                                                            @lang('backend.meta') @lang('backend.description')
                                                            ({{$lan->code}}) @lang('messages.is-correct')
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            @lang('backend.meta') @lang('backend.description')
                                                            ({{$lan->code}}) @lang('messages.not-correct')
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="mb-3">
                                            <label>@lang('backend.photo') <span class="text-danger">*</span></label>
                                            <input name="photo" type="file" class="form-control"
                                                 >
                                            <div class="valid-feedback">
                                                @lang('backend.photo') @lang('messages.is-correct')
                                            </div>
                                            <div class="invalid-feedback">
                                                @lang('backend.photo') @lang('messages.not-correct')
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label>@lang('backend.status')</label>
                                            <br>
                                            <a href="{{ route('backend.postStatus',['id'=>$post->id]) }}"
                                               title="@lang('backend.status')" class="form-group">
                                                <input type="checkbox" id="switch"
                                                       switch="primary" {{ $post->status == 1 ? 'checked' : '' }} />
                                                <label for="switch4"></label>
                                            </a>
                                        </div>
                                        <div class="mb-3">
                                            <label>@lang('backend.categories') <span
                                                    class="text-danger">*</span></label>
                                            <div>
                                                <select class="form-control" name="category">
                                                    @foreach($categories as $cat)
                                                        <option
                                                            value="{{ $cat->id }}" {{($post->category_id == $cat->id ? 'selected' : '')}}>
                                                            @foreach(active_langs() as $langs)
                                                                @if($loop->first)
                                                                    {{$cat->translate($langs->code)->name}},
                                                                @elseif($loop->last)
                                                                    {{$cat->translate($langs->code)->name}}.
                                                                @else
                                                                 {{$cat->translate($langs->code)->name}},
                                                                @endif
                                                            @endforeach
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
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
