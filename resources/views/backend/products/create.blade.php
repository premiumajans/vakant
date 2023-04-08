@extends('master.backend')
@section('title',__('menus.products'))
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-9">
                        <div class="card">
                            <form action="{{ route('backend.products.store') }}" class="needs-validation"
                                  novalidate
                                  method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="col-12">
                                        <div
                                            class="page-title-box d-sm-flex align-items-center justify-content-between">
                                            <h4 class="mb-sm-0">@lang('backend.new') @lang('menus.products')</h4>
                                        </div>
                                    </div>
                                    <ul class="nav nav-pills nav-justified" role="tablist">
                                        @foreach(active_langs() as $lan)
                                            <li class="nav-item waves-effect waves-light">
                                                <a class="nav-link @if($loop->first) active @endif" data-bs-toggle="tab"
                                                   href="#{{ $lan->code }}" role="tab" aria-selected="true">
                                                    <span class="d-block d-sm-none"><i>{{ $lan->code }}</i></span>
                                                    <span class="d-none d-sm-block">{{ $lan->name }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content p-3 text-muted">
                                        @foreach(active_langs() as $lan)
                                            <div class="tab-pane @if($loop->first) active show @endif"
                                                 id="{{ $lan->code }}" role="tabpanel">
                                                <div class="form-group row">
                                                    <div class="mb-3">
                                                        <label>@lang('backend.name') <span class="text-danger">*</span></label>
                                                        <input name="name[{{ $lan->code }}]" type="text"
                                                               class="form-control" required=""

                                                               placeholder="@lang('backend.name')">
                                                        <div class="valid-feedback">
                                                            @lang('backend.name') @lang('messages.is-correct')
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            @lang('backend.name') @lang('messages.not-correct')
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>@lang('backend.alt') <span
                                                                class="text-danger">*</span></label>
                                                        <input name="alt[{{ $lan->code }}]" type="text"
                                                               class="form-control" required=""

                                                               placeholder="@lang('backend.alt')">
                                                        <div class="valid-feedback">
                                                            @lang('backend.alt') @lang('messages.is-correct')
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            @lang('backend.alt') @lang('messages.not-correct')
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="mb-3">
                                            <label>@lang('backend.photo') <span class="text-danger">*</span></label>
                                            <input name="photo" type="file" required="" class="form-control">
                                            <div class="valid-feedback">
                                                @lang('backend.photo') @lang('messages.is-correct')
                                            </div>
                                            <div class="invalid-feedback">
                                                @lang('backend.photo') @lang('messages.not-correct')
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="category">@lang('backend.categories') <span
                                                    class="text-danger">*</span></label>
                                            <select name="category" id="category" class="form-control">
                                                @foreach($categories as $category)
                                                    <option
                                                        value="{{ $category->id }}">{{ $category->translate('az')->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="valid-feedback">
                                                @lang('backend.categories') @lang('messages.is-correct')
                                            </div>
                                            <div class="invalid-feedback">
                                                @lang('backend.categories') @lang('messages.not-correct')
                                            </div>
                                        </div>

                                        <div class="mb-3" id="altDiv">
                                            <label for="category">@lang('backend.alt-categories') <span
                                                    class="text-danger">*</span></label>
                                            <select name="altCategory" id="altCategory" class="form-control">
                                                @foreach($altCategories as $altc)
                                                    <option
                                                        value="{{ $altc->id }}">{{ $altc->translate('az')->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="valid-feedback">
                                                @lang('backend.alt-categories') @lang('messages.is-correct')
                                            </div>
                                            <div class="invalid-feedback">
                                                @lang('backend.alt-categories') @lang('messages.not-correct')
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
    <script>
        $(document).ready(function () {
            $('#category').on('change', function () {
                var catID = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    url: "{{ route('frontend.changeCategory') }}",
                    type: "POST",
                    data: {
                        category_id: catID,
                    },
                    success: function (data) {
                        $("#altCategory").remove();
                        $("#altDiv").append(data);
                    },
                });
            });
        });
    </script>

@endsection
