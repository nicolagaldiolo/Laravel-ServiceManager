@extends('layouts.app')

@section('content')
    @component('components.title')
        {{__('messages.service_types')}}
    @endcomponent

    <!-- END: Subheader -->
    <div class="m-content">

        <div class="m-portlet m-portlet--mobile">
            @component('components.tableHeader', ['icon' => 'flaticon-interface-7', 'button' => __('messages.new_service_type'), 'url' => ''])
                {{__('messages.all_service_types')}}
            @endcomponent
            <div class="m-portlet__body">

                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                    <thead>
                    <tr>
                        <th>{{__('messages.name')}}</th>
                        <th>{{__('messages.actions')}}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

        <!-- END EXAMPLE TABLE PORTLET-->
    </div>

    <!--begin::Modal-->
    <form id="service-type-form" class="m-form m-form--fit">
        @csrf
        <div class="modal fade" id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{__('messages.service_type')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="m-portlet__body">
                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group">
                                        <label class="">{{__('messages.name')}} *</label>
                                        <div class="m-input-icon m-input-icon--left">
                                            <input id="service-type-name" type="text" name="name" class="form-control m-input">
                                            <span class="m-input-icon__icon m-input-icon__icon--left">
                                                            <span>
                                                                <i class="la la-tag"></i>
                                                            </span>
                                                        </span>
                                        </div>
                                        <span class="m-form__help">{{__('messages.enter_service_type_name')}}</span>


                                            <span data-field="name" class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>


                                    </div>

                                </div>
                            </div>




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.cancel')}}</button>
                        <button type="submit" class="modal-submit btn btn-primary">{{__('messages.save')}}</button>
                    </div>
                </div>
            </div>
        </div>

        <!--end::Modal-->
    </form>

@stop

@section('scripts')
    @parent
    <script>

        jQuery(document).ready( function () {

            var serviceForm = $('#service-type-form');
            var modalPanel = $('#m_modal_1');

            modalPanel.on('hide.bs.modal', function (e) {
                serviceForm.trigger('reset');
                modalPanel.find("span[data-field]").html("");
            });

            $('.new-record').on('click', function (el) {
                el.preventDefault();
                modalPanel.modal('show');

                $(serviceForm)
                    .attr('action', '{{route('service-types.store')}}')
                    .data('method', 'POST');
            });

            $(serviceForm).on('submit', function(el) {
                el.preventDefault();

                $.ajax(el.target.action, {
                    method: $(el.target).data('method'),
                    data: $(this).serialize(), // faccio la serializzazione dei dati per inviare tutti i campi del form
                    success: function (data) {
                        modalPanel.modal('hide');
                        toastr.success(data.message);
                        dataTable.ajax.reload();
                    },
                    error: function(resp) {
                        resp = JSON.parse(resp.responseText);

                        if(resp.errors) {
                            jQuery.each(resp.errors, function (key, value) {
                                modalPanel.find("span[data-field='" + key + "']").html('<strong>' + value + '</strong>');
                            });
                        }else{
                            toastr.error(resp.message);
                            modalPanel.modal('hide');
                        }

                    },
                })
            });

            var dataTable = jQuery('#m_table_1').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('service-types.index')}}',
                columns: [
                    { data: "name" },
                    { data: "actions", name: 'action', orderable: false, searchable: false}
                ],
            });

            $('#m_table_1').on('click', '.edit', function (el) {
                el.preventDefault();

                _self = this;

                $.ajax(_self.href, {
                    method: "GET",
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        $(serviceForm)
                            .attr('action', $(_self).data('update'))
                            .data('method', 'PATCH');

                        jQuery.each(data, function (key, value) {
                            modalPanel.find("input[name='"+key+"']").val(value);
                        });
                        modalPanel.modal('show');
                    },
                })

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
