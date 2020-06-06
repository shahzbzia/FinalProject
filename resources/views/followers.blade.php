@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          @if ($user->followers()->count() > 0)
                    @foreach ($user->followers as $user)
            <div class="card mx-auto mt-4">
                
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
            </div>
            @endforeach
                    
                    @else
                        <div class="text-center mt-3 mb-3 font-sans text-xl font-sans font-normal">Oops, no one is here! Seems like <strong>{{ $user->userName }}</strong> isn't following anyone yet! If you <a href="{{ route('user.profile', $user->userName) }}">follow</a> him, maybe he will follow you back? </div>
                @endif
        </div>
    </div>
</div>
@endsection


