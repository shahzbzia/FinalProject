@extends('layouts.app')

@section('content')
<div class="container">

    <div class="p-3 w-full h-full overflow-y-auto flex justify-center">
        <div class="">
          @if ($user->followings()->count() > 0)
            
            @foreach ($user->followings as $u)
              <a href="{{ route('user.profile', $u->userName) }}" class="w-full" >
                <div class="flex md:flex-1 my-1 mt-6 mb-4">
                  <div>
                    @php
                      $uImage = ($u->image) ? asset("storage/".$u->image) : asset('/images/blank-profile.png');
                    @endphp
                    <img class="rounded-lg antialiased" width="100" src="{{ $uImage }}">
                  </div>
                  <div class="ml-2 text-xs mt-2">
                    <h1 class="text-base">{{ $u->firstName }} {{ $u->lastName }}</h1>
                    <h3 class="font-bold text-md text-tial-400">{{ $u->userName }}</h3>
                    <span class="font-light text-sm">{{ $user->gender->gender_name }} | {{ ($user->profession) ? $user->profession : 'Artist' }} | Joined {{ $user->created_at->diffForHumans() }}</span>
                    @if ($u->aboutMe)
                        <div>
                            {{ $u->aboutMe }}
                        </div>
                    @endif
                  </div>
                </div>
              </a>
            @endforeach

          @else 
        
            <div class="text-center mt-3 mb-3 font-sans text-xl font-sans font-normal">Oops, no one is here! Seems like <strong>{{ $user->userName }}</strong> isn't following anyone yet! If you <a href="{{ route('user.profile', $user->userName) }}">follow</a> him, maybe he will follow you back? </div>

          @endif
        </div> 
    </div>

</div>
@endsection
