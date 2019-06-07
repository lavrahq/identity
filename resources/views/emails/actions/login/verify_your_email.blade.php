@component('mail::message')
# Hi there!

This is a friendly email verification message from {{ config('app.name') }}, the
identity and access manager for {{ config('dbs.community_name') }}. Please click
the link below to verify your email and continue setting up your new account.

@component('mail::button', ['url' => $verification_url])
Continue Setup...
@endcomponent

Thanks,<br>
{{ config('dbs.community_name') }}
@endcomponent
