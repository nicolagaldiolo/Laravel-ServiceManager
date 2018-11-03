<form action="{{route('service-types.store', $serviceType)}}" class="m-form m-form--fit" method="POST">
    @csrf
    @include('serviceTypes._form')
</form>
