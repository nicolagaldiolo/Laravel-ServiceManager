@extends('layouts.app')

@section('content')

    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Form Controls</h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="#" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__separator">-</li>
                    <li class="m-nav__item">
                        <a href="" class="m-nav__link">
                            <span class="m-nav__link-text">Forms & Controls</span>
                        </a>
                    </li>
                    <li class="m-nav__separator">-</li>
                    <li class="m-nav__item">
                        <a href="" class="m-nav__link">
                            <span class="m-nav__link-text">Form Validation</span>
                        </a>
                    </li>
                    <li class="m-nav__separator">-</li>
                    <li class="m-nav__item">
                        <a href="" class="m-nav__link">
                            <span class="m-nav__link-text">Form Controls</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push"
                     m-dropdown-toggle="hover" aria-expanded="true">
                    <a href="#"
                       class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
                        <i class="la la-plus m--hide"></i>
                        <i class="la la-ellipsis-h"></i>
                    </a>
                    <div class="m-dropdown__wrapper">
                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                        <div class="m-dropdown__inner">
                            <div class="m-dropdown__body">
                                <div class="m-dropdown__content">
                                    <ul class="m-nav">
                                        <li class="m-nav__section m-nav__section--first m--hide">
                                            <span class="m-nav__section-text">Quick Actions</span>
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="" class="m-nav__link">
                                                <i class="m-nav__link-icon flaticon-share"></i>
                                                <span class="m-nav__link-text">Activity</span>
                                            </a>
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="" class="m-nav__link">
                                                <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                <span class="m-nav__link-text">Messages</span>
                                            </a>
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="" class="m-nav__link">
                                                <i class="m-nav__link-icon flaticon-info"></i>
                                                <span class="m-nav__link-text">FAQ</span>
                                            </a>
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="" class="m-nav__link">
                                                <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                <span class="m-nav__link-text">Support</span>
                                            </a>
                                        </li>
                                        <li class="m-nav__separator m-nav__separator--fit">
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="#"
                                               class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">Submit</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END: Subheader -->
    <div class="m-content">


        <!--Begin::Section-->
        <div class="row">

            <div class="col-xl-6">
                <!--begin:: Widgets/Company Summary-->
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Company Summary
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget13">
                            <div class="m-widget13__item">
				                <span class="m-widget13__desc">Customer Name</span>
                                <span class="m-widget13__text m-widget13__text-bolder">{{$customer->name}}</span>
                            </div>
                            <div class="m-widget13__item">
				                <span class="m-widget13__desc">Email</span>
                                <span class="m-widget13__text m-widget13__text-bolder">{{$customer->email}}</span>
                            </div>
                            <div class="m-widget13__item">
				                <span class="m-widget13__desc">Phone</span>
                                <span class="m-widget13__text">{{$customer->phone}}</span>
                            </div>
                            <div class="m-widget13__item">
				                <span class="m-widget13__desc">Address</span>
                                <span class="m-widget13__text">{{$customer->address}}</span>
                            </div>

                            <div class="m-widget13__action">
                                <a class="btn m-btn--pill btn-secondary" href="{{route('customers.edit', $customer)}}">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end:: Widgets/Company Summary-->  </div>

            <div class="col-xl-6">
                <!--begin:: Widgets/Finance Summary-->
                <div class="m-portlet m-portlet--full-height">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Finance Summary
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget12">
                            <div class="m-widget12__item">
                                <span class="m-widget12__text1">Totale fatturato<br><span>€ {{$customerRevenue}}</span></span>
                                <div class="m-widget12__text2">
                                    <div class="m-widget12__desc">Media fatturato totale</div>
                                    <br>
                                    <div class="m-widget12__progress">
                                        <div class="m-widget12__progress-sm progress m-progress--sm">
                                            <div class="m-widget12__progress-bar progress-bar bg-brand" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width:{{$revenueAvarage}}%;"></div>
                                        </div>
                                        <span class="m-widget12__stats">{{$revenueAvarage}}%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="m-widget12__item">
                                <span class="m-widget12__text1">Servizi attivi<br><span>{{$customerDomainsCount}}</span></span>
                                <span class="m-widget12__text2">Servizi in scadenza<br><span>{{$toPay}}</span></span>
                            </div>

                        </div>


                    </div>
                </div>
                <!--end:: Widgets/Finance Summary-->

            </div>

        </div>
        <!--End::Section-->

    </div>

    @if($customerDomainsCount > 0)
        @include('domains._dataTable', ['dataTableUrl' => route('customers.show', $customer)])
    @endif


@stop

@section('scripts')
    @parent
@stop
