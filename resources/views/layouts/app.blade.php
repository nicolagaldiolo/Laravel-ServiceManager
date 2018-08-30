<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('layouts.partials._head')

    <!-- begin::Body -->
    <body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

        <!-- begin:: Page -->
        <div class="m-grid m-grid--hor m-grid--root m-page">

            <!-- BEGIN: Header -->
            <header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
                <div class="m-container m-container--fluid m-container--full-height">
                    <div class="m-stack m-stack--ver m-stack--desktop">

                        <!-- BEGIN: Brand -->
                        <div class="m-stack__item m-brand  m-brand--skin-dark ">
                            <div class="m-stack m-stack--ver m-stack--general">
                                <div class="m-stack__item m-stack__item--middle m-brand__logo">
                                    <a href="{{ url('/') }}" class="m-brand__logo-wrapper">
                                        <img alt="{{ config('app.name') }}" src="{{ asset('theme_assets/app/media/img/logos/logo_default_dark.png')}}">
                                    </a>
                                </div>
                                <div class="m-stack__item m-stack__item--middle m-brand__tools">

                                    <!-- BEGIN: Left Aside Minimize Toggle -->
                                    <a href="javascript:;" id="m_aside_left_minimize_toggle"
                                       class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block  ">
                                        <span></span>
                                    </a>

                                    <!-- END -->

                                    <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                                    <a href="javascript:;" id="m_aside_left_offcanvas_toggle"
                                       class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                                        <span></span>
                                    </a>

                                    <!-- END -->

                                    <!-- BEGIN: Responsive Header Menu Toggler -->
                                    <a id="m_aside_header_menu_mobile_toggle" href="javascript:;"
                                       class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                                        <span></span>
                                    </a>

                                    <!-- END -->

                                    <!-- BEGIN: Topbar Toggler -->
                                    <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;"
                                       class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                        <i class="flaticon-more"></i>
                                    </a>

                                    <!-- BEGIN: Topbar Toggler -->
                                </div>
                            </div>
                        </div>

                        <!-- END: Brand -->
                        <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">

                            <!-- BEGIN: Horizontal Menu -->
                            <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark "
                                    id="m_aside_header_menu_mobile_close_btn">
                                <i class="la la-close"></i>
                            </button>
                            <div id="m_header_menu"
                                 class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark ">
                                <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
                                    <li class="m-menu__item m-menu__item--rel">
                                        <a href="{{route('customers.create')}}" class="m-menu__link">
                                            <i class="m-menu__link-icon flaticon-user-add"></i>
                                            <span class="m-menu__link-text">Customer</span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item m-menu__item--rel">
                                        <a href="{{route('domains.create')}}" class="m-menu__link">
                                            <i class="m-menu__link-icon flaticon-add"></i>
                                            <span class="m-menu__link-text">Domain</span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item m-menu__item--rel">
                                        <a href="{{route('providers.create')}}" class="m-menu__link">
                                            <i class="m-menu__link-icon flaticon-app"></i>
                                            <span class="m-menu__link-text">Provider</span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item m-menu__item--rel">
                                        <a href="{{route('users.create')}}" class="m-menu__link">
                                            <i class="m-menu__link-icon flaticon-user"></i>
                                            <span class="m-menu__link-text">User</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <!-- END: Horizontal Menu -->

                            <!-- BEGIN: Topbar -->
                            <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general m-stack--fluid">
                                <div class="m-stack__item m-topbar__nav-wrapper">
                                    <ul class="m-topbar__nav m-nav m-nav--inline">
                                        <li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width"
                                            m-dropdown-toggle="click" m-dropdown-persistent="1">
                                            <a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
                                                @if($domainsToPayCount > 0)
                                                    <span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span>
                                                @endif
                                                <span class="m-nav__link-icon">
                                                                <i class="flaticon-music-2"></i>
                                                            </span>
                                            </a>
                                            <div class="m-dropdown__wrapper">
                                                <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                                                <div class="m-dropdown__inner">
                                                    <div class="m-dropdown__header m--align-center"
                                                         style="background: url({{ asset('theme_assets/app/media/img/misc/notification_bg.jpg')}}); background-size: cover;">
                                                        <span class="m-dropdown__header-title">Servizi da incassare</span>
                                                        <span class="m-dropdown__header-subtitle">In attesa di pagamento</span>
                                                    </div>
                                                    <div class="m-dropdown__body">
                                                        <div class="m-dropdown__content">


                                                            @if($domainsToPay->isEmpty())
                                                                <div class="alert alert-brand" role="alert">
                                                                    <strong>Fantastico!</strong> Non ci sono altri servizi da
                                                                    gestire
                                                                </div>
                                                            @else

                                                                <div class="m-scrollable" data-scrollable="true"
                                                                     data-height="250" data-mobile-height="200">
                                                                    <div class="m-list-timeline m-list-timeline--skin-light">
                                                                        <div class="m-list-timeline__items">
                                                                            @foreach($domainsToPay as $domain)
                                                                                <div class="m-list-timeline__item">
                                                                                    <span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
                                                                                    <span class="m-list-timeline__text">{{$domain->url}}</span>
                                                                                    <span class="m-list-timeline__time">{{$domain->deadline->diffForHumans()}}</span>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="m-nav__item m-topbar__languages m-dropdown m-dropdown--small m-dropdown--arrow m-dropdown--align-right m-dropdown--mobile-full-width"
                                            m-dropdown-toggle="click" aria-expanded="true">
                                            <a href="#" class="m-nav__link m-dropdown__toggle">
                <span class="m-nav__link-text">
                    <img class="m-topbar__language-selected-img"
                         src="{{ asset('theme_assets/app/media/img/flags') .  "/" . App::getLocale() . ".svg" }}">
                </span>
                                            </a>
                                            <div class="m-dropdown__wrapper" style="z-index: 101;">
                                                <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"
                                                      style="left: auto; right: 5px;"></span>
                                                <div class="m-dropdown__inner">
                                                    <div class="m-dropdown__header m--align-center"
                                                         style="background: url('theme_assets/app/media/img/misc/flagsquick_actions_bg.jpg'); background-size: cover;">
                                                        <span class="m-dropdown__header-subtitle">{{ __('messages.selectLang') }}</span>
                                                    </div>
                                                    <div class="m-dropdown__body">
                                                        <div class="m-dropdown__content">
                                                            <ul class="m-nav m-nav--skin-light">
                                                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                                <!-- m-nav__item--active -->
                                                                    <li class="m-nav__item">
                                                                        <a hreflang="{{ $localeCode }}"
                                                                           class="m-nav__link @if(App::getLocale() == $localeCode) m-nav__link--active @endif"
                                                                           href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                                            <span class="m-nav__link-icon"><img
                                                                                        class="m-topbar__language-img"
                                                                                        src="{{ asset('theme_assets/app/media/img/flags') .  "/" . $localeCode . ".svg" }}"></span>
                                                                            <span class="m-nav__link-title m-topbar__language-text m-nav__link-text">{{ $properties['native'] }}</span>
                                                                        </a>
                                                                    </li>
                                                                @endforeach

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                                            m-dropdown-toggle="click">
                                            <a href="#" class="m-nav__link m-dropdown__toggle">
                                                        <span class="m-topbar__userpic">
                                                            <img src="{{Auth::user()->avatar}}"
                                                                 class="m--img-rounded m--marginless" alt=""/>
                                                        </span>
                                                <span class="m-topbar__username m--hide">Nick</span>
                                            </a>
                                            <div class="m-dropdown__wrapper">
                                                <span
                                                        class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                                <div class="m-dropdown__inner">
                                                    <div class="m-dropdown__header m--align-center"
                                                         style="background: url({{ asset('theme_assets/app/media/img/misc/user_profile_bg.jpg')}}); background-size: cover;">
                                                        <div class="m-card-user m-card-user--skin-dark">
                                                            <div class="m-card-user__pic">
                                                                <img src="{{Auth::user()->avatar}}"
                                                                     class="m--img-rounded m--marginless" alt=""/>
                                                            </div>
                                                            <div class="m-card-user__details">
                                                                <span
                                                                        class="m-card-user__name m--font-weight-500">{{ Auth::user()->name }}</span>
                                                                <a href=""
                                                                   class="m-card-user__email m--font-weight-300 m-link">{{ Auth::user()->email }}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="m-dropdown__body">
                                                        <div class="m-dropdown__content">
                                                            <ul class="m-nav m-nav--skin-light">
                                                                <li class="m-nav__section m--hide">
                                                                    <span class="m-nav__section-text">Section</span>
                                                                </li>
                                                                <li class="m-nav__item">
                                                                    <a href="{{route('users.edit', Auth::user())}}"
                                                                       class="m-nav__link">
                                                                        <i class="m-nav__link-icon flaticon-profile"></i>
                                                                        <span class="m-nav__link-title">
                                                                                    <span class="m-nav__link-wrap">
                                                                                        <span class="m-nav__link-text">Edit profile</span>
                                                                                    </span>
                                                                                </span>
                                                                    </a>
                                                                </li>

                                                                <li class="m-nav__item">
                                                                    <a href="{{route('change.password', Auth::user())}}"
                                                                       class="m-nav__link">
                                                                        <i class="m-nav__link-icon flaticon-lock-1"></i>
                                                                        <span class="m-nav__link-text">Change Password</span>
                                                                    </a>
                                                                </li>

                                                                <li class="m-nav__separator m-nav__separator--fit">
                                                                </li>


                                                                <li class="m-nav__item">
                                                                    <a target="_blank" href="https://github.com/nicolagaldiolo/Laravel-HostingManager/issues" class="m-nav__link">
                                                                        <i class="m-nav__link-icon flaticon-info"></i>
                                                                        <span class="m-nav__link-text">Issues reports</span>
                                                                    </a>
                                                                </li>
                                                                <li class="m-nav__item">
                                                                    <a href="mailto:galdiolo.nicola@gmail.com" class="m-nav__link">
                                                                        <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                                        <span class="m-nav__link-text">Support</span>
                                                                    </a>
                                                                </li>

                                                                <li class="m-nav__separator m-nav__separator--fit"></li>

                                                                <li class="m-nav__item">
                                                                    <a href="{{ route('logout') }}"
                                                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                                                       class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">{{ __('Logout') }}</a>
                                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                                        @csrf
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="m-nav__item">
                                            <a target="_blank" href="https://github.com/nicolagaldiolo/Laravel-HostingManager" class="m-nav__link m-dropdown__toggle">
                                                            <span class="m-nav__link-icon">
                                                                <i class="la la-github m--icon-font-size-lg5"></i>
                                                            </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- END: Topbar -->
                        </div>
                    </div>
                </div>
            </header>

            <!-- END: Header -->

            <!-- begin::Body -->
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
                @include('layouts.partials._sidebar')
                <div class="m-grid__item m-grid__item--fluid m-wrapper">
                    @yield('content')
                </div>
            </div>
            <!-- end:: Body -->

            <!-- begin::Footer -->
            <footer class="m-grid__item		m-footer ">
                <div class="m-container m-container--fluid m-container--full-height m-page__container">
                    <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
                        <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
                                        <span class="m-footer__copyright">
                                            {{\Carbon\Carbon::now()::now()->year}} &copy; {{ config('app.name') }} is licensed under the MIT License by <a class="m-link" target="_blank" href="https://github.com/nicolagaldiolo">Nicola Galdiolo</a>
                                        </span>
                        </div>
                        <div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
                            <ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
                                <li class="m-nav__item">
                                    <a target="_blank" href="https://github.com/nicolagaldiolo/Laravel-HostingManager/issues" class="m-nav__link">
                                        <span class="m-nav__link-text">Issues reports</span>
                                    </a>
                                </li>
                                <li class="m-nav__item">
                                    <a href="mailto:galdiolo.nicola@gmail.com" class="m-nav__link">
                                        <span class="m-nav__link-text">Support</span>
                                    </a>
                                </li>
                                <li class="m-nav__item m-nav__item">
                                    <a target="_blank" href="https://github.com/nicolagaldiolo" class="m-nav__link">
                                        <i class="m-nav__link-icon la la-github m--icon-font-size-lg3"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>

            <!-- end::Footer -->
        </div>

        <!-- end:: Page -->

        <!-- begin::Scroll Top -->
        <div id="m_scroll_top" class="m-scroll-top">
            <i class="la la-arrow-up"></i>
        </div>

        <!-- end::Scroll Top -->

        @include('layouts.partials._scripts')

    </body>

    <!-- end::Body -->
</html>
