@component('mail::message')
# Hi there!

This is a message containing your log in link from {{ config('app.name') }}, the
identity and access manager for {{ config('identity.org.name') }}. Please click
the link below to log into your account.

@component('mail::button', ['url' => $magic_link])
Log in
@endcomponent

Thanks,<br>
{{ config('identity.org.name') }}
@endcomponent
