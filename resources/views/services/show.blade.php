@extends('layouts.app')

@section('content')

    @component('components.title')
        {{__('messages.domains')}}
    @endcomponent

    <!-- END: Subheader -->
    <div class="m-content">

        @if($service->renewalsUnresolved()->count() > 0)
        <div class="m-alert m-alert--icon alert alert-danger m--margin-bottom-30" role="alert">
            <div class="m-alert__icon">
                <i class="flaticon-danger"></i>
            </div>
            <div class="m-alert__text">
                <strong>Attenzione!</strong> Hai {{$service->renewalsUnresolved()->count()}} scadenze pendenti da risolvere.
            </div>
        </div>
        @endif

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
                                        @if($service->customer)
                                            <span class="m-widget13__text m-widget13__text-bolder">{{$service->customer->name}}</span>
                                        @endif
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
                                        @if($service->serviceType)
                                            <span class="m-widget13__text m-widget13__text-bolder">{{$service->serviceType->name}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="m-widget13__item">
                                        <span class="m-widget13__desc">Fornitore</span>
                                        @if($service->provider)
                                            <span class="m-widget13__text m-widget13__text-bolder">
                                                <span class="m-badge m-badge--brand m-badge--wide" style="background:{{$service->provider->label}};">{{$service->provider->name}}</span>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="m-widget13__item">
                                        <span class="m-widget13__desc">Frequenza rinnovo</span>
                                        @if($service->renewalFrequency)
                                            <span class="m-widget13__text m-widget13__text-bolder">{{$service->renewalFrequency->frequency}}</span>
                                        @endif
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

                    @component('components.tableHeader', ['icon' => 'flaticon-layers', 'button' => __('Nuova scadenza'), 'url' => route('services.renewals.create', $service), 'newModal' => true, 'deleteAll' => route('services.destroy-all')])
                        Storico Rinnovi
                    @endcomponent

                    <div class="m-portlet__body">

                        <!--begin: Datatable -->
                        <table id="service_renewals_table" data-deleteall="{{route('services.renewals.destroy-all', $service)}}" class="table table-striped- table-bordered table-hover table-checkable">
                            <thead>
                            <tr>
                                <th>Id</th>
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

    @component('components.modal', ['ref_datatable_id' => 'service_renewals_table'])
        Aggiungi nuova scadenza
    @endcomponent
@stop
