@extends('layouts.app')

@section('content')
    @component('components.title')
        Frequenze di rinnovo
    @endcomponent

    <!-- END: Subheader -->
    <div class="m-content">

        <div class="m-portlet m-portlet--mobile">
            @component('components.tableHeader', ['icon' => 'flaticon-calendar', 'button' => 'Nuova frequenza di rinnovo', 'url' => route('renewal-frequencies.create'), 'newModal' => true])
                Tutte le frequenze di rinnovo
            @endcomponent
            <div class="m-portlet__body">

                <!--begin: Datatable -->
                <table id="renewalFrequencies_table" data-deleteall="{{route('renewal-frequencies.destroy-all')}}" class="table table-striped- table-bordered table-hover table-checkable">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Valore</th>
                        <th>Tipo</th>
                        <th>{{__('messages.actions')}}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

        <!-- END EXAMPLE TABLE PORTLET-->
    </div>

    @component('components.modal', ['ref_datatable_id' => 'renewalFrequencies_table'])
        Frequenza di rinnovo
    @endcomponent

@stop
