@extends('layouts.app')

@section('content')
    @component('components.title')
        {{__('messages.customers')}}
    @endcomponent
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            @component('components.tableHeader', ['icon' => 'flaticon-users', 'button' => __('messages.new_customer'), 'url' => route('customers.create')])
                {{__('messages.all_customers')}}
            @endcomponent
            <div class="m-portlet__body">

                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                    <thead>
                    <tr>
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

@section('scripts')
    @parent
    <script>

        jQuery(document).ready( function () {
            var dataTable = jQuery('#m_table_1').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('customers.index')}}',
                columns: [
                    { data: "name" },
                    { data: "email" },
                    { data: "phone" },
                    { data: "address" },
                    { data: "actions", name: 'action', orderable: false, searchable: false}
                ],
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
                            success: function( data ) {
                                //console.log(data);
                                swal('{{__('messages.deleted_title')}}', '{{__('messages.deleted_desc')}}', 'success')
                                dataTable.ajax.reload();
                            },
                            error: function(xhr, status, error) {
                                swal('{{__('messages.error_title')}}', '{{__('messages.error_desc')}}', 'error')
                            },

                        });
                    }

                });

            });

        });
    </script>
@stop
