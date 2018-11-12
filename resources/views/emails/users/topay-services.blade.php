@component('mail::message')
# {{trans('messages.topay_services_title', ['attribute' => $user->name])}}

@foreach($user->customers as $customer)

## {{__('messages.customer')}}: {{$customer->name}}
@foreach($customer->services as $service)
### {{$service->name}} @if($service->serviceType) <span>{{$service->serviceType->name}}</span> @endif @if($service->provider) <small style="padding: 1px 10px; border-radius: 10px; color:#fff; background: @if($service->provider->label) {{$service->provider->label}} @else #716aca @endif; ">{{$service->provider->name}}</small> @endif

@component('mail::table')
    | {{__('messages.deadline')}} | {{__('messages.status')}} | {{__('messages.amount')}} |
    | :- |::| -: |
    @foreach($service->renewalsUnresolved as $renewal)
        | <strong>{{$renewal->deadline->diffForHumans()}}</strong><br><small>({{$renewal->deadlineVerbose}})</small> | {{\App\Enums\RenewalSM::getDescription($renewal->getStateAttribute()['attr'])}} | {{amount_format($renewal->amount)}} |
    @endforeach
@endcomponent
@endforeach
@endforeach

@component('mail::button', ['url' => route('services.index')])
    {{ __('messages.manage_services') }}
@endcomponent

{{__('messages.thanks_signature')}},<br>
{{ config('app.name') }}
@endcomponent
