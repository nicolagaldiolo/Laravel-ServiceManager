@component('mail::message')
# Ciao {{$user->name}}, di seguito l'elenco dei servizi in scadenza:

<table>
    <tr>
        <th>Dominio</th>
        <th>Scadenza</th>
        <th>importo</th>
    </tr>
    @foreach($user->domains as $domain)
        <tr>
            <td>{{$domain->url}}</td>
            <td><strong>{{$domain->deadline->diffForHumans()}} ({{$domain->deadlineFormatted}})</strong></td>
            <td>{{$domain->amount}}</td>
        </tr>
    @endforeach
</table>

@component('mail::button', ['url' => route('domains.index')])
Gestisci i servizi
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
