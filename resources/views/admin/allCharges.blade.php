@extends('layouts.app')

@section('content')
<div class="container">

	@foreach ($charges['data'] as $charge)

		<a target="_blank" href="https://dashboard.stripe.com/test/payments/{{ $charge['id'] }}" class="hover:no-underline hover:text-black">
				<div class="h-100 w-full flex justify-center bg-teal-lightest font-sans">
					<div class="bg-white rounded shadow p-6 m-4 w-full lg:w-full">
				        <div class="mb-4 flex">
							<h1 class="text-black font-semibold text-lg">{{ $charge['id'] }}</h1>
				        </div>
				        <div>
				        	<div class="flex mb-1 items-center">
				                <p class="w-full text-grey-darkest"><strong>Name: </strong>{{ $charge['billing_details']['name'] }}</p>
				            </div>
				            <div class="flex mb-1 items-center">
				                <p class="w-full text-grey-darkest"><strong>Email: </strong>{{ $charge['receipt_email'] }}</p>
				            </div>
				            <div class="flex mb-1 items-center">
				                <p class="w-full text-grey-darkest"><strong>Contents: </strong>{{ $charge['metadata']['contents'] }}</p>
				            </div>
				            <div class="flex mb-1 items-center">
				                <p class="w-full text-grey-darkest"><strong>Amount: </strong>{{ ($charge['amount'])/100 }} {{ $charge['currency'] }}</p>
				            </div>
				            <div class="flex mb-1 items-center">
				                <p class="w-full text-grey-darkest"><strong>Reciept URL: </strong> <a target="_blank" href="{{ $charge['receipt_url'] }}">Link to the reciept</a> </p>
				            </div>
				            <div class="flex mb-1 items-center">
				                <p class="w-full text-grey-darkest"><strong>Refunded: </strong>
									
									@if ($charge['refunded'] == 1)
										True
									@else
										False
									@endif

				                </p>
				            </div>
				        </div>
				    </div>
				</div>
			</a>
		
	@endforeach

</div>
@endsection