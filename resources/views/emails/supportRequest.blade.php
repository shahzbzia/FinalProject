@component('mail::message')
# Contact support request

Email: {{ $fromEmail }}

Subject: {{ $subject }}

Question: {{ $question }}

@endcomponent
