<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">@lang('backend.add-new')
                    : @lang('backend.site-users')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('backend.site-users.store') }}" method="POST"
                      class="needs-validation"
                      novalidate="" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label>@lang('backend.name') <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required=""
                               placeholder="Taleh Maharramov">
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
                        <label>@lang('backend.password') <span class="text-danger">*</span></label>
                        <div class="input-group" id="datepicker1">
                            <input id="password" type="password" name="password" class="form-control"
                                   placeholder="@lang('backend.password')"
                                   required="">
                            <span id="copy_password" class="input-group-text"><i class="fas fa-copy"></i></span>
                            <span id="show_password" class="input-group-text"><i id="show_icon"
                                                                                 class="fas fa-eye"></i></span>
                            <span id="generate_password" class="input-group-text"><i
                                    class="fas fa-key"></i></span>
                            {!! validationResponse('backend.name') !!}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>@lang('backend.cnew-password') <span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control"
                               required=""
                               placeholder="@lang('backend.cnew-password')">
                        <div class="valid-feedback">
                            @lang('backend.cnew-password') @lang('messages.is-correct')
                        </div>
                        <div class="invalid-feedback">
                            @lang('backend.cnew-password') @lang('messages.not-correct')
                        </div>
                    </div>

                    <div class="mb-0 text-center">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                @lang('backend.submit')
                            </button>
                            <a href="{{url()->previous()}}" type="button"
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
@section('scripts')
    <script src="{{ asset('backend/js/auth.js') }}"></script>
@endsection

