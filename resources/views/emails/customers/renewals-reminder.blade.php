@component('mail::message')
# Hi {{$customer->name}}, below is the list of expiring services:

@foreach($customer->services as $service)
## {{$service->url}} ({{$service->serviceType->name}})
<table>
    <tr>
        <th>Deadline</th>
        <th>Amount</th>
        <th>Status</th>
    </tr>
    @foreach($service->renewalsExpiring as $renewal)
        <tr>
            <td><strong>{{$renewal->deadline->diffForHumans()}} ({{$renewal->deadlineVerbose}})</strong></td>
            <td>{{$renewal->amountVerbose}}</td>
            <td>{{\App\Enums\RenewalSM::getDescription($renewal->getStateAttribute()['attr'])}}</td>
        </tr>
    @endforeach
</table>
<hr>
@endforeach

@component('mail::button', ['url' => route('manage-renewals', ['customer'=>$customer,'token'=>$customer->token])])
Manage the services
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
