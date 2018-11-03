@extends('layouts.app')

@section('content')
    @component('components.title', ['back_url' => route('dashboard')])
        {{__('messages.users')}}
    @endcomponent

    <!-- END: Subheader -->
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            @component('components.tableHeader', [
                'title' => __('messages.all_users'),
                'icon' => 'flaticon-profile',
                'button' => __('messages.new_user'),
                'url' => '',
                'newModal' => false,
                'dataTarget' => '',
                'moreAction' => false,
            ])

            @endcomponent
            <div class="m-portlet__body">

                <!--begin: Datatable -->
                <table id="users_table" data-deleteall="{{route('users.destroy-all')}}" class="table m-table table-striped- table-bordered table-hover table-checkable">
                    <thead>
                        <tr>
                            <th>Record ID</th>
                            <th>{{__('messages.avatar')}}</th>
                            <th>{{__('messages.name')}}</th>
                            <th>{{__('messages.email')}}</th>
                            <th>{{__('messages.role')}}</th>
                            <th>{{__('messages.actions')}}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
@stop
