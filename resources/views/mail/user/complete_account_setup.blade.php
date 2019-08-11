@component('mail::message')
# Hi there!

This is a friendly email verification message from {{ config('app.name') }}, the
identity and access manager for {{ config('identity.org.name') }}. Please click
the link below to verify your email and continue setting up your new account.

@component('mail::button', ['url' => $setup_link])
Continue Account Setup
@endcomponent

Thanks,<br>
{{ config('identity.org.name') }}
@endcomponent
