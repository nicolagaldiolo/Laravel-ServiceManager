@component('mail::message')
# Hi {{$user->name}}, below is the list of expiring services:
<br>

@foreach($user->customers as $customer)

## Customer: {{$customer->name}}
<table>
    <tr>
        <th>Domain</th>
        <th>Expiring</th>
        <th>Amount</th>
    </tr>
    @foreach($customer->domains as $domain)
        <tr>
            <td>{{$domain->url}}</td>
            <td><strong>{{$domain->deadline->diffForHumans()}} ({{$domain->deadlineFormatted}})</strong></td>
            <td>{{$domain->amount}}</td>
        </tr>
    @endforeach
</table>
<br>

@endforeach

@component('mail::button', ['url' => route('domains.index')])
Manage your services
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
