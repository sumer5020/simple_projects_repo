@component('mail::message')

@component('vendor.mail.html.center')
# {{ $message['subject'] }}
@endcomponent

***

@component('mail::promotion')
  {{ __('mailing.name').': ['.$message['name'].']' }}

  {{ __('mailing.email').': ['.$message['email'].']' }}
@endcomponent

{{ $message['message'] }}

***
<br>
{{ __('mailing.regards') }},<br>
{{ config('app.name').' - '.__('mailing.devTeam') }}
@endcomponent
