<form action="{{route('service-types.update', $serviceType)}}" class="m-form m-form--fit" method="POST">
    @csrf
    @method('PATCH')
    @include('serviceTypes._form')
</form>
