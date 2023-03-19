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
        <div class="authentication-inner">
            <div class="card">
                <div class="card-body">
                    <div class="app-brand justify-content-center">
                        <a href="{{ route('frontend.index') }}" class="app-brand-link gap-2">
                            <span class="app-brand-text demo fw-bolder"
                                  style="color: #696cff">Vakant.az</span>
                        </a>
                    </div>
                    <form id="formAuthentication" class="mb-3"
                          action="{{ route('user.registerUser') }}"
                          method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">@lang('backend.name')</label>
                            <input type="text" class="form-control" id="username" name="username"
                                   placeholder="@lang('auth.enter-your-name')" autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">@lang('backend.email')</label>
                            <input type="text" class="form-control" id="email" name="email"
                                   placeholder="@lang('auth.enter-your-mail')" autofocus>
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">@lang('backend.password')</label>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password"
                                       placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                       aria-describedby="password"/>
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">@lang('auth.confirm-password')</label>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" id="confirmPassword" class="form-control"
                                       name="confirmPassword"
                                       placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                       aria-describedby="confirmPassword"/>
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms">
                                <label class="form-check-label" for="terms-conditions">
                                    <a data-bs-toggle="modal" data-bs-target="#editUser">@lang('auth.policy-terms')</a>
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100"
                                    type="submit">@lang('auth.create-an-account')</button>
                        </div>
                    </form>

                    <p class="text-center">
                        <a href="{{ route('user.loginForm') }}">
                            <span>@lang('backend.login')</span>
                        </a>
                    </p>
                    <div class="d-flex justify-content-center">
                        <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
                            <i class="tf-icons bx bxl-facebook"></i>
                        </a>

                        <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3">
                            <i class="tf-icons bx bxl-google"></i>
                        </a>

                        <a href="javascript:;" class="btn btn-icon btn-label-twitter">
                            <i class="tf-icons bx bxl-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
            @include('user.auth.policy-modal')
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
