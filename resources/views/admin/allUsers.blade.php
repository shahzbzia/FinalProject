@extends('layouts.app')

@section('content')
<div class="container">

	<ul class="flex flex-col md:flex-row lg:flex-row xl:flex-row items-center">
	    <li class="flex-1 mt-1 lg:mr-10 lg:ml-5">
	        <button id="defaultOpenUsers" class="user-tab-links px-32 md:px-32 lg:px-40 xl:px-40 text-center block border border-black rounded py-2 text-black focus:outline-none flex bg-{{ Auth::user()->theme->value }}-500" onclick="openUser(event, 'unbanned')">
		  	  <p>Normal Users</p>
		  </button>

	    </li>
	    <li class="flex-1 mt-1">
	    	<button class="user-tab-links px-32 md:px-32 lg:px-40 xl:px-40 text-center block border border-black rounded py-2 focus:outline-none bg-{{ Auth::user()->theme->value }}-500 text-black" onclick="openUser(event, 'banned')"> 
		  	<p>Banned Users</p>
	  </button>
	    </li>

	</ul>

	<div id="unbanned" class="user-tab-content">
		<div class="row justify-content-center mt-4">
        <div class="w-11/12">
        	@if (!$users->isEmpty())
                @foreach ($users as $user)
	            <div class="card mt-4 shadow ">
	                
	                        @php
	                            $coverImage = ($user->coverImage) ? asset("storage/".$user->coverImage) : asset('/images/plain-cover.jpg');

	                            if(App::environment('production')) {
	                              $coverImage = ($user->coverImage) ? asset("storage/app/public/".$user->coverImage) : asset('/public/images/plain-cover.jpg');
	                            }

	                            $userImage = ($user->image) ? asset("storage/".$user->image) : asset('/images/blank-profile.png');

	                            if(App::environment('production')) {
	                              $userImage = ($user->image) ? asset("storage/app/public/".$user->image) : asset('/public/images/blank-profile.png');
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

		                        <div class="flex justify-center md:block md:mt-16 md:mr-4 mb-4">
		                        	@if (Auth::user()->checkRole() == 2)
			                        	<a href="{{ route('users.ban', $user->userName) }}" class="px-3 py-1 text-red-600 font-semibold border-2 border-red-600 rounded-lg hover:bg-red-600 hover:text-black hover:no-underline hover:text-white">Ban</a>
			                        @endif	
		                        </div>
	                        </div>
	                        
		            </div>
	            @endforeach
                    
                @else
                    <div class="card-body mt-4 text-center">
                        <h5>Sorry there are no users here!</h5>
                    </div>
                @endif   
	        </div>
	    </div>
		<div class="flex justify-center mt-4">
			{{ $users->links() }}
		</div>
	</div>

	<div id="banned" class="user-tab-content">
		<div class="row justify-content-center mt-4">
        <div class="w-11/12">
        	@if (!$bannedUsers->isEmpty())
                @foreach ($bannedUsers as $user)
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

		                        <div class="flex justify-center md:block md:mt-16 md:mr-4 mb-4">
		                        	@if (Auth::user()->checkRole() == 2)
			                        	<a href="{{ route('users.unban', $user->userName) }}" class="px-3 py-1 text-green-600 font-semibold border-2 border-green-600 rounded-lg hover:bg-green-600 hover:text-black hover:no-underline hover:text-white">Un-Ban</a>
			                        @endif	
		                        </div>
	                        </div>
	                        
		            </div>
	            @endforeach
                    
                @else
                    <div class="card-body mt-4 text-center">
                        <h5>Sorry there are no users here!</h5>
                    </div>
                @endif   
	        </div>
	    </div>
		<div class="flex justify-center mt-4">
			{{ $bannedUsers->links() }}
		</div>
	</div>

</div>

<script>
document.getElementById("defaultOpenUsers").click();

function openUser(evt, issueType) {
  // Declare all variables
  var i, usertabcontent, usertanlinks;

  // Get all elements with class="usertabcontent" and hide them
  usertabcontent = document.getElementsByClassName("user-tab-content");
  for (i = 0; i < usertabcontent.length; i++) {
    usertabcontent[i].style.display = "none";
  }

  // Get all elements with class="usertanlinks" and remove the class "active"
  usertanlinks = document.getElementsByClassName("user-tab-links");
  for (i = 0; i < usertanlinks.length; i++) {
    usertanlinks[i].className = usertanlinks[i].className.replace(" bg-{{ Auth::user()->theme->value }}-500", "");
    usertanlinks[i].className = usertanlinks[i].className.replace(" text-white", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(issueType).style.display = "block";
  evt.currentTarget.className += " bg-{{ Auth::user()->theme->value }}-500";
  evt.currentTarget.className += " text-white";
}
</script>
@endsection