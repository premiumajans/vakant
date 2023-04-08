<!DOCTYPE html>
<html lang="en" class="light-style">
<head>
    @include('user.includes.meta')
    @include('user.includes.styles')
    <script src="{{asset('user/vendor/js/helpers.js')}}"></script>
    <script src="{{asset('user/vendor/js/template-customizer.js')}}"></script>
    <script src="{{asset('user/js/config.js')}}"></script>
</head>
<body>
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
            <div class="card">
                <div class="card-body">
                    <div class="app-brand justify-content-center">
                        <a href="index-2.html" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo"></span>
                            <span class="app-brand-text demo text-body fw-bolder">vakant.az</span>
                        </a>
                    </div>
                    <h4 class="mb-4">@lang('auth.forgot-password') 🔒</h4>
                    <form id="formAuthentication"
                          class="mb-3"
                          action=""
                          method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">@lang('backend.email')</label>
                            <input type="text" class="form-control" id="email" name="email"
                                   placeholder="@lang('auth.enter-your-mail')" autofocus>
                        </div>
                        <button class="btn btn-primary d-grid w-100">@lang('backend.send')</button>
                    </form>
                    <div class="text-center">
                        <a href="{{ route('frontend.index') }}" class="d-flex align-items-center justify-content-center">
                            <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>@lang('backend.back-to-home')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('user.includes.scripts')
<script>
    "use strict";
    const formAuthentication = document.querySelector("#formAuthentication");
    document.addEventListener("DOMContentLoaded", function (e) {
        var t;
        formAuthentication && FormValidation.formValidation(formAuthentication, {
            fields: {
                username: {
                    validators: {
                        notEmpty: {message: "{{ __('messages.enter-name') }}"},
                        stringLength: {min: 6, message: "{{ __('messages.username-min') }}"}
                    }
                },
                email: {
                    validators: {
                        notEmpty: {message: "{{ __('messages.enter-email') }}"},
                        emailAddress: {message: "{{ __('messages.valid-email') }}"}
                    }
                },
                password: {
                    validators: {
                        notEmpty: {message: "{{ __('messages.enter-password') }}"},
                        stringLength: {min: 6, message: "{{ __('messages.password-min') }}"}
                    }
                },
                confirmPassword: {
                    validators: {
                        notEmpty: {message: "{{ __('messages.password-not-same') }}"},
                        identical: {
                            compare: function () {
                                return formAuthentication.querySelector('[name="password"]').value
                            }, message: "{{ __('messages.password-not-same') }}"
                        },
                        stringLength: {min: 6, message: "{{ __('messages.password-min') }}"}
                    }
                },
                terms: {validators: {notEmpty: {message: "{{ __('messages.term-policy') }}"}}}
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger,
                bootstrap5: new FormValidation.plugins.Bootstrap5({eleValidClass: "", rowSelector: ".mb-3"}),
                submitButton: new FormValidation.plugins.SubmitButton,
                defaultSubmit: new FormValidation.plugins.DefaultSubmit,
                autoFocus: new FormValidation.plugins.AutoFocus
            },
            init: e => {
                e.on("plugins.message.placed", function (e) {
                    e.element.parentElement.classList.contains("input-group") && e.element.parentElement.insertAdjacentElement("afterend", e.messageElement)
                })
            }
        }), (t = document.querySelectorAll(".numeral-mask")).length && t.forEach(e => {
            new Cleave(e, {numeral: !0})
        })
    });
</script>
</body>

</html>
