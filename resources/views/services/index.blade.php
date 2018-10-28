@extends('layouts.app')

@section('content')
    @component('components.title', ['back_url' => route('dashboard')])
        {{__('messages.domains')}}
    @endcomponent
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            @component('components.tableHeader', [
                'title' => __('messages.all_domains'),
                'icon' => 'flaticon-layers',
                'button' => __('messages.new_domain'),
                'newModal' => true,
                'url' => route('services.create'),
                'newModal' => false,
                'moreAction' => false,
            ])
            @endcomponent

            <div class="m-portlet__body">
                @include('services._dataTable', ['dataTableDeleteAll' => route('services.destroy-all')])
            </div>
        </div>

    </div>
@stop
