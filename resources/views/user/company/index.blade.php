@extends('master.user')
@section('user-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    @if(auth()->guard('admin')->user()->company()->exists())
                        <hr class="my-0">
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" id="upload_form">
                                @csrf
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img
                                        src="{{  asset($company->photo ?? 'user-assets/img/avatars/user-2.jpg') }}"
                                        alt="user-avatar"
                                        class="d-block rounded"
                                        height="100" width="100" id="uploadedAvatar"/>
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                            <span class="d-none d-sm-block">Upload new photo</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            <input type="file" id="upload" name="photo" class="account-file-input"
                                                   hidden/>
                                        </label>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <form id="formAccountSettings" enctype="multipart/form-data"
                                  action="{{ route('user.storeCompany') }}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="firstName" class="form-label">@lang('backend.name')</label>
                                        <input class="form-control" type="text" name="name"
                                               value="{{ $company->name ?? '-' }}"
                                               autofocus/>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="address" class="form-label">@lang('backend.adress')</label>
                                        <input type="text" class="form-control" name="address"
                                               value="{{ $company->adress ?? '-' }}"/>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">@lang('backend.email')</label>
                                        <input class="form-control" type="text" name="email"
                                               value="{{ $company->email ?? '-' }}"/>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="phoneNumber">@lang('backend.phone')</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text">(+994)</span>
                                            <input type="number" id="phone" name="phone" class="form-control"
                                                   value="{{ $company->phone ?? '-' }}"/>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-xl-12">
                                        <label class="form-label" for="phoneNumber">@lang('backend.voen')</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" id="voen" name="voen" class="form-control"
                                                   value="{{ $company->voen ?? '-' }}"/>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <h6 class="form-label">@lang('menus.about')</h6>
                                        <div class="nav-align-top mb-4">
                                            <ul class="nav nav-tabs nav-fill" role="tablist">
                                                @foreach(active_langs() as $lang)
                                                    <li class="nav-item ">
                                                        <button type="button"
                                                                class="nav-link @if($loop->first) active @endif"
                                                                role="tab"
                                                                data-bs-toggle="tab"
                                                                data-bs-target="#navs-{{ $lang->code }}"
                                                                aria-controls="navs-justified-profile"
                                                                aria-selected="false"> {{ $lang->name }}
                                                        </button>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="tab-content">
                                                @foreach(active_langs() as $key2 => $lan)
                                                    <div class="tab-pane fade show @if($loop->first) active @endif "
                                                         id="navs-{{ $lan->code }}" role="tabpanel">
                                                        <div class="col-12">
                                                            <div class="card mb-4">
                                                                <textarea id="elm{{$key2+1}}" rows="7"
                                                                          name="about[{{ $lan->code }}]"
                                                                          class="form-control">{{ $company->translate($lan->code)->about ?? '-' }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">@lang('backend.save')</button>
                                    <button type="reset"
                                            class="btn btn-label-secondary">@lang('backend.cancel')</button>
                                </div>
                            </form>
                        </div>
                    @else
                        <hr class="my-0">
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" id="upload_form">
                                @csrf
                            </form>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" id="upload_form">
                                @csrf
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img
                                        src="{{  asset('user-assets/img/avatars/user-2.jpg') }}"
                                        alt="user-avatar"
                                        class="d-block rounded"
                                        height="100" width="100" id="uploadedAvatar"/>
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                            <span class="d-none d-sm-block">Upload new photo</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            <input type="file" id="upload" name="photo" class="account-file-input"
                                                   hidden
                                            />
                                        </label>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <form id="formAccountSettings" enctype="multipart/form-data"
                                  action="{{ route('user.storeCompany') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="firstName" class="form-label">@lang('backend.name')</label>
                                        <input class="form-control" type="text" name="name"
                                               placeholder="Premium Ajans MMC"
                                               autofocus/>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="address" class="form-label">@lang('backend.adress')</label>
                                        <input type="text" class="form-control" name="address"
                                               placeholder="Bakı, Azerbaijan"/>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">@lang('backend.email')</label>
                                        <input class="form-control" type="text" name="email"
                                               placeholder="example@site.com"/>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="phoneNumber">@lang('backend.phone')</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text">(+994)</span>
                                            <input type="number" id="phone" name="phone" class="form-control"
                                                   placeholder="50 000 05 10"/>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-xl-12">
                                        <label class="form-label" for="phoneNumber">@lang('backend.voen')</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" id="voen" name="voen" class="form-control"
                                                   placeholder="@lang('backend.voen')"/>
                                        </div>
                                    </div>


                                    <div class="col-xl-12">
                                        <h6 class="form-label">@lang('menus.about')</h6>
                                        <div class="nav-align-top mb-4">
                                            <ul class="nav nav-tabs nav-fill" role="tablist">
                                                @foreach(active_langs() as $lang)
                                                    <li class="nav-item ">
                                                        <button type="button"
                                                                class="nav-link @if($loop->first) active @endif"
                                                                role="tab"
                                                                data-bs-toggle="tab"
                                                                data-bs-target="#navs-{{ $lang->code }}"
                                                                aria-controls="navs-justified-profile"
                                                                aria-selected="false"> {{ $lang->name }}
                                                        </button>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="tab-content">
                                                @foreach(active_langs() as $key3 => $lan)
                                                    <div class="tab-pane fade show @if($loop->first) active @endif "
                                                         id="navs-{{ $lan->code }}" role="tabpanel">
                                                        <div class="col-12">
                                                            <div class="card mb-4">
                                                                <textarea id="elm{{$key3+1}}" rows="7"
                                                                          name="about[{{ $lan->code }}]"
                                                                          class="form-control"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">@lang('backend.save')</button>
                                    <button type="reset"
                                            class="btn btn-label-secondary">@lang('backend.cancel')</button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
            $("#upload").change(function () {
                $('#upload_form').submit();
            });
            $('#upload_form').on('submit', function (event) {
                event.preventDefault();
                $.ajax({
                    url: "{{ route('user.updatePhoto') }}",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'text',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#uploadedAvatar").attr("src", data);
                        $("#navPhoto").attr("src", data);
                    }
                })
            });

        });
    </script>
    <script src="{{asset('user-assets/js/forms-extras.js')}}"></script>
    <script src="{{asset('user-assets/vendor/libs/autosize/autosize.js')}}"></script>
    <script src="{{asset('backend/libs/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('backend/js/pages/form-editor.init.js')}}"></script>
@endsection
