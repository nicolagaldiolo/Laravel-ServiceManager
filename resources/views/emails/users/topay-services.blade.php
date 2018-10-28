@component('mail::message')
# Hi {{$user->name}}, below is the list of expiring services:
<br>

@foreach($user->customers as $customer)

## Customer: {{$customer->name}}
@foreach($customer->services as $service)
### {{$service->url}} ({{$service->serviceType->name}}) - <span style="padding: 1px 10px; border-radius: 10px; color:#fff; background: @if($service->provider->label) {{$service->provider->label}} @else #716aca @endif; ">{{$service->provider->name}}</span>
<table>
    <tr>
        <th>Deadline</th>
        <th>Amount</th>
        <th>Status</th>
    </tr>
    @foreach($service->renewalsUnresolved as $renewal)
        <tr>
            <td><strong>{{$renewal->deadline->diffForHumans()}} ({{$renewal->deadlineVerbose}})</strong></td>
            <td>{{$renewal->amountVerbose}}</td>
            <td>{{\App\Enums\RenewalSM::getDescription($renewal->getStateAttribute()['attr'])}}</td>
        </tr>
    @endforeach
</table>
<hr>
@endforeach
<br>
@endforeach

@component('mail::button', ['url' => route('services.index')])
Manage the services
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
