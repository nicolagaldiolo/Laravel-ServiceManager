@component('mail::message')
# {{trans('messages.customer_reminder_title', ['attribute' => $customer->name])}}

@foreach($customer->services as $service)
## {{$service->url}}
@if($service->serviceType)
### {{$service->serviceType->name}}
@endif
<table>
    <tr>
        <th>{{__('messages.deadline')}}</th>
        <th>{{__('messages.amount')}}</th>
        <th>{{__('messages.status')}}</th>
    </tr>
    @foreach($service->renewalsExpiring as $renewal)
        <tr>
            <td>
                <strong>{{$renewal->deadline->diffForHumans()}}</strong><br>
                <small>({{$renewal->deadlineVerbose}})</small>
            </td>
            <td>{{amount_format($renewal->amount)}}</td>
            <td>{{\App\Enums\RenewalSM::getDescription($renewal->getStateAttribute()['attr'])}}</td>
        </tr>
    @endforeach
</table>
<hr>
@endforeach

@component('mail::button', ['url' => route('manage-renewals', ['customer'=>$customer,'token'=>$customer->token])])
    {{ __('messages.manage_services') }}
@endcomponent

{{__('messages.thanks_signature')}},<br>
{{ config('app.name') }}
@endcomponent
