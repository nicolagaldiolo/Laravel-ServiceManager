<form action="{{route('renewal-frequencies.store', $renewalFrequency)}}" class="m-form m-form--fit" method="POST">
    @csrf
    @include('renewalFrequencies._form')
</form>
