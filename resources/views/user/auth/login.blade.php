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
                        <a href="{{ route('backend.login') }}" class="app-brand-link gap-2">
                            <span class="app-brand-text demo fw-bolder" style="color: #696cff">Vakant.az</span>
                        </a>
                    </div>
                    <h4 class="mb-2">@lang('auth.login-to-account')</h4>
                    <p class="mb-4">@lang('auth.welcome')</p>
                    <form id="formAuthentication" class="mb-3"
                          action="{{ route('user.loginUser') }}"
                          method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">@lang('backend.email')</label>
                            <input type="text" class="form-control" id="email" name="email"
                                   placeholder="@lang('auth.enter-your-mail')" autofocus>
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">@lang('backend.password')</label>
                                <a href="{{ route('user.forgotPasswordForm') }}">
                                    <small>@lang('auth.forgot-password')</small>
                                </a>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password"
                                       placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                       aria-describedby="password"/>
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" name="remember_me" value="1" type="checkbox"
                                       id="remember-me">
                                <label class="form-check-label" for="remember-me">
                                    @lang('auth.remember-me')
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">@lang('backend.login')</button>
                        </div>
                    </form>
                    <p class="text-center">
                        <a href="{{ route('user.registerForm') }}">
                            <span>@lang('auth.create-an-account')</span>
                        </a>
                    </p>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('user.loginFacebook') }}" class="btn btn-icon btn-label-facebook me-3">
                            <i class="tf-icons bx bxl-facebook"></i>
                        </a>
                        <a href="{{ route('user.loginGoogle') }}" class="btn btn-icon btn-label-google-plus me-3">
                            <i class="tf-icons bx bxl-google"></i>
                        </a>
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
