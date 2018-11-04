@component('mail::message')
# {{trans('messages.user_registered_title', ['attribute' => $admin->name])}}

{{trans('messages.user_registered_desc', ['attribute' => $user->created_at->diffForHumans()])}}

## {{$user->name}} <span> {{$user->email}} </span>

@component('mail::button', ['url' => route('dashboard')])
    {{__('messages.accedi')}}
@endcomponent

{{__('messages.thanks_signature')}},<br>
{{ config('app.name') }}
@endcomponent
