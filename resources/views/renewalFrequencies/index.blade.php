@extends('layouts.app')

@section('content')
    @component('components.title', ['back_url' => route('dashboard')])
        {{__('messages.renewal_frequencies')}}
    @endcomponent

    <!-- END: Subheader -->
    <div class="m-content">

        <div class="m-portlet m-portlet--mobile">

            @component('components.tableHeader', [
                'title' => __('messages.all_renewal_frequencies'),
                'icon' => 'flaticon-calendar',
                'button' => __('messages.new_renewal_frequency'),
                'url' => route('renewal-frequencies.create'),
                'newModal' => true,
                'dataTarget' => '',
                'moreAction' => false,
            ])
            @endcomponent
            <div class="m-portlet__body">

                <!--begin: Datatable -->
                <table id="renewalFrequencies_table" data-deleteall="{{route('renewal-frequencies.destroy-all')}}" class="table m-table table-striped- table-bordered table-hover table-checkable">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>{{__('messages.renewal_frequencies_value')}}</th>
                        <th>{{__('messages.renewal_frequencies_type')}}</th>
                        <th>{{__('messages.actions')}}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

        <!-- END EXAMPLE TABLE PORTLET-->
    </div>

    @include('layouts.partials._modal')

@stop
