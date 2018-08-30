@section('scripts')
    <!--begin::Base Scripts -->
    <script src="{{ asset('theme_assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
    <script src="{{ asset('theme_assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>

    <!--end::Base Scripts -->

    <!--begin::Page Vendors -->
    <script src="{{ asset('theme_assets/vendors/custom/fullcalendar/fullcalendar.bundle.js')}}" type="text/javascript"></script>
    <script src="{{ asset('theme_assets/vendors/custom/datatables/datatables.bundle.js')}}"
            type="text/javascript"></script>
    <!--end::Page Vendors -->

    <!--begin::Page Snippets -->
    <!--<script src="{{ asset('theme_assets/app/js/dashboard.js')}}" type="text/javascript"></script>-->

    <!--end::Page Snippets -->
    <script src="{{ asset('theme_assets/demo/default/custom/crud/forms/validation/form-controls.js')}}"
            type="text/javascript"></script>
    <script src="{{ asset('theme_assets/demo/default/custom/crud/forms/widgets/select2.js')}}"
            type="text/javascript"></script>
    <script src="{{ asset('theme_assets/demo/default/custom/crud/forms/widgets/bootstrap-datepicker.js')}}"
            type="text/javascript"></script>
    <!--<script src="{{ asset('theme_assets/demo/default/custom/crud/forms/widgets/bootstrap-datetimepicker.js')}}" type="text/javascript"></script>-->

    <script src="{{ asset('theme_assets/demo/default/custom/crud/forms/widgets/input-mask.js')}}"
            type="text/javascript"></script>

    <!--begin::Page Resources -->
    <script src="{{ asset('theme_assets/demo/default/custom/components/base/toastr.js')}}"></script>
    <!--end::Page Resources -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>

    {{--<script src="{{ asset('theme_assets/demo/default/custom/crud/forms/widgets/dropzone.js')}}" type="text/javascript"></script>--}}

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

@show

@if(session('status'))
    @feedback(['type' => session('type', 'success')])
    {{session('status')}}
    @endfeedback
@endif