@extends('layouts.app')

@section('content')
    @component('components.title')
        Providers
    @endcomponent

    <!-- END: Subheader -->
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            @component('components.tableHeader', ['icon' => 'flaticon-interface-7', 'button' => 'Nuovo provider', 'url' => route('providers.create')])
                Tutti i providers
            @endcomponent
            <div class="m-portlet__body">

                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Label</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
@stop

@section('scripts')
    @parent
    <script>

        jQuery(document).ready( function () {
            var dataTable = jQuery('#m_table_1').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('providers.index')}}',
                columns: [
                    { data: "name" },
                    { data: "label" },
                    { data: "actions", name: 'action', orderable: false, searchable: false}
                ],
                columnDefs: [
                    {
                        targets: [0],
                        render: function(data, type, full, meta){
                            var image = (full.screenshoot !== null) ? '<img src="' + full.screenshoot + '">' : '';
                            var html = '<div class="m-card-user m-card-user--sm">' +
                                    '  <div class="m-card-user__pic">' +
                                    '    <div class="m-card-user__no-photo">' + image + '</div>' +
                                    '  </div>'+
                                    '  <div class="m-card-user__details">'+
                                    '    <span class="m-card-user__name">' + data + '</span>'+
                                    '    <a target="_blank" href="' + full.website + '" class="m-card-user__email m-link">' + full.website + '</a>'+
                                    '  </div>'+
                                    '</div>';
                            return html;
                        }
                    },
                    {
                        targets: [1],
                        //title: 'url222',
                        render: function(data, type, full, meta) {
                            var color = (typeof data !== 'undefined') ? 'style="background:' + data + '"' : '';
                            return '<span class="m-badge m-badge--wide m-badge--brand" ' + color + '>' + data + '</span>';
                        },
                    }
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

        });
    </script>
@stop
