<form method="POST" action="{{route('customers.store')}}" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
    @csrf
    @include('customers._form')
</form>
