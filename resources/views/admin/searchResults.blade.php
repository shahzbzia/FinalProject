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

	    <li class="flex-4 mt-1">
	    	<button class="search-tab-links px-40 md:px-10 lg:px-20 xl:px-20 text-center block border border-black rounded py-2 focus:outline-none font-bold bg-{{ Auth::user()->theme->value }}-500 text-black" onclick="openSearch(event, 'users')"> 
		  	Users
	  		</button>
	    </li>

	</ul>

	<div id="issues" class="search-tab-content">
		@if ($issues->count() == 0)
			
			<h1 class="text-center text-lg mt-10">"{{ request()->get('query') }}" matches no records in issues/disputes!</h1>

		@else
		
			@foreach ($issues->take(5) as $issue)
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

			@if ($issues->count() > 5)
				<div class="flex justify-center mb-4">
					<a class="mt-1 ml-2 px-2 py-1 text-green-600 font-semibold border-2 border-green-600 rounded-lg hover:bg-green-600 hover:text-black hover:no-underline hover:text-white" href="{{ route('search.allIssues', request()->get('query')) }}">SEE ALL</a>
				</div>
			@endif

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
		
			@foreach ($orders->take(5) as $order)
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

			@if ($orders->count() > 5)
				<div class="flex justify-center mb-4">
					<a class="mt-1 ml-2 px-2 py-1 text-green-600 font-semibold border-2 border-green-600 rounded-lg hover:bg-green-600 hover:text-black hover:no-underline hover:text-white" href="{{ route('search.allOrders', request()->get('query')) }}">SEE ALL</a>
				</div>
			@endif

		@endif
	</div>

	<div id="posts" class="search-tab-content">
		@if ($posts->count() == 0)
			
			<h1 class="text-center text-lg mt-10">"{{ request()->get('query') }}" matches no records in posts!</h1>

		@else
			@foreach ($posts->take(10) as $post)
	              
	                @if ($post->title && $post->slug)
	                  @php
	                      $pathImage = ($post->user->image) ? asset("storage/".$post->user->image) : asset('/images/blank-profile.png');
	                  @endphp
	          
	                    <div class="w-full md:w-4/5 align-middle mx-auto mb-4 mt-4" >
	                        <div class="max-w-sm w-full md:max-w-full lg:flex">


	                            @if ($post->getMedia('images')->first())
	                                <div class="h-48 lg:h-48 lg:w-72 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('{{ $post->getMedia('images')->first()->getUrl('watermarked') }}')">
	                                </div>
	                            @endif

	                             @if ($post->getMedia('video')->first())
	                                <div class="sm:h-32 md:h-48 lg:h-auto lg:w-72 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden">
	                                    <video controls controlsList="nodownload">
	                                        <source src="{{asset($post->getMedia('video')->first()->getUrl())}}" type="{{ $post->getMedia('video')->first()->mime_type }}">
	                                    </video>
	                                </div>
	                            @endif

	                            <a class="hover:no-underline" href="{{ route('post.show', $post->slug) }}">
	                                <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-3 flex flex-col justify-between leading-normal w-full min-h-64">
	                                    <div class="mb-3 ml-2">
	                                        <input type="hidden" class="post-id" value="{{ $post->id }}">
	                                        <div class="text-gray-900 font-bold text-base mb-2">{{ $post->title }}</div>
	                                        <div class="flex">
	                                            <p class="text-gray-700 text-sm">{{ \Illuminate\Support\Str::limit(strip_tags($post->description), 50) }}</p>
	                                            @if (strlen(strip_tags($post->description)) > 50)
	                                                <a href="{{ route('post.show', $post->slug) }}" class="text-xs ml-3">Read More</a>
	                                            @endif
	                                        </div>
	                                    </div>
	                                    <div class="flex justify-start ml-2">
	                                        <a href="{{ route('user.profile', $post->user->userName) }}" class="hover:no-underline">
	                                            <div class="flex items-center">
	                                                <img class="w-10 h-10 rounded-full mr-2" src="{{ $pathImage }}">
	                                                <div class="text-xs">
	                                                    <p class="text-gray-900 font-semibold leading-none">{{ $post->user->userName }}</p>
	                                                    <p class="text-gray-600 text-xs">{{ ($post->created_at)->diffForhumans() }}</p>
	                                                </div>
	                                            </div>
	                                        </a>
	                                    </div>
	                                </div>
	                            </a>
	                        </div>
	                    </div>         
	              @endif
	            @endforeach
	        @endif

	        @if ($posts->count() > 2)
				<div class="flex justify-center mt-3 mb-4">
					<a class="mt-1 ml-2 px-2 py-1 text-green-600 font-semibold border-2 border-green-600 rounded-lg hover:bg-green-600 hover:text-black hover:no-underline hover:text-white" href="{{ route('search.allPosts', request()->get('query')) }}">SEE ALL</a>
				</div>
			@endif
	</div>

	<div id="users" class="search-tab-content">
		@if ($users->count() == 0)
			
			<h1 class="text-center text-lg mt-10">"{{ request()->get('query') }}" matches no records in users!</h1>

		@else
			@foreach ($users->take(10) as $user)
	            <div class="card mt-4 shadow ">
	                
	                        @php
	                            $coverImage = ($user->coverImage) ? asset("storage/".$user->coverImage) : asset('/images/plain-cover.jpg');

	                            if(App::environment('production')) {
	                              $coverImage = ($user->coverImage) ? asset("storage/app/public/".$user->coverImage) : asset('/public/images/plain-cover.jpg');
	                            }

	                            $userImage = ($user->image) ? asset("storage/".$user->image) : asset('/images/blank-profile.png');

	                            if(App::environment('production')) {
	                              $userImage = (Auth::user()->image) ? asset("storage/app/public/".$user->image) : asset('/public/images/blank-profile.png');
	                            }
	                        @endphp
	                    
	                        <div class="md:flex justify-between">
	                        	<a href="{{ route('user.profile', $user->userName) }}" class="hover:no-underline hover:text-black">   
		                            <div class="card-body">
		                                <div class="flex flex-wrap">
		                                    <div class=" flex mx-1 my-1">
		                                        <div>
		                                            <img class="rounded-lg antialiased" width="100" src="{{ $userImage }}" alt="">
		                                        </div>
		                                        <div class="ml-2 text-base">
		                                            <p>{{ $user->firstName }} {{ $user->lastName }}</p>
		                                            <p>{{ ($user->profession) ? $user->profession : 'Artist' }}</p>
		                                            <span class="font-light text-sm">{{ $user->gender->gender_name }} | {{ ($user->profession) ? $user->profession : 'Artist' }} | Joined {{ $user->created_at->diffForHumans() }}</span>
		                                        </div>
		                                    </div>
		                                </div>             
		                            </div>
		                        </a>

		                        @if ($user->deleted_at)
			                        <div class="flex justify-center md:block md:mt-16 md:mr-4 mb-4">
			                        	@if (Auth::user()->checkRole() == 2)
				                        	<a href="{{ route('users.unban', $user->userName) }}" class="px-3 py-1 text-green-600 font-semibold border-2 border-green-600 rounded-lg hover:bg-green-600 hover:text-black hover:no-underline hover:text-white">Un-Ban</a>
				                        @endif	
			                        </div>

								@else

									<div class="flex justify-center md:block md:mt-16 md:mr-4 mb-4">
			                        	@if (Auth::user()->checkRole() == 2)
				                        	<a href="{{ route('users.ban', $user->userName) }}" class="px-3 py-1 text-red-600 font-semibold border-2 border-red-600 rounded-lg hover:bg-red-600 hover:text-black hover:no-underline hover:text-white">Ban</a>
				                        @endif	
			                        </div>

		                        @endif
	                        </div>
	                        
		            </div>  
	                
	        @endforeach
	        @endif

	        @if ($users->count() > 2)
				<div class="flex justify-center mb-4 mt-3">
					<a class="mt-1 ml-2 px-2 py-1 text-green-600 font-semibold border-2 border-green-600 rounded-lg hover:bg-green-600 hover:text-black hover:no-underline hover:text-white" href="{{ route('search.allUsers', request()->get('query')) }}">SEE ALL</a>
				</div>
			@endif
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