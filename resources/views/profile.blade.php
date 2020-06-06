@extends('layouts.app')

@section('content')
<div class="container w-full mt-3">

  @php
    $coverImage = ($user->coverImage) ? asset("storage/".$user->coverImage) : asset('/images/plain-cover.jpg');

    if(App::environment('production')) {
      $coverImage = ($user->coverImage) ? asset("storage/app/public/".$user->coverImage) : asset('/public/images/plain-cover.jpg');
    }

    $userImage = ($user->image) ? asset("storage/".$user->image) : asset('/images/blank-profile.png');

    if(App::environment('production')) {
      $userImage = ($user->image) ? asset("storage/app/public/".$user->image) : asset('/public/images/blank-profile.png');
    }

    $themeText = (Auth::check()) ? 'text-'.Auth::user()->theme->value.'-500' : 'text-gray-600';

    $themeTextHover = (Auth::check()) ? 'text-'.Auth::user()->theme->value.'-700' : 'text-black';

    $themeBg = (Auth::check()) ? 'bg-'.Auth::user()->theme->value.'-500' : 'bg-black';

    $themeBgHover = (Auth::check()) ? 'bg-'.Auth::user()->theme->value.'-700' : 'bg-black';
  @endphp

  <div class="rounded rounded-t-lg overflow-hidden shadow w-full my-3 bg-white">
      <img src="{{ $coverImage }}" class="w-full h-96" />

      <div class="flex justify-center -mt-20" >
          <img src="{{ $userImage }}" class="w-auto md:w-1/5 rounded-full border-solid border-white border-2 -mt-2 h-47">
      </div>

      @auth
        <div class="flex flex-row md:flex-col justify-center md:flex-row md:justify-end md:justify-end mx-2 md:-mt-24 md:mb-20">

          @if ($user->id == Auth::user()->id)
                
            {{-- <a class="h-6 bg-green-600 hover:bg-green-800 text-white font-bold py-1 px-2 rounded inline-flex text-xs items-center shadow-lg ml-64 md:ml-5" href="">Edit Profile</a> --}}

            <a class="h-6 bg-green-600 hover:bg-green-800 text-white font-bold py-1 px-2 rounded inline-flex text-xs items-center shadow-lg md:ml-5" href="{{ route('user.showUserEditForm') }}">Edit Profile</a>

          @else

            <button class="action-follow h-6 bg-green-600 hover:bg-green-800 text-white font-bold py-1 px-2 rounded inline-flex text-xs items-center shadow-lg mr-2">
                <span class="shadow-lg">{{ ($user->isFollowedBy(Auth::user()) ? 'UnFollow' : 'Follow') }}</span>
            </button>

            <a href="{{ route('hireMe.index', $user->userName) }}" class="hover:no-underline h-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded inline-flex text-xs items-center shadow-lg mr-2">
                <span class="shadow-lg">Hire Me</span>
            </a>

            {{-- @auth
                @if (Auth::user()->checkRole() == 2)
                  <a href="{{ route('hireMe.index', $user->userName) }}" class="hover:no-underline h-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded inline-flex text-xs items-center shadow-lg mr-2">
                      <span class="shadow-lg">Hire Me</span>
                  </a>
                @endif
            @endauth --}}

          @endif

        </div>
      @endauth
    <div class="text-center px-3 pb-6 pt-2">
      <h3 id="user-id" data-id="{{ $user->id }}" class="text-black text-xl bold font-sans font-semibold">{{ $user->firstName }} {{ $user->lastName }}</h3>
      <h3 class="text-black text-lg font-light font-sans mt-2 text-grey-dark">{{ $user->userName }}</h3>
      <h3 class="text-black text-lg font-light font-sans mt-2 text-grey-dark">{{ $user->gender->gender_name }}, {{ \Carbon\Carbon::parse($user->birthDate)->age }} years old</h3>
      <h3 class="text-black text-lg font-light font-sans mt-2 text-grey-dark">{{ ($user->profession) ? $user->profession : 'Artist' }}</h3>
      <h3 class="text-black text-lg font-light font-sans mt-2 text-grey-dark">Joined {{ $user->created_at->diffForHumans() }}</h3>
      <h3 class="text-black text-lg font-light font-sans mt-2 text-grey-dark">{{ $user->countryCode }} {{ $user->number }}</h3>
      <h3 class="text-black text-lg font-light font-sans mt-2 text-grey-dark">{{ $user->email }}</h3>
      @if ($user->aboutMe)
        <p class="mt-2 font-sans text-lg font-light text-grey-dark"><span> {{ $user->aboutMe }} </span></p>
      @endif

    </div>
      <div class="flex justify-center pb-3 text-grey-dark text-lg mt-2">
        <div class="text-center mr-3 border-r pr-3">
          <button id="profile-tab-default-open" onclick="openProfileTabs(event, 'posts')" class="profile-tab-links hover:{{ $themeTextHover }} hover:no-underline outline-none focus:outline-none">
            <h2>{{ $user->posts()->count() }}</h2>
            <span>Posts</span>
          </button>
        </div>
        <div class="text-center mr-3 border-r pr-3">
          <button onclick="openProfileTabs(event, 'followers')" class="profile-tab-links hover:{{ $themeTextHover }} hover:no-underline outline-none focus:outline-none">
            <h2 class="followers-count">{{ $user->followers()->count() }}</h2>
            <span>Followers</span>
          </button>
        </div>
        <div class="text-center" >
          <button onclick="openProfileTabs(event, 'following')" class="profile-tab-links hover:{{ $themeTextHover }} hover:no-underline outline-none focus:outline-none">
            <h2>{{ $user->followings()->count() }}</h2>
            <span>Following</span>
          </button>
        </div>
      </div>
  </div>


  <div class="">

    <div id="posts" class="profile-tab-content mb-8">
      <div class="max-w-md mx-auto xl:max-w-full lg:max-w-full md:max-w-2xl bg-white max-h-screen shadow-lg flex-row rounded relative">
        <div class="p-3 bg-gray-900 text-gray-900 rounded-t">
            <h5 class="text-white text-sm text-center">Posts by {{ $user->userName }}</h5>
        </div>

        
        <div class="p-3 w-full h-full overflow-y-auto">
          @if ($user->posts()->count() > 0)
            @foreach ($user->posts->take(2) as $post)
              
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
        

        @else
          <div class="align-middle mx-auto mt-3 mb-3 font-sans text-lg font-sans font-normal text-center">{{ $user->userName }} hasn't made any posts yet! </div>
        @endif
        </div>
        <div class="bg-gray-200 p-2 flex justify-center">
          <a href="{{ route('my.posts', $user->userName) }}" class="text-xs text-tial-800 font-bold p-2 hover:no-underline hover:font-tial-600">SHOW ALL</a>
        </div>
      </div>
      
    </div>

    <div id="followers" class="profile-tab-content mb-8">
      <div class="max-w-md mx-auto xl:max-w-full lg:max-w-full md:max-w-2xl bg-white max-h-screen shadow-lg flex-row rounded relative ">
        <div class="p-3 bg-gray-900 text-gray-900 rounded-t">
            <h5 class="text-white text-sm text-center">Artists following {{ $user->userName }}</h5>
        </div>
        <div class="p-3 w-full h-full overflow-y-auto ">
            <div class="flex flex-col align-middle mx-auto md:flex-row flex-wrap justify-start">
              @if ($user->followers()->count() > 0)
                
                @foreach ($user->followers->take(4) as $u)
                  <a href="{{ route('user.profile', $u->userName) }}" class="w-full md:w-1/2" >
                    <div class="flex md:flex-1 my-1 mt-3">
                      <div>
                        @php
                          $uImage = ($u->image) ? asset("storage/".$u->image) : asset('/images/blank-profile.png');
                        @endphp
                        <img class="rounded-lg antialiased" width="50" src="{{ $uImage }}">
                      </div>
                      <div class="ml-2 text-xs">
                        <h3 class="font-bold text-md text-tial-400">{{ $u->userName }}</h3>
                        <span class="font-light text-sm">{{ $user->gender->gender_name }} | {{ ($user->profession) ? $user->profession : 'Artist' }} | Joined {{ $user->created_at->diffForHumans() }}</span>
                      </div>
                    </div>
                  </a>
                @endforeach

              @else 
            
                <div class="align-middle mx-auto mt-3 mb-3 font-sans text-lg font-sans font-normal">{{ $user->userName }} isn't followed by anyone yet! </div>

              @endif
            </div>
        </div>

        <div class="bg-gray-200 p-2 flex justify-center">
          <a href="{{ route('user.followers', $user->userName) }}" class="text-xs text-tial-800 font-bold p-2 hover:no-underline hover:font-tial-600">SHOW ALL</a>
        </div>
      </div>
      
    </div>

    <div id="following" class="profile-tab-content mb-8">
      <div class="max-w-md mx-auto xl:max-w-full lg:max-w-full md:max-w-2xl bg-white max-h-screen shadow-lg flex-row rounded relative ">
        <div class="p-3 bg-gray-900 text-gray-900 rounded-t">
            <h5 class="text-white text-sm text-center">{{ $user->userName }} following other artists</h5>
        </div>
        <div class="p-3 w-full h-full overflow-y-auto ">
            <div class="flex flex-col align-middle mx-auto md:flex-row flex-wrap justify-start">
              @if ($user->followings()->count() > 0)
                
                @foreach ($user->followings->take(4) as $u)
                  <a href="{{ route('user.profile', $u->userName) }}" class="w-full md:w-1/2" >
                    <div class="flex md:flex-1 my-1 mt-3">
                      <div>
                        @php
                          $uImage = ($u->image) ? asset("storage/".$u->image) : asset('/images/blank-profile.png');
                        @endphp
                        <img class="rounded-lg antialiased" width="50" src="{{ $uImage }}">
                      </div>
                      <div class="ml-2 text-xs">
                        <h3 class="font-bold text-md text-tial-400">{{ $u->userName }}</h3>
                        <span class="font-light text-sm">{{ $user->gender->gender_name }} | {{ ($user->profession) ? $user->profession : 'Artist' }} | Joined {{ $user->created_at->diffForHumans() }}</span>
                      </div>
                    </div>
                  </a>
                @endforeach

              @else 
            
                <div class="align-middle mx-auto mt-3 mb-3 font-sans text-lg font-sans font-normal">{{ $user->userName }} isn't following anyone yet! </div>

              @endif
            </div> 
        </div>

        <div class="bg-gray-200 p-2 flex justify-center">
          <a href="{{ route('user.followings', $user->userName) }}" class="text-xs text-tial-800 font-bold p-2 hover:no-underline hover:font-tial-600">SHOW ALL</a>
        </div>
      </div>
      
    </div>
  
  </div>

</div>

    


      

<script>

  document.getElementById("profile-tab-default-open").click();

  function openProfileTabs(evt, tabName) {
    // Declare all variables
    var i, profiletabcontent, profiletablinks;

    // Get all elements with class="profiletabcontent" and hide them
    profiletabcontent = document.getElementsByClassName("profile-tab-content");
    for (i = 0; i < profiletabcontent.length; i++) {
      profiletabcontent[i].style.display = "none";
    }

    // Get all elements with class="profiletablinks" and remove the class "active"
    profiletablinks = document.getElementsByClassName("profile-tab-links");
    for (i = 0; i < profiletablinks.length; i++) {
      profiletablinks[i].className = profiletablinks[i].className.replace(" {{ $themeText }}", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " {{ $themeText }}";
  }

</script>

<script>
  
  $(document).ready(function() {     

    $('.action-follow').click(function(){
        var _token = '{{ Session::token() }}';  
        var user_id = $("#user-id").data('id');
        var that = $(this);
        var c = $(".followers-count").text();

        //console.log(c);

        $.ajax({
           type:'POST',
           url:'{{ route('toggleFollow') }}',
           data:{user_id:user_id, _token:_token},
           success:function(data){
              console.log(data.response);
              if(data.response == 'unfollowed'){
                that.text("Follow");
                $(".followers-count").text(parseInt(c)-1);
              }else{
                that.text("UnFollow");
                $(".followers-count").text(parseInt(c)+1);
              }
           }
        });
    });      

  }); 

</script>
@endsection