<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo ">
        <a href="{{ route('backend.login') }}" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Vakant.az</span>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">


        <li class="menu-item @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'user.index') active @endif">
            <a href="{{ route('user.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div>@lang('frontend.my-profile')</div>
            </a>
        </li>

        <li class="menu-item @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'user.item.create') active @endif">
            <a href="{{ route('user.item.create') }}" class="menu-link">
                <i class="menu-icon tf-icons fas fa-bullhorn"></i>
                <div>@lang('backend.post-an-ad')</div>
            </a>
        </li>

        <li class="menu-item @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'user.index.index') active @endif">
            <a href="{{ route('user.item.index') }}" class="menu-link">
                <i class="menu-icon tf-icons fas fa-scroll"></i>
                <div>@lang('backend.my-ads')</div>
            </a>
        </li>


        <li class="menu-item @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'user.packageForm' or \Illuminate\Support\Facades\Route::currentRouteName() == 'user.sendPackageForm' or \Illuminate\Support\Facades\Route::currentRouteName() == 'user.packageForm') active @endif">
            <a href="{{ route('user.packageForm') }}" class="menu-link">
                <i class="menu-icon fas fa-box"></i>
                <div>@lang('frontend.packages')</div>
            </a>
        </li>
        <li class="menu-item @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'user.companyForm') active @endif">
            <a href="{{ route('user.companyForm') }}" class="menu-link">
                <i class="menu-icon fas fa-building"></i>
                <div>@lang('backend.my-company')</div>
            </a>
        </li>
        @if(\Illuminate\Support\Facades\Auth::guard('admin')->user()->provider_id == null)
            <li class="menu-item @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'user.security') active @endif">
                <a href="{{ route('user.security') }}" class="menu-link">
                    <i class="menu-icon fas fa-shield-alt"></i>
                    <div>@lang('backend.security')</div>
                </a>
            </li>
        @endif

    </ul>
</aside>
