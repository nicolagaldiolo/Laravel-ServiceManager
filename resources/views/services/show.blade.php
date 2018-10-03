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
                                    <i class="flaticon-browser"></i>
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
                                <h3 class="m-portlet__head-text">
                                    Company Summary
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
                                        <span class="m-widget13__desc">Scadenza</span>
                                        <span class="m-widget13__text m-widget13__text-bolder">26 Settembre 2018</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="m-widget13__item">
                                        <span class="m-widget13__desc">Frequenza rinnovo</span>
                                        <span class="m-widget13__text m-widget13__text-bolder">Annuale</span>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="m-widget13__item">
                                        <span class="m-widget13__desc">Importo</span>
                                        <span class="m-widget13__text m-widget13__text-bolder">&euro; 100,00</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="m-widget13__item">
                                        <span class="m-widget13__desc">Note</span>
                                        <span class="m-widget13__text m-widget13__text-bolder">{{$service->note}}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

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

                <!--end:: Widgets/Company Summary-->


                <!--end::Portlet-->
            </div>
        </div>

        <!--Begin::Section-->
        <div class="row">
            <div class="col-xl-12">

                <!--begin:: Widgets/Sale Reports-->
                <div class="m-portlet m-portlet--full-height ">

                    @component('components.tableHeader', ['icon' => 'flaticon-layers', 'button' => __('Nuova scadenza'), 'url' => 'pippo'])
                        Storico Rinnovi
                    @endcomponent

                    <div class="m-portlet__body">

                        <!--begin: Datatable -->
                        <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Importo</th>
                                    <th>Stato</th>
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



                        <!-- QUI CI ANDRà il portlet -->




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
            var dataTable = jQuery('#m_table_1').DataTable({
                processing: true,
                serverSide: true,
                //ordering: false,
                ajax: '{{route('services.show', $service)}}',
                columns: [
                    { data: "deadline" },
                    { data: "amount" },
                    { data: "status" },
                    { data: "actions", name: 'action', orderable: false, searchable: false}
                ],
                columnDefs: [
                    {
                        targets: [1],
                        render: function(data, type, full, meta){
                            return (data !== null) ? '&euro; ' + data : '';
                        }
                    }
                ]
            });

            dataTable.on('draw.dt', function() {
                $('[data-toggle="m-tooltip"]').tooltip();
            });

            $('#m_table_1').on('click', '.update-transition', function (el) {
                el.preventDefault();

                $.ajax(this.href, {

                    method: "PATCH",
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
