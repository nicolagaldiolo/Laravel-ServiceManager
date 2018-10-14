@extends('layouts.app')

@section('content')
    @component('components.title')
        {{__('messages.customers')}}
    @endcomponent
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            @component('components.tableHeader', ['icon' => 'flaticon-users', 'button' => __('messages.new_customer'), 'url' => route('customers.create'), 'newModal' => false])
                {{__('messages.all_customers')}}
            @endcomponent
            <div class="m-portlet__body">

                <!--begin: Datatable -->
                <table id="customers_table" data-deleteall="{{route('customers.destroy-all')}}" class="table table-striped- table-bordered table-hover table-checkable">
                    <thead>
                    <tr>
                        <th>Record ID</th>
                        <th>{{__('messages.name')}}</th>
                        <th>{{__('messages.email')}}</th>
                        <th>{{__('messages.phone')}}</th>
                        <th>{{__('messages.address')}}</th>
                        <th>{{__('messages.actions')}}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

        <!-- END EXAMPLE TABLE PORTLET-->
    </div>


@stop
