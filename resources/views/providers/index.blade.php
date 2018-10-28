@extends('layouts.app')

@section('content')
    @component('components.title', ['back_url' => route('dashboard')])
        {{__('messages.providers')}}
    @endcomponent

    <!-- END: Subheader -->
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            @component('components.tableHeader', [
                'title' => __('messages.all_providers'),
                'icon' => 'flaticon-interface-7',
                'button' => __('messages.new_provider'),
                'url' => route('providers.create'),
                'newModal' => false,
                'moreAction' => false,
            ])
            @endcomponent
            <div class="m-portlet__body">

                <!--begin: Datatable -->
                <table id="providers_table" data-deleteall="{{route('providers.destroy-all')}}" class="table m-table table-striped- table-bordered table-hover table-checkable">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>{{__('messages.name')}}</th>
                        <th>{{__('messages.label')}}</th>
                        <th>{{__('messages.actions')}}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
@stop
