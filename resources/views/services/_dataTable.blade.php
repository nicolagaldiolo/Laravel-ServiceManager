<!-- END: Subheader -->

<div class="m-portlet m-portlet--mobile">
    @component('components.tableHeader', ['icon' => 'flaticon-layers', 'button' => __('messages.new_domain'), 'url' => $dataTableNewUrl])
        {{__('messages.all_domains')}}
    @endcomponent
    <div class="m-portlet__body">

        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
            <thead>
            <tr>
                <th>{{__('messages.url')}}</th>
                <th>{{__('messages.customer')}}</th>
                <th>{{__('messages.provider')}}</th>
                <th>{{__('messages.service_type')}}</th>
                <th>{{__('messages.frequency_renewal')}}</th>
                <th>Scadenza</th>
                <th>Importo</th>
                <th>Stato</th>
                <th>{{__('messages.actions')}}</th>
            </tr>
            </thead>
        </table>
    </div>
</div>

@section('scripts')
    @parent
    <script>


        jQuery(document).ready( function () {
            var dataTable = jQuery('#m_table_1').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{$dataTableUrl}}',
                columns: [
                    { data: "url" },
                    { data: "customer" },
                    { data: "provider" },
                    { data: "service_type" },
                    { data: "frequency" },
                    { data: "deadline" },
                    { data: "amount" },
                    { data: "status" },
                    { data: "actions", name: 'action', orderable: false, searchable: false}
                ],
                columnDefs: [
                    {
                        targets: 0,
                        render: function(data, type, full, meta) {
                            var image = (full.screenshoot !== null) ? '<img src="' + full.screenshoot + '">' : '';

                            var label,status;
                            if(full.status == 1){
                                label = "success";
                                status = "{{__('messages.online')}}";
                            }else{
                                label = "danger";
                                status = "{{__('messages.offline')}}";
                            }

                            var html = '<div class="m-card-user m-card-user--sm">' +
                                '  <div class="m-card-user__pic">' +
                                '    <div class="m-card-user__no-photo">' + image + '</div>' +
                                '  </div>'+
                                '  <div class="m-card-user__details">'+
                                '    <span class="m-card-user__name">' + data + '</span>'+
                                '    <span class="m-badge m-badge--' + label + ' m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-' + label + '">' + status + '</span>'+
                                '  </div>'+
                                '</div>';
                            return html;
                        },
                    },
                    
                    {
                        targets: [ 1 ],
                        render: function(data, type, full, meta) {
                            return data == null ? '' : data.name;
                        },
                    },

                    {
                        targets: [ 2 ],
                        render: function(data, type, full, meta) {
                            if(data == null) return '';
                            var color = (typeof data.label !== 'undefined') ? 'style="background:' + data.label + '"' : '';
                            return '<span class="m-badge m-badge--brand m-badge--wide" ' + color + '>' + data.name + '</span>';
                        },
                    },

                    {
                        targets: [ 3 ],
                        render: function(data, type, full, meta) {
                            return data == null ? '' : data.name;
                        },
                    },
/*
                    {
                        targets: 6,
                        render: function(data, type, full, meta) {
                            if(data == null) return data;

                            var label,status;
                            if(data == 1){
                                label = "primary";
                                status = "{{__('messages.payed')}}";
                            }else{
                                label = "danger";
                                status = "{{__('messages.not_payed')}}";
                            }
                            return '<span class="m-badge  m-badge--' + label + ' m-badge--wide">' + status + '</span>';
                        },
                    }
*/
                ]

            });

            $('#m_table_1').on('click', '.delete', function (el) {
                el.preventDefault();

                var _self = this;

                swal({
                    title: '{{__('messages.are_sure')}}',
                    text: "{{__('messages.are_sure_desc')}}",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '{{__('messages.confirm_delete')}}'
                }).then(function(result) {

                    if (result.value) {
                        var action = _self.href;

                        $.ajax(action, {

                            method: "DELETE",
                            data: {
                                '_token': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (data) {
                                toastr.success(data.message);
                                dataTable.ajax.reload();
                            },
                            error: function (resp, status, error) {
                                resp = JSON.parse(resp.responseText);
                                toastr.error(resp.message);
                            },

                        })
                    }
                });

            });

            $('#m_table_1').on('click', '.setPayed', function (el) {
                el.preventDefault();

                var _self = this;

                swal({
                    title: '{{__('messages.are_sure')}}',
                    text: "{{__('messages.are_sure_desc')}}",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '{{__('messages.yes_procede')}}'
                }).then(function(result) {

                    if (result.value) {
                        var action = _self.href;
                        $.ajax(action, {

                            method: "PATCH",
                            data: {
                                '_token': $('meta[name="csrf-token"]').attr('content'),
                                'payed': _self.getAttribute('data-status')
                            },
                            success: function(data) {
                                toastr.success(data.message);
                                dataTable.ajax.reload();
                            },
                            error: function(resp, status, error) {
                                resp = JSON.parse(resp.responseText);
                                toastr.error(resp.message);
                            },

                        })
                    }
                });

            });

        });
    </script>
@stop
