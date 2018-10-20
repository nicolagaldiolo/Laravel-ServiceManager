<!-- END: Subheader -->

<div class="m-portlet m-portlet--mobile">
    @component('components.tableHeader', ['icon' => 'flaticon-layers', 'button' => __('messages.new_domain'), 'newModal' => $dataTableNewModal, 'url' => $dataTableNewUrl, 'newModal' => false])
        {{__('messages.all_domains')}}
    @endcomponent
    <div class="m-portlet__body">

        <!--begin: Datatable -->
        <table id="services_table" data-deleteall="{{$dataTableDeleteAll}}" class="table table-striped- table-bordered table-hover table-checkable">
            <thead>
            <tr>
                <th>ID</th>
                <th>{{__('messages.url')}}</th>
                <th>{{__('messages.provider')}}</th>
                <th>{{__('messages.service_type')}}</th>
                <th>Scadenza</th>
                <th>Importo</th>
                <th>Stato</th>
                <th>Unresolved</th>
                <th>{{__('messages.actions')}}</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
