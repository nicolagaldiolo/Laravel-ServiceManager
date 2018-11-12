@component('mail::message')
# {{trans('messages.customer_reminder_title', ['attribute' => $customer->name])}}

@foreach($customer->services as $service)
### {{$service->name}} @if($service->serviceType) <span>{{$service->serviceType->name}}</span> @endif

@component('mail::table')
    | {{__('messages.deadline')}} | {{__('messages.status')}} | {{__('messages.amount')}} |
    | :- |::| -: |
    @foreach($service->renewalsExpiring as $renewal)
        | <strong>{{$renewal->deadline->diffForHumans()}}</strong><br><small>({{$renewal->deadlineVerbose}})</small> | {{\App\Enums\RenewalSM::getDescription($renewal->getStateAttribute()['attr'])}} | {{amount_format($renewal->amount)}} |
    @endforeach
@endcomponent
@endforeach

@component('mail::button', ['url' => route('manage-renewals', ['customer'=>$customer,'token'=>$customer->token])])
    {{ __('messages.manage_services') }}
@endcomponent

{{__('messages.thanks_signature')}},<br>
{{ config('app.name') }}
@endcomponent
