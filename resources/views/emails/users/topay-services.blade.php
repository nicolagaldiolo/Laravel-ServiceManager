@component('mail::message')
# {{trans('messages.topay_services_title', ['attribute' => $user->name])}}
<br>

@foreach($user->customers as $customer)

## {{__('messages.customer')}}: {{$customer->name}}
@foreach($customer->services as $service)
### {{$service->url}} @if($service->serviceType) ({{$service->serviceType->name}}) - <span style="padding: 1px 10px; border-radius: 10px; color:#fff; background: @if($service->provider->label) {{$service->provider->label}} @else #716aca @endif; ">{{$service->provider->name}}</span> @endif
<table>
<tr>
<th>{{__('messages.deadline')}}</th>
<th>{{__('messages.amount')}}</th>
<th>{{__('messages.status')}}</th>
</tr>
@foreach($service->renewalsUnresolved as $renewal)
<tr>
<td><strong>{{$renewal->deadline->diffForHumans()}} ({{$renewal->deadlineVerbose}})</strong></td>
<td>{{amount_format($renewal->amount)}}</td>
<td>{{\App\Enums\RenewalSM::getDescription($renewal->getStateAttribute()['attr'])}}</td>
</tr>
@endforeach
</table>
<hr>
@endforeach
<br>
@endforeach

@component('mail::button', ['url' => route('services.index')])
    {{ __('messages.manage_services') }}
@endcomponent

{{__('messages.thanks_signature')}},<br>
{{ config('app.name') }}
@endcomponent
