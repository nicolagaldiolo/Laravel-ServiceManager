<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.partials._head')

<!-- begin::Body -->
<body class="m-content--skin-light2 m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--desktop m-grid--ver-desktop m-grid--hor-tablet-and-mobile m-login m-login--6" id="m_login">
        <div class="m-grid__item   m-grid__item--order-tablet-and-mobile-2  m-grid m-grid--hor m-login__aside " style="background-image: url({{asset('images/misc/bg-4.jpg')}});">
            <div class="m-grid__item">
                <div class="m-login__logo">
                    <a href="#">
                        <img width="70" src="{{ asset('images/logo/logo_large_white.png')}}">
                    </a>
                </div>
            </div>
            @yield('title')
            <div class="m-grid__item">
                <div class="m-login__info">
                    <div class="m-login__section">
                        @include('layouts.partials._copy')
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center flex-column m-grid__item m-grid__item--fluid  m-grid__item--order-tablet-and-mobile-1  m-login__wrapper">
            @yield('content')
            <!--end::Body-->
        </div>
    </div>
</div>

<!-- end:: Page -->

@include('layouts.partials._scripts')

</body>

<!-- end::Body -->
</html>
