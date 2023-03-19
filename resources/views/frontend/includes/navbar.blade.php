<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container-fluid px-md-4	">
        <a class="navbar-brand" href="{{ route('frontend.index') }}">Vakant.az</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span>
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{ route('frontend.index') }}"
                                               class="nav-link">@lang('backend.home-page')</a></li>
                <li class="nav-item"><a href="browsejobs.html" class="nav-link">Browse Jobs</a></li>
                <li class="nav-item"><a href="candidates.html" class="nav-link">Canditates</a></li>
                <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li>
                <li class="nav-item"><a href="contact.html" class="nav-link">@lang('menus.contact')</a></li>
                <li class="nav-item lang-down active">
                    <div class="dropdown show ">
                        <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Str::upper(app()->getLocale()) }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            @foreach($languages as $language)
                                <a class="dropdown-item"
                                   href="{{ route('frontend.frontLanguage',$language->code) }}">{{ $language->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </li>
                <li class="nav-item cta mr-md-1"><a href="{{ route('frontend.new-vacancy') }}"
                                                    class="nav-link">@lang('frontend.post-a-job')</a></li>
                @auth()
                    <li class="nav-item cta cta-colored"><a href="{{ route('user.index') }}"
                                                            class="nav-link">{{ auth()->guard('admin')->user()->name ?? '-' }}</a>
                @else
                    <li class="nav-item cta cta-colored"><a href="{{ route('user.loginForm') }}"
                                                            class="nav-link">@lang('backend.login')</a>
                        @endauth
                    </li>
            </ul>
        </div>
    </div>
</nav>

