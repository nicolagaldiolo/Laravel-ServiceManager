@section('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@show

@if(session('status'))
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-full-width",
            "preventDuplicates": false,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        toastr.{{ session('type', 'success') }}("{{session('status')}}");
        // toastr.success()
        // toastr.info()
        // toastr.warning()
        // toastr.error()

    </script>
@endif