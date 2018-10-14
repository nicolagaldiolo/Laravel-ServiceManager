@extends('layouts.app')

@section('content')
    @component('components.title')
        {{__('messages.domains')}}
    @endcomponent
    <div class="m-content">
        @include('services._dataTable', ['dataTableUrl' => route('services.index'), 'dataTableNewUrl' => route('services.create'), 'dataTableNewModal' => true, 'dataTableDeleteAll' => route('services.destroy-all')])
    </div>
@stop
