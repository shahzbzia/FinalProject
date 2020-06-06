@extends('layouts.app')

@section('content')
<div class="container">
	
	@if ($users->count() == 0)
			
			<h1 class="text-center text-lg mt-10">"{{ request()->get('query') }}" matches no records in users!</h1>

		@else
			@foreach ($users as $user)
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
	</div>

</div>
@endsection