<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" href="{{ asset('theme_assets/demo/default/media/img/logo/favicon.ico')}}"/>

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

    <link href="{{ asset('theme_assets/vendors/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('theme_assets/vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('theme_assets/vendors/base/vendors.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('theme_assets/demo/default/base/style.bundle.css')}}" rel="stylesheet" type="text/css"/>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css"/>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


</head>
<!-- end::Head -->