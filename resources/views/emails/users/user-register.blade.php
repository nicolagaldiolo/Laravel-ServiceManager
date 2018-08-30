@component('mail::message')
# Ciao, {{$admin->name}}

Un nuovo utente si è registrato {{$user->created_at->diffForHumans()}}!

## {{$user->name}} <br> {{$user->email}}

@component('mail::button', ['url' => route('dashboard')])
Accedi
@endcomponent

Grazie,<br>
{{ config('app.name') }}
@endcomponent
