<!-- END: Subheader -->
<div class="m-content">
    <div class="m-portlet m-portlet--mobile">
        @component('components.tableHeader', ['icon' => 'flaticon-layers', 'button' => 'Nuovo dominio', 'url' => $dataTableNewUrl])
            Tutti i domini
        @endcomponent
        <div class="m-portlet__body">

            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                <thead>
                <tr>
                    <th>Url</th>
                    <th>Domain</th>
                    <th>Hosting</th>
                    <th>Deadline</th>
                    <th>Amount</th>
                    <th>Note</th>
                    <th>Payed</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- END EXAMPLE TABLE PORTLET-->
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
                    { data: "domain" },
                    { data: "hosting" },
                    { data: "deadline" },
                    { data: "amount" },
                    { data: "note" },
                    { data: "payed" },
                    { data: "status" },
                    { data: "actions", name: 'action', orderable: false, searchable: false}
                    //{ data: "updated_at" },
                    //{ data: "deleted_at" },

                ],
                columnDefs: [
                    {
                        targets: 0,
                        render: function(data, type, full, meta) {
                            //console.log(full);
                            if(full.screenshoot == null) return data;
                            return '<img width="100" src="' + full.screenshoot + '"/>' + data;
                        },
                    },

                    {
                        targets: [ 1, 2 ],
                        render: function(data, type, full, meta) {
                            if(data == null) return data;
                            var color = (typeof data.label !== 'undefined') ? 'style="background:' + data.label + '"' : '';
                            return '<span class="m-badge ' + data + ' m-badge--wide" ' + color + '>' + data.name + '</span>';
                        },
                    },

                    {
                        targets: 6,
                        render: function(data, type, full, meta) {
                            if(data == null) return data;

                            var label,status;
                            if(data == 1){
                                label = "primary";
                                status = "Payed";
                            }else{
                                label = "danger";
                                status = "Not Payed";
                            }
                            return '<span class="m-badge  m-badge--' + label + ' m-badge--wide">' + status + '</span>';
                        },
                    },

                    {
                        targets: 7,
                        render: function(data, type, full, meta) {
                            if(data == null) return data;

                            var label,status;
                            if(data == 1){
                                label = "primary";
                                status = "Online";
                            }else{
                                label = "danger";
                                status = "Offline";
                            }
                            return '<span class="m-badge m-badge--' + label + ' m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-' + label + '">' + status + '</span>';
                        },
                    },

                ]
            });

            $('#m_table_1').on('click', '.delete', function (el) {
                el.preventDefault();

                var _self = this;

                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!'
                }).then(function(result) {

                    if (result.value) {
                        var action = _self.href;
                        $.ajax(action, {

                            method: "DELETE",
                            data: {
                                '_token': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (data) {
                                //console.log(data);
                                swal('Deleted!', 'The record has been deleted.', 'success')
                                dataTable.ajax.reload();
                            },
                            error: function (xhr, status, error) {
                                swal('Error!', 'There was a problem.', 'error')
                            },

                        })
                    }
                });

            });

            $('#m_table_1').on('click', '.setPayed', function (el) {
                el.preventDefault();

                var _self = this;

                swal({
                    title: 'Are you sure?',
                    text: "Do you want to proceed?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, of course!'
                }).then(function(result) {

                    if (result.value) {
                        var action = _self.href;
                        $.ajax(action, {

                            method: "PATCH",
                            data: {
                                '_token': $('meta[name="csrf-token"]').attr('content'),
                                'payed': _self.getAttribute('data-status')
                            },
                            success: function (data) {
                                //console.log(data);
                                swal('Great!', 'Operation performed successfully.', 'success')
                                dataTable.ajax.reload();
                            },
                            error: function (xhr, status, error) {
                                swal('Error!', 'There was a problem.', 'error')
                            },

                        })
                    }
                });

            });

        });
    </script>
@stop