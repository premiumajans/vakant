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
                                                  placeholder="taleh@vakant.az">
                                            <div class="valid-feedback">
                                                @lang('backend.email') @lang('messages.is-correct')
                                            </div>
                                            <div class="invalid-feedback">
                                                @lang('backend.email') @lang('messages.not-correct')
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label>@lang('backend.phone') <span class="text-danger">*</span></label>
                                            <input type="number" name="phone" class="form-control" required=""
                                                   placeholder="50 000 0510">
                                            <div class="valid-feedback">
                                                @lang('backend.phone') @lang('messages.is-correct')
                                            </div>
                                            <div class="invalid-feedback">
                                                @lang('backend.phone') @lang('messages.not-correct')
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label>@lang('backend.adress') <span class="text-danger">*</span></label>
                                            <input type="text" name="address" class="form-control" required=""
                                                  placeholder="Bakı, Azərbaycan">
                                            <div class="valid-feedback">
                                                @lang('backend.address') @lang('messages.is-correct')
                                            </div>
                                            <div class="invalid-feedback">
                                                @lang('backend.address') @lang('messages.not-correct')
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label>@lang('backend.voen') <span class="text-danger">*</span></label>
                                            <input type="text" name="voen" class="form-control" required=""
                                                  placeholder="@lang('backend.voen')">
                                            <div class="valid-feedback">
                                                @lang('backend.voen') @lang('messages.is-correct')
                                            </div>
                                            <div class="invalid-feedback">
                                                @lang('backend.voen') @lang('messages.not-correct')
                                            </div>
                                        </div>


                                        <div class="mb-3">
                                            <label>@lang('backend.photo')</label>
                                            <input type="file" name="photo" class="form-control">
                                        </div>


                                        <ul class="nav nav-pills nav-justified mb-2" role="tablist">
                                            @foreach(active_langs() as $lan)
                                                <li class="nav-item waves-effect waves-light">
                                                    <a class="nav-link @if($loop->first) active @endif"
                                                       data-bs-toggle="tab"
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
                                                            <label>@lang('menus.about')
                                                                <span
                                                                    class="text-danger">*</span></label>
                                                            <textarea id="elm{{$lan->code.$key+1}}" required=""
                                                                      name="about[{{$lan->code}}]"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
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
                                                  value="{{ $company->email ?? '-' }}">
                                            <div class="valid-feedback">
                                                @lang('backend.email') @lang('messages.is-correct')
                                            </div>
                                            <div class="invalid-feedback">
                                                @lang('backend.email') @lang('messages.not-correct')
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label>@lang('backend.phone') <span class="text-danger">*</span></label>
                                            <input type="text" name="phone" class="form-control" required=""
                                                  value="{{ $company->phone ?? '-' }}">
                                            <div class="valid-feedback">
                                                @lang('backend.phone') @lang('messages.is-correct')
                                            </div>
                                            <div class="invalid-feedback">
                                                @lang('backend.phone') @lang('messages.not-correct')
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label>@lang('backend.adress') <span class="text-danger">*</span></label>
                                            <input type="text" name="address" class="form-control" required=""
                                                  value="{{ $company->adress ?? '-' }}">
                                            <div class="valid-feedback">
                                                @lang('backend.address') @lang('messages.is-correct')
                                            </div>
                                            <div class="invalid-feedback">
                                                @lang('backend.address') @lang('messages.not-correct')
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label>@lang('backend.voen') <span class="text-danger">*</span></label>
                                            <input type="text" name="voen" class="form-control" required=""
                                                  value="{{ $company->voen ?? '-' }}">
                                            <div class="valid-feedback">
                                                @lang('backend.voen') @lang('messages.is-correct')
                                            </div>
                                            <div class="invalid-feedback">
                                                @lang('backend.voen') @lang('messages.not-correct')
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label>@lang('backend.photo')</label>
                                            <input type="file" name="photo" class="form-control">
                                        </div>


                                        <ul class="nav nav-pills nav-justified mb-2" role="tablist">
                                            @foreach(active_langs() as $lan)
                                                <li class="nav-item waves-effect waves-light">
                                                    <a class="nav-link @if($loop->first) active @endif"
                                                       data-bs-toggle="tab"
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
                                                            <label>@lang('menus.about')</label>
                                                            <textarea id="elm{{$lan->code.$key+1}}"
                                                                      name="about[{{$lan->code}}]">{!! $company->translate($lan->code)->about ?? '-' !!}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
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
