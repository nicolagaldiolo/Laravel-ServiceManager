@extends('layouts.app')

@section('content')
    @component('components.title')
        {{__('messages.users')}}
    @endcomponent

    <!-- END: Subheader -->
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            @component('components.tableHeader', ['icon' => 'flaticon-profile', 'button' => __('messages.new_user'), 'url' => route('users.create'), 'deleteAll' => route('users.destroy-all')])
                {{__('messages.all_users')}}
            @endcomponent
            <div class="m-portlet__body">

                <!--begin: Datatable -->
                <table id="users_table" class="table table-striped- table-bordered table-hover table-checkable">
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
