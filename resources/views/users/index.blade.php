@extends('layouts.app')

@section('content')
    @component('components.title')
        {{__('messages.users')}}
    @endcomponent

    <!-- END: Subheader -->
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            @component('components.tableHeader', ['icon' => 'flaticon-profile', 'button' => __('messages.new_user'), 'url' => route('users.create')])
                {{__('messages.all_users')}}
            @endcomponent
            <div class="m-portlet__body">

                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                    <thead>
                    <tr>
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

@section('scripts')
    @parent
    <script>
        jQuery(document).ready( function () {
            var dataTable = jQuery('#m_table_1').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('users.index')}}',
                columns: [
                    { data: "avatar" },
                    { data: "name" },
                    { data: "email" },
                    { data: "role" },
                    { data: "actions", name: 'action', orderable: false, searchable: false}
                    //{ data: "updated_at" },
                    //{ data: "deleted_at" },

                ],
                columnDefs: [
                    {
                        targets: [0],
                        //title: 'url222',
                        render: function(data, type, full, meta) {
                            if(data == null) return data;
                            return '<img class="m--img-rounded" width="50" src="' + data + '"/>';
                        },
                    },
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

                            success: function(data) {
                                if (data.redirect != '') {
                                    window.location.replace(data.redirect);
                                } else {
                                    toastr.success(data.message);
                                    dataTable.ajax.reload();
                                }
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
