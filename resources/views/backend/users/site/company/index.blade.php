@extends('master.backend')
@section('title',__('backend.site-users'))
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-8 ">
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
                                            {!! validationResponse('backend.name') !!}
                                        </div>
                                        <div class="mb-3">
                                            <label>@lang('backend.email') <span class="text-danger">*</span></label>
                                            <input type="text" name="email" class="form-control" required=""
                                                   placeholder="taleh@vakant.az">
                                            {!! validationResponse('backend.email') !!}
                                        </div>
                                        <div class="mb-3">
                                            <label>@lang('backend.phone') <span class="text-danger">*</span></label>
                                            <input type="number" name="phone" class="form-control" required=""
                                                   placeholder="50 000 0510">
                                            {!! validationResponse('backend.phone') !!}
                                        </div>
                                        <div class="mb-3">
                                            <label>@lang('backend.adress') <span class="text-danger">*</span></label>
                                            <input type="text" name="address" class="form-control" required=""
                                                   placeholder="Bakı, Azərbaycan">
                                            {!! validationResponse('backend.address') !!}
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
                                            {!! validationResponse('backend.name') !!}
                                        </div>
                                        <div class="mb-3">
                                            <label>@lang('backend.email') <span class="text-danger">*</span></label>
                                            <input type="text" name="email" class="form-control" required=""
                                                   value="{{ $company->email ?? '-' }}">
                                            {!! validationResponse('backend.email') !!}
                                        </div>

                                        <div class="mb-3">
                                            <label>@lang('backend.phone') <span class="text-danger">*</span></label>
                                            <input type="text" name="phone" class="form-control" required=""
                                                   value="{{ $company->phone ?? '-' }}">
                                            {!! validationResponse('backend.phone') !!}
                                        </div>
                                        <div class="mb-3">
                                            <label>@lang('backend.adress') <span class="text-danger">*</span></label>
                                            <input type="text" name="address" class="form-control" required=""
                                                   value="{{ $company->adress ?? '-' }}">
                                            {!! validationResponse('backend.address') !!}
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
                    @if(!empty($company))
                        <div class="col-xl-4 ">
                            <div class="card">
                                <div class="card-body">
                                    @if($company->premium()->exists())
                                        <div class="col-12">
                                            <div
                                                class="page-title-box d-sm-flex align-items-center justify-content-between">

                                                <span class="text-warning">@lang('backend.premium')&nbsp;<i
                                                        class="fas fa-crown"></i></span>
                                                <h4 class="mb-sm-0">@lang('backend.currently-status')
                                                    :
                                                    <span
                                                        class="text-primary">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$company->premium->end_time )->format('d-m-Y')}}</span>
                                                </h4>
                                            </div>
                                        </div>
                                    @endif
                                    @if($company->premium()->exists())
                                        <div class="d-flex justify-content-between">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#exampleModal" data-whatever="@mdo">
                                                <i class="fas fa-clock"></i>&nbsp;@lang('backend.get-time')</button>
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="exampleModalLabel">@lang('backend.get-time')</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('backend.userCompanyPremiumTime',$company->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label for="recipient-name"
                                                                           class="col-form-label">@lang('backend.time')
                                                                        :</label>
                                                                    <input type="text" name="time" value="30"
                                                                           class="form-control"
                                                                           id="recipient-name">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">
                                                                        @lang('backend.cancel')
                                                                    </button>
                                                                    <button type="submit" class="btn btn-primary">
                                                                        @lang('backend.save')
                                                                    </button>
                                                                </div>
                                                            </form>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <a class="btn btn-danger text-white w-45"
                                               href="{{ route('backend.userCompanyPremiumCancel',$company->id) }}"><i
                                                    class="fas fa-clock"></i>&nbsp;@lang('backend.cancel')</a>
                                        </div>
                                    @else
                                        <a class="btn btn-warning text-white w-100"
                                           href="{{ route('backend.userCompanyPremium',$company->id) }}"><i
                                                class="fas fa-crown"></i>&nbsp;@lang('backend.get-premium')</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
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
