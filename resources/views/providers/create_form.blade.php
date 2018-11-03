<!--begin::Form-->
<form method="POST" action="{{route('providers.store')}}" class="m-form m-form--fit m-form--label-align-right">
    @csrf
    @include('providers._form')
</form>
<!--end::Form-->
