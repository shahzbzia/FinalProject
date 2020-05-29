@component('mail::message')
# {{ $_name }} has requested to hire you!

<div>
	<label>Email:</label>
	<p>{{ $_email }}</p>
</div>

<div>
	<label>Subject:</label>
	<p>{{ $_subject }}</p>
</div>

<div>
	<label for="">Description:</label>
	<p>{{ $_description }}</p>
</div>

<div>
	<p>Interested? Feel free to send him an email!</p>
</div>

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent
 --}}
Thanks,<br>
{{ config('app.name') }}
@endcomponent
