<nav
    class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>
    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <div class="navbar-nav align-items-center">
            <div class="nav-item navbar-search-wrapper mb-0">
                <a class="nav-item nav-link search-toggler px-0" href="javascript:void(0);">
                </a>
            </div>
        </div>
        <ul class="navbar-nav flex-row align-items-center ms-auto">


            <li class="nav-item dropdown-language dropdown me-2 me-xl-0">

                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                   data-bs-toggle="dropdown">
                    <i class='fi fi-{{ app()->getLocale() }} fis rounded-circle fs-3 me-1'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    @foreach(active_langs() as $lang)
                        <li>
                            <a class="dropdown-item" href="{{ route('frontend.frontLanguage',$lang->code) }}"
                               data-language="en">
                                <i class="fi fi-{{ $lang->code }} fis rounded-circle fs-4 me-1"></i>
                                <span class="align-middle">{{ $lang->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>

            <li class="nav-item me-2 me-xl-0">
                <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
                    <i class='bx bx-sm'></i>
                </a>
            </li>

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                   data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img
                            src="{{asset( \App\Models\Company::where('admin_id',auth()->guard('admin')->user()->id)->first()->photo ?? 'user-assets/img/avatars/user-1.png')}}"
                            class="w-px-40 h-auto rounded-circle" id="navPhoto">
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('user.security') }}">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="{{asset('user-assets/img/avatars/user-1.png')}}" alt
                                             class="w-px-40 h-auto rounded-circle">
                                    </div>
                                </div>
                                <div class="flex-grow-1 d-flex align-items-center">
                                    <span
                                        class="fw-semibold d-block">{{ auth()->guard('admin')->user()->name ?? '-' }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <form method="post" action="{{ route('user.logout') }}">
                            @csrf
                            <button class="dropdown-item">
                                <i class="bx bx-power-off me-2" style="color: red"></i>
                                <span class="align-middle" style="color: red">@lang('backend.logout')</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
