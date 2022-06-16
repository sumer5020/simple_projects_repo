@component('mail::message')

@component('vendor.mail.html.center')
# {{ __('mailing.customerOfferMailTitle') }}
@endcomponent

***

{{ __('mailing.thanks').' '.$applyData['customer_name'].', '.__('mailing.forOrderingAnOffer').' ('.$applyData['offer_title'].') '.__('mailing.thatWeWill').' '.$applyData['offer_desc'] }}

>{{ __('mailing.AsYouSade').': '.$applyData['order_details'] }}

{{ __('mailing.willCodit') }}

<br>

### {{ __('mailing.orderReport') }}
@component('mail::table')
|{{ __('mailing.orderId') }}|{{ __('mailing.orderTitle') }}|{{ __('mailing.cost') }}|{{ __('mailing.orderDate') }}|
|----------|-------------|------|------------|
|{{ $applyData['order_id'] }}|{{ $applyData['offer_title'] }}|{{ $applyData['offer_cost'].'$' }}|{{ $applyData['created_at'] }}|
@endcomponent

***
<br>
{{ __('mailing.regards') }},<br>
{{ config('app.name').' - '.__('mailing.devTeam') }}
@endcomponent
