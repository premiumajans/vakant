<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                @can('dashboard index')
                    <li>
                        <a href="{{ route('backend.dashboard') }}" class="waves-effect">
                            <i class="ri-home-4-fill"></i>
                            <span>@lang('backend.dashboard')</span>
                        </a>
                    </li>
                @endcan
                <li class="menu-title">@lang('backend.site-setting')</li>
                @can('users index')
                    <li>
                        <a href="{{ route('backend.site-users.index') }}" class="waves-effect">
                            <i class="fas fa-users"></i>
                            <span>@lang('backend.site-users')</span>
                        </a>
                    </li>
                @endcan
                @can('vacancy index')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fas fa-briefcase"></i>
                            <span>@lang('backend.vacancies')</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="{{ route('backend.vacancies.create') }}">
                                    @lang('backend.add-new')
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('backend.approvedVacancies') }}">
                                    @lang('backend.approved-vacancies')
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('backend.pendingVacancies') }}">
                                    @lang('backend.pending-vacancies')
                                    <span
                                        class="badge rounded-pill bg-success float-end">{{ $countPendingVacancies  }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('backend.updatedVacancies') }}">
                                    @lang('backend.updated-vacancies')
                                    <span
                                        class="badge rounded-pill bg-warning float-end">{{ $countUpdatedVacancies }}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan
                @canany(['categories index','alt-categories index','city index','salary index','education index','experience index','mode index'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fas fa-ellipsis-v"></i>
                            <span>@lang('backend.component')</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('categories index')
                                <li>
                                    <a href="{{ route('backend.categories.index') }}" class="waves-effect">
                                        <i class="fas fa-bars"></i>
                                        <span>@lang('backend.categories')</span>
                                    </a>
                                </li>
                            @endcan
                            @can('alt-categories index')
                                <li>
                                    <a href="{{ route('backend.alt-categories.index') }}" class="waves-effect">
                                        <i class="fas fa-chart-bar"></i>
                                        <span>@lang('backend.alt-categories')</span>
                                    </a>
                                </li>
                            @endcan
                            @can('city index')
                                <li>
                                    <a href="{{ route('backend.cities.index') }}" class="waves-effect">
                                        <i class="fas fa-globe"></i>
                                        <span>@lang('backend.cities')</span>
                                    </a>
                                </li>
                            @endcan
                            @can('salary index')
                                <li>
                                    <a href="{{ route('backend.salaries.index') }}" class="waves-effect">
                                        <i class="fas fa-dollar-sign"></i>
                                        <span>@lang('backend.salary')</span>
                                    </a>
                                </li>
                            @endcan
                            @can('education index')
                                <li>
                                    <a href="{{ route('backend.education.index') }}" class="waves-effect">
                                        <i class="fas fa-user-graduate"></i>
                                        <span>@lang('backend.education')</span>
                                    </a>
                                </li>
                            @endcan
                            @can('experience index')
                                <li>
                                    <a href="{{ route('backend.experience.index') }}" class="waves-effect">
                                        <i class="fas fa-briefcase"></i>
                                        <span>@lang('backend.experience')</span>
                                    </a>
                                </li>
                            @endcan
                            @can('mode index')
                                <li>
                                    <a href="{{ route('backend.modes.index') }}" class="waves-effect">
                                        <i class="fas fa-clock"></i>
                                        <span>@lang('backend.work-mode')</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                {{--                @can('packages index')--}}
                {{--                    <li>--}}
                {{--                        <a href="{{ route('backend.package-components.index') }}" class="waves-effect">--}}
                {{--                            <i class="fas fa-box-open"></i>--}}
                {{--                            <span>@lang('backend.component')</span>--}}
                {{--                        </a>--}}
                {{--                    </li>--}}
                {{--                @endcan--}}
                {{--                @can('packages index')--}}
                {{--                    <li>--}}
                {{--                        <a href="{{ route('backend.packages.index') }}" class="waves-effect">--}}
                {{--                            <i class="fas fa-box"></i>--}}
                {{--                            <span>@lang('frontend.packages')</span>--}}
                {{--                        </a>--}}
                {{--                    </li>--}}
                {{--                @endcan--}}
                {{--                @can('appeals index')--}}
                {{--                    <li>--}}
                {{--                        <a href="{{ route('backend.appeals.index') }}" class="waves-effect">--}}
                {{--                            <i class="fas fa-inbox"></i>--}}
                {{--                            <span>@lang('backend.appeals')</span>--}}
                {{--                        </a>--}}
                {{--                    </li>--}}
                {{--                @endcan--}}
                @can('term index')
                    <li>
                        <a href="{{ route('backend.term.index') }}" class="waves-effect">
                            <i class="fas fa-paste"></i>
                            <span>@lang('backend.terms-and-conditions')</span>
                        </a>
                    </li>
                @endcan
                {{--                @can('faq index')--}}
                {{--                    <li>--}}
                {{--                        <a href="{{ route('backend.faq.index') }}" class="waves-effect">--}}
                {{--                            <i class="fa fa-question-circle"></i>--}}
                {{--                            <span>@lang('frontend.faq')</span>--}}
                {{--                        </a>--}}
                {{--                    </li>--}}
                {{--                @endcan--}}
                @can('languages index')
                    <li>
                        <a href="{{ route('backend.site-languages.index') }}" class="waves-effect">
                            <i class="fas fa-language"></i>
                            <span>@lang('backend.languages')</span>
                        </a>
                    </li>
                @endcan
                @can('contact-us index')
                    <li>
                        <a href="{{ route('backend.contact-us.index') }}" class="waves-effect">
                            <i class="ri-contacts-fill"></i>
                            <span>@lang('backend.contact-us')</span>
                        </a>
                    </li>
                @endcan
                @can('settings index')
                    <li>
                        <a href="{{ route('backend.settings.index') }}" class="waves-effect">
                            <i class="ri-settings-2-fill"></i>
                            <span>@lang('backend.settings')</span>
                        </a>
                    </li>
                @endcan
                @canany(['users index','permissions index','new-permission index','report index'])
                    <li class="menu-title">@lang('backend.ap-setting')</li>
                @endcanany
                @can('users index')
                    <li>
                        <a href="{{ route('backend.users.index') }}" class=" waves-effect">
                            <i class="ri-account-circle-fill"></i>
                            <span>@lang('backend.users')</span>
                        </a>
                    </li>
                @endcan
                @can('permissions index')
                    <li>
                        <a href="{{ route('backend.permissions.index') }}" class=" waves-effect">
                            <i class="ri-lock-2-fill"></i>
                            <span>@lang('backend.permissions')</span>
                        </a>
                    </li>
                @endcan
                @can('permissions index')
                    <li>
                        <a href="{{ route('backend.givePermission') }}" class=" waves-effect">
                            <i class="ri-lock-unlock-fill"></i>
                            <span>@lang('backend.give-permission')</span>
                        </a>
                    </li>
                @endcan
                @can('languages index')
                    <li>
                        <a target="_blank" href="{{ url('manage-languages') }}" class=" waves-effect">
                            <i class="fas fa-flag"></i>
                            <span>@lang('backend.translation-panel')</span>
                        </a>
                    </li>
                @endcan
                @can('report index')
                    <li>
                        <a href="{{ route('backend.report') }}" class="waves-effect">
                            <i class="fas fa-file"></i>
                            <span>@lang('backend.report')</span>
                        </a>
                    </li>
                @endcan
                @can('information index')
                    <li class="menu-title">@lang('backend.user-setting')</li>
                    <li>
                        <a href="{{ route('backend.information.index') }}" class=" waves-effect">
                            <i class="ri-information-fill"></i>
                            <span>@lang('backend.informations')</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</div>
