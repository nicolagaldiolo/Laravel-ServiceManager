@extends('layouts.app')

@section('content')
    @component('components.title', ['back_url' => route('dashboard')])
        {{__('messages.services')}}
    @endcomponent
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            @component('components.tableHeader', [
                'title' => __('messages.all_services'),
                'icon' => 'flaticon-layers',
                'button' => __('messages.new_service'),
                'url' => route('services.create'),
                'newModal' => false,
                'dataTarget' => '',
                'moreAction' => false,
            ])
            @endcomponent

            <div class="m-portlet__body">
                @include('services._dataTable', ['dataTableDeleteAll' => route('services.destroy-all')])
            </div>
        </div>

    </div>
@stop
