<meta charset="utf-8" />
<title>@lang('backend.login')</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@section('title',__('backend.login'))
@include('backend.includes.styles')
<body class="auth-body-bg">
<div class="bg-overlay"></div>
<div class="wrapper-page">
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-body">
                <h4 class="text-muted text-center font-size-18">
                    <img src="{{asset('backend/images/logo.png')}}" height="90">
                </h4>
                <div class="p-3">
                    <form class="form-horizontal mt-3 needs-validation" novalidate method="POST"
                          action="{{ route('backend.loginPost') }}">
                        @csrf
                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <input class="form-control" type="text" required="" name="email"
                                       placeholder="@lang('backend.email')">
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <input class="form-control" type="password" name="password"
                                       placeholder="@lang('backend.password')">
                            </div>
                        </div>

                        <div class="form-group mb-3 text-center row mt-3 pt-1">
                            <div class="col-12">
                                <button class="btn w-100 waves-effect waves-light login-button"
                                        type="submit">@lang('backend.login')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@include('backend.includes.scripts')
