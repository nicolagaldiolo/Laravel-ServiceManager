<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.partials._head')

    <body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

        <div class="m-grid m-grid--hor m-grid--root m-page">
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--2 m-login-2--skin-2" id="m_login">
                <div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
                    <div class="m-login__container">
                        <div class="m-login__logo">
                            <img src="{{ asset('images/logo/logo_large.png')}}">
                        </div>

                        <!-- begin:: Page -->
                        @yield('content')
                        <!-- end:: Page -->

                        <div class="m-login__account">
                                    <span class="m-login__account-msg">
                                        Don't have an account yet ?
                                    </span>&nbsp;&nbsp;
                            <a href="{{ route('register') }}" id="m_login_signup" class="m-link m-link--light m-login__account-link">{{ __('Register') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.partials._scripts')
    </body>

</html>
