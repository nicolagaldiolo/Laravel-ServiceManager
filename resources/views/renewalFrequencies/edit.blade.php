<form action="{{route('renewal-frequencies.update', $renewalFrequency)}}" class="m-form m-form--fit" method="POST">
    @csrf
    @method('PATCH')
    @include('renewalFrequencies._form')
</form>
