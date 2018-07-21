<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
            },
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--end::Web font -->

    <!--begin::Base Styles -->

    <!--begin::Page Vendors -->
    <link href="{{ asset('theme_assets/vendors/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css"/>

    <!--RTL version:<link href="{{ asset('theme_assets/vendors/custom/fullcalendar/fullcalendar.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />-->

    <!--end::Page Vendors -->
    <link href="{{ asset('theme_assets/vendors/base/vendors.bundle.css')}}" rel="stylesheet" type="text/css"/>

    <!--RTL version:<link href="{{ asset('theme_assets/vendors/base/vendors.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />-->
    <link href="{{ asset('theme_assets/demo/default/base/style.bundle.css')}}" rel="stylesheet" type="text/css"/>

    <!--RTL version:<link href="{{ asset('theme_assets/demo/default/base/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />-->
    <!--end::Base Styles -->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('theme_assets/demo/default/media/img/logo/favicon.ico')}}"/>
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('status'))
    <div class="alert alert-{{ session('type', 'info') }}">
        {{ session('status') }}
    </div>
@endif


<div class="m-grid m-grid--hor m-grid--root m-page">
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url(../../../assets/app/media/img//bg/bg-3.jpg);">
        <div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
            <div class="m-login__container">
                <div class="m-login__logo">
                    <a href="#">
                        <img src="{{ asset('theme_assets/app/media/img//logos/logo-2.png')}}">
                    </a>
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

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- begin::Quick Nav -->

    <!--begin::Base Scripts -->
    <script src="{{ asset('theme_assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
    <script src="{{ asset('theme_assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>

    <!--end::Base Scripts -->

    <!--begin::Page Vendors -->
    <script src="{{ asset('theme_assets/vendors/custom/fullcalendar/fullcalendar.bundle.js')}}" type="text/javascript"></script>

    <!--end::Page Vendors -->

    <!--begin::Page Snippets -->
    <script src="{{ asset('theme_assets/app/js/dashboard.js')}}" type="text/javascript"></script>
    {{--<script src="{{ asset('theme_assets/snippets/custom/pages/user/login.js')}}" type="text/javascript"></script>--}}
    <!--end::Page Snippets -->
</body>

<!-- end::Body -->
</html>
