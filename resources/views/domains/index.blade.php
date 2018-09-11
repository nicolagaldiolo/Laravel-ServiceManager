@extends('layouts.app')

@section('content')
    @component('components.title')
        {{__('messages.domains')}}
    @endcomponent

    @include('domains._dataTable', ['dataTableUrl' => route('domains.index'), 'dataTableNewUrl' => route('domains.create')])
@stop
