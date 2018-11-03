@section('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@show
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": false,
        "positionClass": "toast-top-full-width",
        "preventDuplicates": false,
        "showDuration": "300",
        "hideDuration": "300",
        "timeOut": "3000",
        //"extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
</script>

@if(session('status'))
    <script>
        toastr.{{ session('type', 'success') }}("{{session('status')}}");
        // toastr.success()
        // toastr.info()
        // toastr.warning()
        // toastr.error()

    </script>
@endif
