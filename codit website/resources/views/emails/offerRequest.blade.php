@component('mail::message')

@component('vendor.mail.html.center')
# {{ __('mailing.adminOfferMailTitle') }}
@endcomponent

***

<br>
### {{ __('mailing.customerInfo') }}
@component('mail::promotion')
  {{ __('mailing.name').': ['.$applyData['customer_name'].']' }}

  {{ __('mailing.phone').': ['.$applyData['customer_phone1'].($applyData['customer_phone2'] ? ' - '.$applyData['customer_phone2'] : '').']' }}

  {{ __('mailing.email').': ['.$applyData['customer_email'].']' }}
@endcomponent

{{ __('mailing.hello').' '.$applyData['admin_name'].', '.__('mailing.offerForYou').' ('.$applyData['offer_title'].') '.__('mailing.mustMake').' '.$applyData['offer_desc'] }}

>{{ __('mailing.customerOrderDetails').': '.$applyData['order_details'] }}

{{ __('mailing.customerIsWaiting') }}

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
