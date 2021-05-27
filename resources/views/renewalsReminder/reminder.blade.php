@extends('layouts.reminder')

{{--dd($customer)--}}

@section('title')
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver">
        <div class="m-grid__item m-grid__item--middle">
            <span class="m-login__title">{{trans('messages.customer_reminder_name', ['attribute' => $customer->name])}}</span>
            <span class="m-login__subtitle m--marginless">{{__('messages.customer_reminder_desc')}}</span>
        </div>
    </div>
@stop

@section('content')

    @if($customer->services->isEmpty())
        <div class="m--align-center">
            <i class="m--font-metal la la-hand-spock-o" style="font-size: 20rem;"></i>
            <h4 class="h1 m--padding-top-20">{{__('messages.customer_reminder_no_action_title')}}</h4>
            <span class="h4 m--font-metal">{{__('messages.customer_reminder_no_action_desc')}}</span>
        </div>
    @else

        <div class="renewal-reminder-container">
            <div class="renewal-reminder-content">
                <form method="POST" action="{{route('manage-renewals.update', ['customer'=>$customer, 'verification_code'=>$token])}}">
                    @csrf
                    @method('PATCH')
                    @foreach($customer->services as $service)
                        <div class="m-portlet">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon">
                                    <i class="flaticon-layers"></i>
                                </span>
                                        <h3 class="m-portlet__head-text">
                                            {{$service->name}}
                                            @if($service->url)
                                                <small>{{$service->url}}</small>
                                            @endif
                                        </h3>
                                    </div>
                                </div>
                                <div class="m-portlet__head-tools">
                                    <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
                                        <li class="nav-item m-tabs__item">
                                    <span class="nav-link m-tabs__link active">
                                        {{$service->serviceType->name}}
                                    </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="m-portlet__body">

                                <!--Begin::Tab Content-->
                                <div class="tab-content">

                                    <!--begin::tab 1 content-->
                                    <div class="tab-pane active" id="m_widget11_tab1_content">

                                        <!--begin::Widget 11-->
                                        <div class="m-widget11">
                                            <div class="table-responsive">

                                                <!--begin::Table-->
                                                <table class="table">

                                                    <!--begin::Thead-->
                                                    <thead>
                                                    <tr>
                                                        <td class="m-widget11__app">{{__('messages.deadline')}}</td>
                                                        <td class="m-widget11__total m--align-right">{{__('messages.amount')}}</td>
                                                        <td class="m-widget11__label m--align-right" style="width:17%;">{{__('messages.action')}}</td>
                                                    </tr>
                                                    </thead>

                                                    <!--end::Thead-->

                                                    <!--begin::Tbody-->
                                                    <tbody>
                                                    @foreach($service->renewalsExpiring as $renewal)
                                                        <tr class="renewal-service-row">
                                                            <td>
                                                                <span class="m-widget11__title">{{$renewal->deadline->diffForHumans()}}</span>
                                                                <span class="m-widget11__sub">{{$renewal->deadlineVerbose}}</span>
                                                            </td>
                                                            <td class="m--align-right m--font-brand">{{amount_format($renewal->amount)}}</td>
                                                            <td class="m--align-right">
                                                                <div class="m-radio-inline">
                                                                    <label class="m-radio">
                                                                        <input class="renew" type="radio" name="tmp_renewal_id[{{$renewal->id}}]" value="{{\App\Enums\RenewalSM::T_renews}}" @if(\App\Enums\RenewalSM::T_renews == old('renewal_id.' . $renewal->id)) checked @endif> {{\App\Enums\RenewalSM::getDescription(\App\Enums\RenewalSM::T_renews)}}
                                                                        <span></span>
                                                                    </label>
                                                                    <label class="m-radio">
                                                                        <input class="suspend" type="radio" name="tmp_renewal_id[{{$renewal->id}}]" value="{{\App\Enums\RenewalSM::T_suspend}}" @if(\App\Enums\RenewalSM::T_suspend == old('renewal_id.' . $renewal->id)) checked @endif> {{\App\Enums\RenewalSM::getDescription(\App\Enums\RenewalSM::T_suspend)}}
                                                                        <span></span>
                                                                    </label>

                                                                    <input type="hidden" name="renewal_id[{{$renewal->id}}]" value="{{old('renewal_id.' . $renewal->id)}}" checked>
                                                                </div>

                                                                @if ($errors->has('renewal_id.' . $renewal->id))
                                                                    <span class="m--margin-top-10 m-badge m-badge--danger m-badge--wide">{{ $errors->first('renewal_id.' . $renewal->id) }}</span>
                                                                @endif
                                                            </td>
                                                        </tr>

                                                    @endforeach

                                                    </tbody>

                                                    <!--end::Tbody-->
                                                </table>

                                                <!--end::Table-->
                                            </div>
                                        </div>

                                        <!--end::Widget 11-->
                                    </div>

                                    <!--end::tab 1 content-->

                                </div>

                                <!--End::Tab Content-->
                            </div>
                        </div>
                    @endforeach
                    <div class="m--align-right">
                        <button type="submit" class="openAlertBeforeSubmit btn m-btn--pill btn-brand btn-lg">{{__('messages.confirm')}}</button>
                    </div>
                </form>
            </div>
        </div>

    @endif
@stop
