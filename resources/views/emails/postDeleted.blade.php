@component('mail::message')
# Hey {{ $name }}

Your post "{{ $title }}" was deleted due to violating our community guidelines.

Kindly follow these guideline in the future.

We thank you for your understanding.

Regards,<br>
{{ config('app.name') }}
@endcomponent
