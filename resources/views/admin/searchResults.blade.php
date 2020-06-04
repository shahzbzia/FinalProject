@extends('layouts.app')

@section('content')
<div class="container">

	<ul class="flex flex-col md:flex-row lg:flex-row xl:flex-row items-center justify-center">
	    <li class="flex-4 mt-1">
	        <button id="defaultopenSearchs" class="search-tab-links px-40 md:px-10 lg:px-20 xl:px-20 text-center block border border-black rounded py-2 text-black font-bold focus:outline-none flex bg-{{ Auth::user()->theme->value }}-500" onclick="openSearch(event, 'issues')">
		  	Issues
		  </button>

	    </li>

	    <li class="flex-4 mt-1">
	    	<button class="search-tab-links px-40 md:px-10 lg:px-20 xl:px-20 text-center block border border-black rounded py-2 focus:outline-none font-bold bg-{{ Auth::user()->theme->value }}-500 text-black" onclick="openSearch(event, 'charges')"> 
		  	Charges
	  		</button>
	    </li>

	    <li class="flex-4 mt-1">
	    	<button class="search-tab-links px-40 md:px-10 lg:px-20 xl:px-20 text-center block border border-black rounded py-2 focus:outline-none font-bold bg-{{ Auth::user()->theme->value }}-500 text-black" onclick="openSearch(event, 'orders')"> 
		  	Orders
	  		</button>
	    </li>

	    <li class="flex-4 mt-1">
	    	<button class="search-tab-links px-40 md:px-10 lg:px-20 xl:px-20 text-center block border border-black rounded py-2 focus:outline-none font-bold bg-{{ Auth::user()->theme->value }}-500 text-black" onclick="openSearch(event, 'posts')"> 
		  	Posts
	  		</button>
	    </li>

	</ul>

	<div id="issues" class="search-tab-content">
		@if ($issues->count() == 0)
			
			<h1 class="text-center text-lg mt-10">"{{ request()->get('query') }}" matches no records in issues/disputes!</h1>

		@else
		
			@foreach ($issues as $issue)
				<a href="{{ route('issue.details', $issue->id) }}" class="hover:no-underline hover:text-black">
					<div class="h-100 w-full flex justify-center bg-teal-lightest font-sans">
						<div class="bg-white rounded shadow p-6 m-4 w-full lg:w-full">
					        <div class="mb-4 flex">
								<h1 class="text-black font-semibold text-lg">{{ $issue->subject }}</h1>
					        </div>
					        <div>
					        	<div class="flex mb-1 items-center">
					                <p class="w-full text-grey-darkest"><strong>Issue raised by: </strong>{{ $issue->user->firstName }} {{ $issue->user->lastName }} ({{ $issue->user->email }})</p>
					            </div>
					            <div class="flex mb-1 items-center">
					                <p class="w-full text-grey-darkest"><strong>Post Id: </strong>{{ $issue->post_id }}</p>
					            </div>
					            <div class="flex mb-1 items-center">
					                <p class="w-full text-grey-darkest"><strong>Order Id: </strong>{{ $issue->order_id }}</p>
					            </div>
					            <div class="flex mb-1 items-center">
					                <p class="w-full text-grey-darkest"><strong>Charge / Invoice Id: </strong>{{ $issue->charge_id }}</p>
					            </div>
					        </div>
					    </div>
					</div>
				</a>
			@endforeach

			<div class="flex justify-center">
				{{ $issues->links() }}
			</div>

		@endif
	</div>

	<div id="charges" class="search-tab-content">
		@if (is_string($charge))
			
			<h1 class="text-center text-lg mt-10">{{ $charge }}</h1>
			
		@else

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

		@endif
	</div>

	<div id="orders" class="search-tab-content">
		@if ($orders->count() == 0)
			
			<h1 class="text-center text-lg mt-10">"{{ request()->get('query') }}" matches no records in orders!</h1>

		@else
		
			@foreach ($orders as $order)
				<a href="{{ route('issue.details', $issue->id) }}" class="hover:no-underline hover:text-black">
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
				</a>
			@endforeach

			<div class="flex justify-center">
				{{ $issues->links() }}
			</div>

		@endif
	</div>

	<div id="posts" class="search-tab-content">
		Posts
	</div>

</div>

<script>
document.getElementById("defaultopenSearchs").click();

function openSearch(evt, issueType) {
  // Declare all variables
  var i, searchtabcontent, searchtablinks;

  // Get all elements with class="searchtabcontent" and hide them
  searchtabcontent = document.getElementsByClassName("search-tab-content");
  for (i = 0; i < searchtabcontent.length; i++) {
    searchtabcontent[i].style.display = "none";
  }

  // Get all elements with class="searchtablinks" and remove the class "active"
  searchtablinks = document.getElementsByClassName("search-tab-links");
  for (i = 0; i < searchtablinks.length; i++) {
    searchtablinks[i].className = searchtablinks[i].className.replace(" bg-{{ Auth::user()->theme->value }}-500", "");
    searchtablinks[i].className = searchtablinks[i].className.replace(" text-white", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(issueType).style.display = "block";
  evt.currentTarget.className += " bg-{{ Auth::user()->theme->value }}-500";
  evt.currentTarget.className += " text-white";
}
</script>
@endsection