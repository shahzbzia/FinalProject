@component('mail::message')
# Congratulations, your payment went through successfully!

You successfully bought the following items!

{{ $_contents }}

You can check out all of your orders in "My Orders" by clicking on the button below!
@component('mail::button', ['url' => config('app.url') . '/my/orders'])
My Orders
@endcomponent

If you have any problems or issues with this purchase, feel free to contact support and provide them with this invoice id "{{ $_chargeId }}" and describe your problem as much as possible.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
