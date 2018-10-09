@extends('layouts.app')

@section('content')

    @component('components.title')
        {{__('messages.domains')}}
    @endcomponent

    <!-- END: Subheader -->
    <div class="m-content">
        <div class="row">
            <div class="col-lg-4">
                <!--begin::Portlet-->
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon">
                                    <i class="flaticon-responsive"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    {{__('messages.site_screenshoot')}}
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="m-form">
                        <div class="m-portlet__body">
                            <div class="m-form__section m-form__section--first">

                                @if(!empty($service->screenshoot))
                                    <img src="{{$service->screenshoot}}" style="max-width: 100%;">
                                @endif

                            </div>
                        </div>

                    </div>

                    <!--end::Form-->
                </div>
                <!--end::Portlet-->

            </div>
            <div class="col-lg-8">
                <!--begin:: Widgets/Company Summary-->
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon">
                                    <i class="flaticon-browser"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    Informazioni sul servizio
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item">
                                    <a class="btn m-btn--pill btn-secondary" href="{{route('services.edit', $service)}}">Modifica</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget13">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="m-widget13__item">
                                        <span class="m-widget13__desc">Cliente</span>
                                        <span class="m-widget13__text m-widget13__text-bolder">{{$service->customer->name}}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="m-widget13__item">
                                        <span class="m-widget13__desc">Url</span>
                                        <span class="m-widget13__text">
                                            <a href="{{$service->url}}" target="_blank">{{$service->url}}</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="m-widget13__item">
                                        <span class="m-widget13__desc">Tipo di servizio</span>
                                        <span class="m-widget13__text m-widget13__text-bolder">{{$service->serviceType->name}}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="m-widget13__item">
                                        <span class="m-widget13__desc">Fornitore</span>
                                        <span class="m-widget13__text m-widget13__text-bolder">
                                            <span class="m-badge m-badge--brand m-badge--wide" style="background:{{$service->provider->label}};">{{$service->provider->name}}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="m-widget13__item">
                                        <span class="m-widget13__desc">Frequenza rinnovo</span>
                                        <span class="m-widget13__text m-widget13__text-bolder">{{\App\Enums\FrequencyRenewals::getDescription($service->frequency)}}</span>
                                    </div>
                                </div>

                            </div>


                        </div>

                        @if($service->note)
                            <div class="m-alert m-alert--icon m-alert--air m-alert--square alert mt-4 mb-0" role="alert">
                                <div class="m-alert__icon">
                                    <i class="la la-warning"></i>
                                </div>
                                <div class="m-alert__text">
                                    <strong>Note: </strong> {{$service->note}}
                                </div>
                            </div>
                        @endif

                    </div>

                </div>


                <!--end::Portlet-->
            </div>
        </div>

        <!--Begin::Section-->
        <div class="row">
            <div class="col-xl-12">

                <!--begin:: Widgets/Sale Reports-->
                <div class="m-portlet m-portlet--full-height ">

                    @component('components.tableHeader', ['icon' => 'flaticon-layers', 'button' => __('Nuova scadenza'), 'url' => route('services.renewals.create', $service)])
                        Storico Rinnovi
                    @endcomponent

                    <div class="m-portlet__body">

                        <!--begin: Datatable -->
                        <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                            <thead>
                                <tr>
                                    <th>Importo</th>
                                    <th>Stato</th>
                                    <th>Data</th>
                                    <th>Azione</th>
                                </tr>
                            </thead>
                        </table>

                    </div>
                </div>

                <!--end:: Widgets/Sale Reports-->
            </div>
        </div>

        <!--End::Section-->

    </div>

    <!--begin::Modal-->
    <div class="modal fade" id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Aggiungi nuova scadenza</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.cancel')}}</button>
                    <button type="button" class="modal-submit btn btn-primary">{{__('messages.save')}}</button>
                </div>
            </div>
        </div>
    </div>

    <!--end::Modal-->
@stop

@section('scripts')
    @parent
    <script>

        jQuery(document).ready( function () {

            var modalPanel = $('#m_modal_1');

            $('.new-record').on('click', function (el) {
                el.preventDefault();
                _self = this;
                $.ajax(_self.href, {
                    method: "GET",
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        if(data.view){
                            modalPanel.find('.modal-body').html(data.view);
                        }

                        $('#service-type-form')
                            .attr('action', '{{route('services.renewals.store', $service)}}')
                            .data('method', 'POST');

                        $('.custom_inline_datepicker').datepicker({
                            todayHighlight: true,
                            format: "dd-mm-yyyy",
                            templates: {
                                leftArrow: '<i class="la la-angle-left"></i>',
                                rightArrow: '<i class="la la-angle-right"></i>'
                            }
                        });

                        modalPanel.modal('show');
                    },
                })

            });

            $('.modal-submit').on('click', function(el) {
                el.preventDefault();

                var serviceForm = $('#service-type-form');

                $.ajax(serviceForm.attr('action'), {
                    method: serviceForm.data('method'),
                    data: serviceForm.serialize(), // faccio la serializzazione dei dati per inviare tutti i campi del form
                    success: function (data) {
                        modalPanel.modal('hide');
                        toastr.success(data.message);
                        dataTable.ajax.reload();
                    },
                    error: function(resp) {

                        resp = JSON.parse(resp.responseText);
                        modalPanel.find("span[data-field]").html('');

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
                //ordering: false,
                ajax: '{{route('services.show', $service)}}',
                columns: [
                    { data: "amount" },
                    { data: "status" },
                    { data: "deadline" },
                    { data: "actions", name: 'action', orderable: false, searchable: false}
                ]
            });

            $('#m_table_1').on('click', '.update-transition', function (el) {
                el.preventDefault();

                var _self = this;
                var _currentTransition = $(_self).data('transition');

                $.ajax(_self.href, {

                    method: "PATCH",
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        toastr.success(data.message);
                        dataTable.ajax.reload();

                        if(_currentTransition == '{{App\Enums\RenewalSM::T_renews}}'){
                            swal({
                                title: 'Vuoi già creare la prossima scadenza?',
                                text: 'Modifica scadenza e importo se lo desideri',
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Si, procedi'
                            }).then(function(result) {
                                if (result.value) {
                                    $( ".new-record" ).trigger( "click" );
                                }
                            });
                        }

                    },
                    error: function (resp, status, error) {
                        resp = JSON.parse(resp.responseText);
                        toastr.error(resp.message);
                    },
                });

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
                        if(data.view){
                            modalPanel.find('.modal-body').html(data.view);
                        }

                        $('#service-type-form')
                            .attr('action', $(_self).data('update'))
                            .data('method', 'PATCH');

                        $('.custom_inline_datepicker').datepicker({
                            todayHighlight: true,
                            format: "dd-mm-yyyy",
                            templates: {
                                leftArrow: '<i class="la la-angle-left"></i>',
                                rightArrow: '<i class="la la-angle-right"></i>'
                            }
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

                        });
                    }

                });

            });

        });
    </script>
@stop
