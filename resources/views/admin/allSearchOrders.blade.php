@extends('layouts.app')

@section('content')
<div class="container">
	
	@foreach ($orders as $order)
					<div class="h-100 w-full flex justify-center bg-teal-lightest font-sans">
						<div class="bg-white rounded shadow p-6 m-4 w-full lg:w-full">
					        <div class="mb-4 flex">
								<h1 class="text-black font-semibold text-lg">{{ $order->id }}</h1>
					        </div>
					        <div>
					        	<div class="flex mb-1 items-center">
					                <p class="w-full text-grey-darkest"><strong>Ordered by: </strong>({{ $order->user_id }}) {{ $order->billing_name_on_card }} ({{ $order->billing_email }})</p>
					            </div>
					            <div class="flex mb-1 items-center">
					                <p class="w-full text-grey-darkest"><strong>Billing Address </strong>{{ $order->billing_address }}</p>
					            </div>
					            <div class="flex mb-1 items-center">
					                <p class="w-full text-grey-darkest"><strong>Billing Total: </strong>{{ $order->billing_total }}</p>
					            </div>
					            <div class="flex mb-1 items-center">
					                <p class="w-full text-grey-darkest"><strong>Charge / Invoice Id: </strong>{{ $order->stripe_charge_id }}</p>
					            </div>
					            <div class="flex mb-1 items-center">
					                <p class="w-full text-grey-darkest"><strong>Issue created at: </strong>
					                	@if ($order->issue_created_at)
					                		{{ $order->issue_created_at }}
					                	@else
					                		No issue created
					                	@endif
					                </p>
					            </div>
					            <div class="flex mb-1 items-center">
					                <p class="w-full text-grey-darkest"><strong>Issue resolved at: </strong>
					                	@if ($order->issue_resolved_at)
					                		{{ $order->issue_resolved_at }}
					                	@else
					                		Not yet resolved
					                	@endif
					                </p>
					            </div>
					        </div>
					    </div>
					</div>
			@endforeach

			@if (Route::currentRouteName() == 'all.orders')
				<div class="flex justify-center">
					{{ $orders->links() }}
				</div>
			@endif

</div>
@endsection