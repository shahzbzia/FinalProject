@component('mail::message')
# Hi {{ $name }}! Your dispute was submitted successfully!

Dispute Id: {{ $issueId }}

<div>
	<p>Our admins will look into it as soon as possible and contact you to resolve this issue!</p>

</div>

<p>We are very sorry for any covinience this may have causer.</p>

<p>We hope you will continue to enjot ARTillary!</p>

<p>PS: You can checkout your disputes by clicking on the button below. Feel free to contact support if you have any questions regarding your dispute.</p>

@component('mail::button', ['url' => config('app.url') . '/my/disputes'])
My Disputes
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
