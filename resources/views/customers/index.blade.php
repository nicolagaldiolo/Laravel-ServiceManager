@extends('layouts.app')

@section('content')
    @component('components.title')
        Customers
    @endcomponent
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            @component('components.tableHeader', ['icon' => 'flaticon-users', 'button' => 'Nuovo customer', 'url' => route('customers.create')])
                Tutti i customers
            @endcomponent
            <div class="m-portlet__body">

                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>address</th>
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
                            success: function( data ) {
                                //console.log(data);
                                swal('Deleted!', 'The record has been deleted.', 'success')
                                dataTable.ajax.reload();
                            },
                            error: function(xhr, status, error) {
                                swal('Error!', 'There was a problem.', 'error')
                            },

                        });
                    }

                });

            });

        });
    </script>
@stop
