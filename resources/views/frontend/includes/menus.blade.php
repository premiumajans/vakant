<section id="menu-area">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('frontend.index') }}"><img
                        src="{{asset('frontend/images/logo.png')}}"
                        alt="logo"></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul id="top-menu" class="nav navbar-nav navbar-right main-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">@lang('menus.about')<span
                                class="fa fa-angle-down"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            @if(\App\Models\Menu::where('name','history')->value('status') == 1)
                                <li><a href="{{ route('frontend.about.history') }}">@lang('backend.history')</a></li>
                            @endif
                            @if(\App\Models\Menu::where('name','vacancy')->value('status') == 1)
                                <li><a href="{{ route('frontend.about.vacancies') }}">@lang('backend.vacancies')</a>
                                </li>
                            @endif
                            <li><a href="{{ route('frontend.corporates') }}">@lang('backend.corporate')</a></li>
                            <li><a href="{{ route('frontend.news') }}">@lang('backend.news')</a></li>
                            <li><a href="{{ route('frontend.successes') }}">@lang('backend.our-success')</a></li>
                            @if(\App\Models\Menu::where('name','team')->value('status') == 1)
                                <li>
                                    <a href="{{ route('frontend.team') }}">@lang('backend.our-team')</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle"
                           data-toggle="dropdown">@lang('menus.products')<span
                                class="fa fa-angle-down"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            @foreach($menuCategories as $mc)
                                <li>
                                    <a href="{{ route('frontend.cProduct',$mc->slug) }}">{{ $mc->translate(app()->getLocale())->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="{{ route('frontend.services') }}">@lang('menus.services')</a></li>
                    <li><a href="{{ route('frontend.projects') }}">@lang('menus.Projects')</a></li>
                    <li><a href="{{ route('frontend.our-brands')  }}">@lang('menus.brands-represent')</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">@lang('menus.technical-support')<span
                                class="fa fa-angle-down"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('frontend.faq') }}">@lang('frontend.faq')</a></li>
                            <li><a href="{{ route('frontend.catalog') }}">@lang('backend.catalog')</a></li>
                            <li><a href="{{ route('frontend.certificates') }}">@lang('frontend.confirm-cert')</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('frontend.contact-us-page') }}">@lang('menus.contact')</a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->
            <a href="#" id="search-icon">
                <i class="fa fa-search"> </i>
            </a>
        </div>
    </nav>
</section>
