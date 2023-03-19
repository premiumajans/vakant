@extends('master.user')
@section('user-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mx-0 gy-3 px-lg-5">
            <div class="col-xl-12 mb-4">
                <div class="card">
                    <h5 class="card-header">@lang('backend.choose-payment-method')</h5>
                    <div class="card-body">
                        <form method="POST" class="" id="dropzone-basic"
                              action="{{ route('user.sendAppeal') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md mb-md-0 mb-2">
                                    <div class="form-check custom-option custom-option-basic">
                                        <label class="form-check-label custom-option-content" for="customRadioTemp1">
                                            <input name="account" class="form-check-input" type="radio"
                                                   value="bankAccount"
                                                   checked/>
                                            <span class="custom-option-header">
                                            <span class="h6 mb-0">@lang('backend.pay-to-card')</span>
                                        </span>
                                            <span class="custom-option-body">
                                            <small>@lang('placeholders.take-photo-payment')</small>
                                        </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-check custom-option custom-option-basic">
                                        <label class="form-check-label custom-option-content" for="customRadioTemp2">
                                            <input name="account" class="form-check-input" type="radio"
                                                   value="electronAccount"/>
                                            <span class="custom-option-header">
                                            <span class="h6 mb-0">@lang('backend.e-qaime')</span>
                                        </span>
                                            <span class="custom-option-body">
                                            <small
                                                style="color: transparent">.</small>
                                        </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <input name="admin_id" value="{{ $id }}" hidden="">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-8 mt-5 mt-md-0" id="bankAccount">
                                    <div class="added-cards mt-5">
                                        <div class="cardMaster bg-lighter rounded-2 p-3 mb-3">
                                            <div class="d-flex justify-content-between flex-sm-row flex-column">
                                                <div class="card-information me-2">
                                                    <img class="mb-3 img-fluid"
                                                         src="{{asset('user-assets/img/icons/payments/mastercard.png')}}"
                                                         alt="Master Card">

                                                    <div class="d-flex align-items-center mb-1 flex-wrap gap-2">
                                                        <h6 class="mb-0 me-2">{{ settings('card_name') }}</h6>
                                                    </div>
                                                    <h3 onclick="copy()" id="card_number"
                                                        class="card-number"> {{  substr(chunk_split(settings('card_number'), 4, '-'), 0,-1)  }}</h3>
                                                </div>

                                            </div>
                                        </div>
                                        <input type="file" name="photo"
                                               class="form-control mt-5">
                                    </div>

                                </div>
                                <div class="col-md-8 mt-5 mt-md-0" id="electronAccount">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4">@lang('backend.send')</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function chunk(str) {
            var ret = [];
            var i;
            var len;
            for (i = 0, len = str.length; i < len; i += n) {
                ret.push(str.substr(i, 4))
            }
            return ret
        }
        $(document).ready(function () {
            $('#electronAccount').hide();
            $("input:radio[name=account]").click(function () {
                if ($('input:radio[name=account]:checked').val() == "bankAccount") {
                    $('#bankAccount').show();
                    $('#electronAccount').hide();
                }
                if ($('input:radio[name=account]:checked').val() == "electronAccount") {
                    $('#bankAccount').hide();
                    $('#electronAccount').show();
                }
            });
        });
    </script>
@endsection
