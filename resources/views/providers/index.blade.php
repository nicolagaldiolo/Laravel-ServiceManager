@extends('layouts.app')

@section('content')
    @component('components.title')
        {{__('messages.providers')}}
    @endcomponent

    <!-- END: Subheader -->
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            @component('components.tableHeader', ['icon' => 'flaticon-interface-7', 'button' => __('messages.new_provider'), 'url' => route('providers.create'), 'newModal' => false])
                {{__('messages.all_providers')}}
            @endcomponent
            <div class="m-portlet__body">

                <!--begin: Datatable -->
                <table id="providers_table" data-deleteall="{{route('providers.destroy-all')}}" class="table table-striped- table-bordered table-hover table-checkable">
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
